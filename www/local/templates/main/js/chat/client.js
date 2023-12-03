console.log("chat start");
/*______________________*/

var recipient = getRecipients();
const socket = io('https://bobbythebulldog.com:3001', { transport: ['websocket'] });
const status = document.getElementById('status');
const messages = document.getElementById('messages');
const chat_form = document.getElementById('chat_form');
const chat_input = document.getElementById('input');

// Notification
const NOTIFI_BLOCK = document.querySelector('.user-nav__item');
var isFirstStart = true;
/********************************************************************************************************************/
/*********************************************** FUNCTIONS **********************************************************/

/**
 * Для обработки входящей информации socket.on типа "message"
 * @param {*} data параметры сообщения
 * @returns 
 */
function onMessage(data) {
	if (isActiveChat()) {
		if (data.senderID == ChatSender.MY_ID) {
			printMessageSender(data.message);
			return true;
		}
		if (data.senderID == recipient.ACTIVE_ID) {
			printMessageRecipient(data.message);
			if (!data.hist) {
				// получено и прочитано..
				let msg = {
					mesID: data.mesID
				}
				socket.emit('message_read', msg);
			}
			return true;
		}
		updateCounterMes(data.senderID);
	}
	// обновить список уведомлений. 
	// data.mes = "У вас есть пропущенное сообщение от пользователя";
	// data.typeUser = ChatSender.TYPE_USER;
	console.log(data);
	socket.emit("updateNotification", data);
}

function isActiveChat() {
	if (document.querySelector(".b-chat")) return true;
	return false;
}

/**
 * Смена активного чата
 * @param {*} idUser  = идентификатор получателя
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
 * Обновить счетчик пропущенных сообщений и вывод результата на страницу
 * @param {*} ID 
 */
function updateCounterMes(ID) {
	for (let recID of recipient.LIST) {
		if (ID != recID) continue;
		let dataRes = '[data-recipientID="' + recID + '"]';
		let objAll = document.querySelectorAll(dataRes);
		for (let obj of objAll) {
			let mail = obj.querySelector('.notification');
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
 * @returns ИД активного получателя "ACTIVE_ID" и список получателей (в виде списка объектов) "LIST".
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
	div.innerHTML = value;

	messages.appendChild(div);
};

function printMessageSender(value) {
	let div = document.createElement('div');
	div.className = "b-chat-dialog__message b-chat-dialog__message--left";
	div.innerHTML = value;

	messages.appendChild(div);
};

function onNotification(data) {
	var options = {
		day: 'numeric',
		month: 'numeric',
		year: 'numeric'
	}
	let date = new Date(data.UF_DATE);
	date = date.toLocaleString('ru', options)
	let notificList = NOTIFI_BLOCK.querySelector(".user-nav__list");
	let notRead = "";
	if (data.UF_NEW_MESSAGE == "1") {
		setCountNotification();
		notRead = "b-notification-list__item--not-read";
	}
	let messege = '<li class="b-notification-list__item ' + notRead + '" data-id="' + data.ID + '" data-idsend="' + data.UF_SEND_CHAT + '">'
		+ '<time class="b-notification-list__date" datetime="' + date + '">' + date + '</time>'
		+ '<div class="b-notification-list__text"><p>' + data.UF_MESSAGE + '</p></div>'
		+ ' <a href="#" onclick="delNotif(' + data.ID + ');" >Remove</a>'
		+ '</li>';
	notificList.insertAdjacentHTML("afterbegin", messege);

	//console.log(data);
}

function setCountNotification() {
	let countNotif = NOTIFI_BLOCK.querySelector(".notification");
	if (countNotif) {
		let counter = Number(countNotif.innerHTML);
		counter++;
		countNotif.innerHTML = counter;
	}
	countNotif.style.visibility = 'visible';
	//countNotif.hidden=true;
}

function initChat() {
	console.log("Init socket");
	socket.emit('initSocket', { 'MY_ID': ChatSender.MY_ID, 'MY_TOKEN': ChatSender.MY_TOKEN , 'DATA': ChatSender.DATA });

	if (isFirstStart) {
		// 1 проверить наличие уведомлений для пользователя. 
		socket.emit("getNotification");
		// 2. проверить наличие пропущенных сообщений
		if (isActiveChat()) {
			data = { recipientID: recipient.ACTIVE_ID };
			socket.emit("getHistory", data);
		}
		isFirstStart = false;
	}
}

function delNotif(data) {
	let delElrm = NOTIFI_BLOCK.querySelector('[data-idsend="' + data + '"]');
	if (delElrm) {
		delElrm.remove();
		let countNotif = NOTIFI_BLOCK.querySelector(".notification");
		if (countNotif) {
			let counter = Number(countNotif.innerHTML);
			counter--;
			countNotif.innerHTML = counter;
			if (counter < 1) countNotif.style.visibility = 'hidden';
		}
	}
}

function notificationViewed() {
	let notReadList = NOTIFI_BLOCK.querySelectorAll('.b-notification-list__item--not-read');
	notReadList.forEach(function (item, i, notReadList) {
		socket.emit("notificationViewed", item.dataset.id);
		item.classList.remove('b-notification-list__item--not-read');
		let countNotif = NOTIFI_BLOCK.querySelector(".notification");
		countNotif.innerHTML = "0";
		countNotif.style.visibility = 'hidden';
	});
}

function delNotif(id) {
	socket.emit("notificationDelede", id);
	let notif = NOTIFI_BLOCK.querySelector('[data-id="' + id + '"]');
	if (notif) notif.remove();
}
// 
/*********************************************** FUNCTIONS **********************************************************/
/********************************************************************************************************************/

socket.on(socket);
socket.on("connect", () => {
	console.log("Start socket"); // true
	initChat();
});
socket.on("disconnect", () => {
	//	console.log(socket.connected); // false
	console.log("Disconnect socket."); // false
});
socket.on('message', onMessage);

socket.on('Notification', onNotification);

socket.on('delNotif', delNotif);

if (isActiveChat()) {
	socket.on('history', function (data) {
		data.forEach(function (item, i, data) {
			msg = {
				senderID: item.UF_ID_SENDER,
				message: item.UF_MESSAGE,
				hist: true
			}
			onMessage(msg);
		});
	});

	socket.on('updateCounterMes', function (data) {
		data.forEach(function (item, i, data) {
			updateCounterMes(item.UF_ID_SENDER)
		});
	});

	chat_form.addEventListener('submit', event => {
		event.preventDefault();

		let msg = {
			recipientID: recipient.ACTIVE_ID,
			message: chat_input.value,
		}

		socket.emit('message', msg);

		chat_input.value = '';
	});
}



class CardsHandler {
	/**
	 * Singleton 
	 * @returns Singleton class
	 */
	constructor() {
		if (typeof CardsHandler.class === 'object') {
			return CardsHandler.class;
		}

		this.init();
		CardsHandler.class = this;
		return CardsHandler.class;
	}

	recipientsCards = false;

	init() {
		this.recipientsCards = document.querySelectorAll(".b-personal-order");
		if (this.recipientsCards) this.recipientsCards.forEach(item => {
			item.addEventListener('click',()=>{
				this.setActiveCard(item);
			});
		});
	}

	setActiveCard(card)
	{
		if(!card.classList.contains("active")){
			this.recipientsCards.forEach(item => {
				if(item.classList.contains("active")) 
					item.classList.remove("active");
			});
			card.classList.add("active");
			if(card.querySelector('.b-personal-order__left')){
				let idUser = card.querySelector('.b-personal-order__mail').getAttribute("data-recipientid");
				newChat(idUser);
			}
		} 
	}

}

/***************************************************************************************************Загрузка страницы */
$(document).ready(function () {
	new CardsHandler();
});
/******************************************************************************************************************** */
var timeCheck = true;
var timerID;
document.querySelector(".user-nav__item--notification").addEventListener('mouseout', function (e) {
	if (timeCheck) {
		timeCheck = false;
		timerID = setTimeout(notificationViewed, 2000);
	}
});
document.querySelector(".user-nav__item--notification").addEventListener('mouseleave', function (e) {
	if (!timeCheck) {
		timeCheck = true;
		clearTimeout(timerID);
	}
});
