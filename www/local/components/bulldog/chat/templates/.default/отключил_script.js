console.log("chat_default_script");
/*_______________________________*/

const status = document.getElementById('status');
const messages = document.getElementById('messages');
const chat_form = document.getElementById('chat_form');
const chat_input = document.getElementById('input');

var recipient = getRecipients();

const socket = io('https://bulldog.bxwork.ru:3001', { transport: ['websocket'] });

socket.on(socket);

socket.on("connect", () => {
	console.log("Start chat"); // true
});

socket.on("disconnect", () => {
	//	console.log(socket.connected);  // false
	// console.log("Disconnect chat."); // false
});

socket.on('message', onMessage);

function onMessage(data) {

	if (data.senderID == ChatSender.MY_ID) {
		printMessageSender(data.message);
	}
	else if (data.senderID == recipient.ACTIVE_ID) {
		printMessageRecipient(data.message);
		if (!data.hist) {
			let msg = {
				mesID: data.mesID
			}
			socket.emit('message_read', msg);
		}
	}
	else {
		updateCounterMes(data.senderID);
	}
}

chat_form.addEventListener('submit', event => {
	event.preventDefault();

	let msg = {
		recipientID: recipient.ACTIVE_ID,
		message: chat_input.value,
	}

	socket.emit('message', msg);

	chat_input.value = '';
});

$(document).ready(function () {
	console.log("Init chat");
	socket.emit('initSocket', { 'MY_ID': ChatSender.MY_ID, 'MY_TOKEN': ChatSender.MY_TOKEN });
	data = {
		recipientID: recipient.ACTIVE_ID
	};
	socket.emit("getHistory", data);
});

socket.on('history', function (data) {
	data.forEach(function(item, i, data){
		msg = {
			senderID: item.UF_ID_SENDER,
			message: item.UF_MESSAGE,
			hist: true
		}
		onMessage(msg);
	});
});

socket.on('updateCounterMes', function (data) {
	data.forEach(function(item, i, data){
		updateCounterMes(item.UF_ID_SENDER)
	});
});

/**
 * Смена активного чата
 * @param {*} idUser идентификатор получателя
 */
function newChat(idUser) {
	recipient.ACTIVE_ID = idUser;

	let obj = document.querySelector('[data-recipientID="' + idUser + '"]');
	let mail = obj.querySelector('.notification');
	if (mail) {
		mail.remove();
	}
	messages.innerHTML = "";

	// запросить историю сообщений
	data = {
		recipientID: idUser
	};
	socket.emit("getHistory", data);
};

/**
 * Обновить счетчик пропущенных сообщений
 * @param {*} ID идентификатор получателя
 */
function updateCounterMes(ID) {
	for (let recID of recipient.LIST) {
		if (ID != recID) continue;
		let dataRes = '[data-recipientID="' + recID + '"]';
		let objAll = document.querySelectorAll(dataRes);
		for(let obj of objAll){
			let mail = obj.querySelector('.notification'); // FIXME заменить на массив и обновлять значение у все элементов
			if (mail) {
				let counter = Number(mail.innerHTML);
				counter++;
				mail.innerHTML = counter;
			}
			else {
				obj.insertAdjacentHTML('beforeend', '<span class="notification b-personal-order__notification">1</span>');
			}
		}
	}
}

/**
 * 
 * @returns ИД активного получателя (ACTIVE_ID) и список получателей
 */
function getRecipients() {
	let obRecipient = {
		ACTIVE_ID: "",
		LIST: []
	}

	let recipients = document.querySelectorAll(".b-personal-order");
	for (let recipient of recipients) {
		if (recipient.classList.contains("active")) {
			let rec = recipient.querySelector('[data-recipientID]');
			if (rec.hasAttribute("data-recipientID")) {
				obRecipient.ACTIVE_ID = rec.getAttribute("data-recipientID");
			}
		}
		else {

			let rec = recipient.querySelector('[data-recipientID]');
			if (rec) {
				obRecipient.LIST.push(rec.getAttribute("data-recipientID"));
			}
		}
	}
	obRecipient.LIST = Array.from(new Set(obRecipient.LIST));
	return obRecipient;
};

function setStatus(value) {
	status.innerHTML = value;
};

function printMessageRecipient(value) {
	let div = document.createElement('div');
	div.className = "b-chat-dialog__message b-chat-dialog__message--right";
	div.innerText = value;

	messages.appendChild(div);
};

function printMessageSender(value) {
	let div = document.createElement('div');
	div.className = "b-chat-dialog__message b-chat-dialog__message--left";
	div.innerText = value;

	messages.appendChild(div);
};

