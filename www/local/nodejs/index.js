// iptables -I INPUT -p tcp --dport 3001 -m state --state NEW -j ACCEPT
// iptables -I INPUT -p tcp --dport 5004 -m state --state NEW -j ACCEPT
// зарегистрировать чат как службу и запускать вместе с ОС
/**
 * weak заменить на weak-napi
 * dnode/index js заменить строку 28 : weak = require("weak-napi")
 */
// npm install socket.io
// npm install dnode
console.log(" -= START socket.io chat! =-");

var getMd5 = require('./lib/md5');
var config = require('./config');
console.log(" -= config =-");
var db = require('./lib/db');
console.log(" -= DB =-");


var dnode = require('dnode');
var serverDnode = dnode({
	transform: function (value, recipientID = 0, cb) {
		//console.log(value);
		newNotification(value, recipientID);
		cb("готово");
	}
});
serverDnode.listen(5004);

console.log(" -= DNODE =-");

// HTTH || HTTPS
if (config.secure) {
	var fs = require('fs');
	var options = {
		key: fs.readFileSync(config.privkey),
		cert: fs.readFileSync(config.fullchain)
	};
	var server = require("https").createServer(options, handler);
	console.log("HTTPS");
}
else {
	var server = require("http").createServer(handler);
}

console.log(" -= HTTH || HTTPS =-");

var io = require('socket.io')(server, {
	cors: {
		origin: "*",
		methods: ["GET", "POST"],
		allowedHeaders: ["my-custom-header"],
		credentials: true
	}
});
console.log(" -= IO init =-");

server.listen(config.port);

function handler(req, res) {
	res.writeHead(200);
	res.end('Hello Http');
}

async function test() {

	newNotification(
		"ТЕСТОВОЕ УВЕДОМЛЕНИЕ!",
		7
	);
}

// добавить новое уведомление
async function newNotification(message, recipientID, send_chat = "") {
	let notifData = {
		USER_ID: recipientID,
		MESSAGE: message,
		SEND_CHAT: send_chat
	}
	let idNotif = await db.addNotificationMessage(notifData);

	for (let [id, socket] of io.of("/").sockets) {
		if (recipientID != socket.BITRIX_ID) continue;

		let arrMessage = await db.getArrayNotificationMessage(socket.BITRIX_ID, idNotif);
		if (arrMessage) {
			arrMessage.forEach(function (item) {
				socket.emit('Notification', item);
			});
		}
	}
}

/**
 * 
 * @param {*} recipientID  - ид получателя уведомления
 * @param {*} senderID  - ид отправителя сообщения в чате
 * @param {*} message - сообщение в Уведомлении
 * @returns 
 */
async function updateNotificationFromChat(recipientID, senderID, mesText = "У вас есть пропущенное сообщение от пользователя ") {
	let isNewNotif = await db.isNewNotificationFromUser(recipientID, senderID);
	if (isNewNotif) {
		// добавить новое уведомление
		let message = mesText + ' <a href="/account/';
		// получить id группы получателя: recipientID
		userGroupID = await db.getUserGroup(recipientID);
		if (userGroupID == "6") {
			message += "my-orders";
		}
		if (userGroupID == "5") {
			message += "my-requests";
		}
		message += '?active=' + senderID + '">';
		message += await db.getUserName(senderID);
		message += '</a>';

		newNotification(message, recipientID, senderID);
	};
}

io.sockets.on('connection', function (socket) {
	socket.on('message', async function (data) {
		var trimContent = data.message.trim();
		if (trimContent == "") {
			return false;
		};

		// проверка на возможность отправки сообщений (наличие тарифа)
		if(new Date() >= new Date(socket.DATA_LIC)){
			let send = {
				message: 'Sending messages is impossible! <br> <a href="/account/subscription/">Buy a license -> </a> ',
				senderID: data.recipientID,
				mesID: 0
			};
			socket.emit('message', send);
			return;
		}

		let idMessage = await db.recordMessages(socket.BITRIX_ID, data.recipientID, data.message);

		let send = {
			message: data.message,
			senderID: socket.BITRIX_ID,
			mesID: idMessage
		};

		socket.emit('message', send);

		// выход из чата
		if (data.message == "exit") {
			socket.disconnect();
		};
		if (data.message == "test") {
			test();
			return false;
		};

		// перебор всех активных соединений из группы "/"
		let userOnline = false;
		for (let [id, client] of io.of("/").sockets) {
			if (client.BITRIX_ID == data.recipientID) {
				client.emit('message', send);
				userOnline = true;
			}
		}
		if (!userOnline) {
			// отправить уведомление
			updateNotificationFromChat(data.recipientID, socket.BITRIX_ID);
		}

	});

	socket.on('initSocket', function (data) {
		console.log(" -= initSocket =-");
		if (getMd5(data.MY_ID + data.DATA + '-bulldog52') == data.MY_TOKEN) {
			socket.BITRIX_ID = data.MY_ID;
			socket.DATA_LIC = data.DATA;
		}
		else {
			console.log("disconnect");
			socket.disconnect();
		}
	});

	// записать статус - сообщение прочитано
	socket.on("message_read", function (data) {
		let recipientID = socket.BITRIX_ID;
		db.messageRead(data.mesID, recipientID);
	});

	// запрос полследних сообщений 
	socket.on("getHistory", async function (data) {
		let idRecipient = data.recipientID;
		let idSender = socket.BITRIX_ID;
		let arrMessage = await db.getArrayHistMessage(idSender, idRecipient);
		socket.emit('history', arrMessage);

		let del = db.deletNotif(idSender, idRecipient);
		if (del) socket.emit('delNotif', idRecipient);

		let arrMissedMessage = await db.getarrMissedMessage(socket.BITRIX_ID, data.recipientID);
		socket.emit('updateCounterMes', arrMissedMessage);
	});

	// Запрос уведомлений для пользователя
	socket.on("getNotification", async function () {
		let arrMessage = await db.getArrayNotificationMessage(socket.BITRIX_ID);
		if (arrMessage) {
			arrMessage.forEach(function (item) {
				socket.emit('Notification', item);
			});
		}
	});

	// Обновить список Уведомлений
	socket.on("updateNotification", async function (data) {
		if (data.senderID == 'undefined') {
			return false;
		}
		updateNotificationFromChat(socket.BITRIX_ID, data.senderID);
	});

	// Обновить список Уведомлений
	socket.on("notificationViewed", async function (id) {
		db.notificationViewed(id);
	});

	// Обновить список Уведомлений
	socket.on("notificationDelede", async function (id) {
		db.deletNotif(0,0, id);
	});

});

