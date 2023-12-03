const mysql = require("mysql2");

const connection = mysql.createConnection({
	// host: "localhost",
	user: "bitrix0",
	database: "sitemanager",
	password: "@aA2U)c@EKL+xKfvUSso",
	socketPath : "/var/lib/mysqld/mysqld.sock"
});

var recordMessages = async function (idSender, idRecipient, message) {
	var callback = [idSender, idRecipient, message];
	var sql = "INSERT chat(UF_ID_SENDER, UF_ID_RECIPIENT, UF_DATE_TIME, UF_MESSAGE) VALUES(?, ?, NOW(), ?)";
	let promise = await new Promise((resolve, reject) => {
		connection.query(sql, callback, function (err, results) {
			resolve(results.insertId);
		});
	});
	return promise;
};

var addNotificationMessage = async function (data) {
	var callback = [data.USER_ID, data.MESSAGE, data.SEND_CHAT];
	var sql = "INSERT notification(UF_USER_ID,UF_MESSAGE,UF_DATE,UF_NEW_MESSAGE,UF_SEND_CHAT) VALUES(?, ?, NOW(), 1, ?)";
	let promise = await new Promise((resolve, reject) => {
		connection.query(sql, callback, function (err, results) {
			//resolve(results.insertId);
			resolve(results.insertId);
		});
	});
	return promise;
};

// сообщение прочитанно
var messageRead = function (idMsg, recipientID) {
	const sql = `UPDATE chat SET UF_READ_MESSAGE=1 WHERE ((ID=?) && (UF_ID_RECIPIENT=?))`;
	const data = [idMsg, recipientID];
	connection.query(sql, data, function (err, results) {
		if (err) console.log(err);
	});
}

// получить историю сообщений
var getArrayHistMessage = async function (idSender, idRecipient) {
	var callback = [idSender, idRecipient, idRecipient, idSender];

	var sql = 'SELECT ID, UF_ID_SENDER, UF_ID_RECIPIENT, UF_MESSAGE, UF_READ_MESSAGE '
		+ 'FROM chat '
		+ 'WHERE (UF_ID_SENDER=? AND UF_ID_RECIPIENT=?) OR (UF_ID_SENDER=? AND UF_ID_RECIPIENT=?) '
		+ 'ORDER BY ID LIMIT 50';
	let promise = await new Promise((resolve, reject) => {
		connection.query(sql, callback, function (err, results) {
			resolve(results);
		});
	});

	//сделать все элементы со статусом прочитано
	if (Array.isArray(promise) && promise.length > 0) {
		promise.forEach(function (item, i, promise) {
			if (item.UF_READ_MESSAGE != "1") {
				messageRead(item.ID, idSender);
			}
		});
	}
	return promise;
};

// получить Уведомления
var getArrayNotificationMessage = async function (idUser, idNotif = 0) {
	var sql = 'SELECT * '
		+ 'FROM notification '
		+ 'WHERE ';

	if (idNotif != 0) {
		sql += 'ID=? ';
		var callback = [idNotif];
	}
	else {
		sql += 'UF_USER_ID=? ';
		var callback = [idUser];
	}
	sql += 'ORDER BY ID LIMIT 50'; // DESC
	let promise = await new Promise((resolve, reject) => {
		connection.query(sql, callback, function (err, results) {
			resolve(results);
		});
	});
	return promise;
};

var isNewNotificationFromUser = async function (idUser, idSender) {
	let result = true;
	var callback = [idUser, idSender];


	var sql = 'SELECT * '
		+ 'FROM notification '
		+ 'WHERE UF_USER_ID=? AND UF_SEND_CHAT=?'
		+ 'ORDER BY ID LIMIT 50'; // DESC
	let promise = await new Promise((resolve, reject) => {
		connection.query(sql, callback, function (err, results) {
			resolve(results);
		});
	});

	if (promise.length > 0) result = false;
	return result;
};

var getUserName = async function (idUser) {
	var callback = [idUser];
	var sql = 'SELECT NAME,LAST_NAME '
		+ 'FROM b_user '
		+ 'WHERE ID=? '; // DESC
	let promise = await new Promise((resolve, reject) => {
		connection.query(sql, callback, function (err, results) {
			resolve(results);
		});
	});
	let result = promise[0].NAME + ' ' + promise[0].LAST_NAME;
	return result;
};

var getUserGroup = async function (idUser) {
	var callback = [idUser];
	var sql = 'SELECT GROUP_ID '
		+ 'FROM b_user_group '
		+ 'WHERE USER_ID=? AND (GROUP_ID=5 OR GROUP_ID=6)'; // DESC
	let promise = await new Promise((resolve, reject) => {
		connection.query(sql, callback, function (err, results) {
			resolve(results);
		});
	});
	return promise[0].GROUP_ID;
};

// непрочитано 
var getarrMissedMessage = async function (idSender, idRecipientActive) {
	var callback = [idSender, idRecipientActive];
	var sql = 'SELECT * '
		+ 'FROM chat '
		+ 'WHERE UF_ID_RECIPIENT=? AND UF_ID_SENDER!=? AND (UF_READ_MESSAGE IS NULL OR UF_READ_MESSAGE=0) ';
		+ 'ORDER BY ID'; // DESC
	let promise = await new Promise((resolve, reject) => {
		connection.query(sql, callback, function (err, results) {
			resolve(results);
		});
	});
	return promise;
};

// 
var deletNotif = async function (idUser, idSender, id = 0) {
	if (id == 0) {
		var callback = [idUser, idSender];
		var sql = 'DELETE FROM notification '
			+ 'WHERE UF_USER_ID=? AND UF_SEND_CHAT=? ';
	}
	else {
		var callback = [id];
		var sql = 'DELETE FROM notification '
			+ 'WHERE ID=?';
	}
	let promise = await new Promise((resolve, reject) => {
		connection.query(sql, callback, function (err, results) {
			resolve(results.affectedRows);
		});
	});
	let result = false;
	if (promise > 0) result = true;
	return result;
};

// сообщение прочитано
var notificationViewed = function (id) {
	const sql = `UPDATE notification SET UF_NEW_MESSAGE=0 WHERE ID=?`;
	const data = [id];
	connection.query(sql, data, function (err, results) {
		if (err) console.log(err);
	});
}

// проверка наличия лицензии 
var checkingLicense = function(idUser){
	// b_uts_user - таблица 

	// const sql = `UPDATE notification SET UF_NEW_MESSAGE=0 WHERE ID=?`;
	// const data = [id];
	// connection.query(sql, data, function (err, results) {
	// 	if (err) console.log(err);
	// });
}


// connection.end();
module.exports.recordMessages = recordMessages;
module.exports.messageRead = messageRead;
module.exports.getArrayHistMessage = getArrayHistMessage;
module.exports.getarrMissedMessage = getarrMissedMessage;

module.exports.getArrayNotificationMessage = getArrayNotificationMessage;
module.exports.isNewNotificationFromUser = isNewNotificationFromUser;
module.exports.addNotificationMessage = addNotificationMessage;
module.exports.deletNotif = deletNotif;
module.exports.notificationViewed = notificationViewed;

module.exports.getUserName = getUserName;
module.exports.getUserGroup = getUserGroup;