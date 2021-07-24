var msginput = document.getElementById("msginput");
var msgarea = document.getElementById("msg-area");
var receiver;
function chooseusername() {

	var user = document.getElementById("cusername").value;
	document.cookie = "messengerUname=" + user;
	
}

function getcookie(cname) {
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for (var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') c = c.substring(1);
		if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
	}
	return "";
}
function escapehtml(text) {
	return text
		.replace(/&/g, "&amp;")
		.replace(/</g, "&lt;")
		.replace(/>/g, "&gt;")
		.replace(/"/g, "&quot;")
		.replace(/'/g, "&#039;");
}
function updateChat() {

	var xmlhttp = new XMLHttpRequest();
	var username = getcookie("messengerUname");
	var output = "";
	xmlhttp.onreadystatechange = function () {

		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var response = xmlhttp.responseText.split("\n");
			var rl = response.length;
			var item = "";
			for (var i = 0; i < rl; i++) {
				item = response[i].split("\\")
				if (item[1] != undefined) {
					if (item[0] == username) {
						output += "<div class=\"msgc\" > <div class=\"msg msgfrom\">" + item[1] + "</div> <div class=\"msgarr msgarrfrom\"></div> </div>";
					} else {
						output += "<div class=\"msgc\"> <div class=\"msg\">" + item[1] + "</div> <div class=\"msgarr\"></div>  </div>";
					}
				}
			}
			msgarea.innerHTML = output;

		}
	}
	xmlhttp.open("GET", "get_messenges.php?receiver_id=" + receiver, true);
	xmlhttp.send();
}

function sendmsg() {
	/* updateChat();
	$.ajax({
		type: "POST",
		url: "update_messenges.php",
		data: {'message': msginput.value,
			  '': file},
		dataType: "json",
		success: function(data){
			updateChat();
		}
	}); */
	var message = msginput.value;
	if (message != "") {
		var username = getcookie("messengerUname");
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function () {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				message = escapehtml(message);
				msgarea.innerHTML += "<div class=\"msgc\" > <div class=\" msgfrom\">" + message + "</div> <div class=\"msgarr msgarrfrom\"></div> </div>";
				msginput.value = "";
				msgarea.scrollTop = msgarea.scrollHeight;
			}
		}
		xmlhttp.open("GET", "send_messages.php?receiver_id=" + receiver + "&message=" + message, true);
		xmlhttp.send();

	}
}

function logout() {
	
}

let a = document.getElementById("friend_default_style").childNodes;
function friendChatting(receiver_id) {
	for(let i = 1; i< a.length-3 ; i++ ) {
		a[i].style = "background-color: #323944bf";
		console.log(i);
	}
	document.getElementById(receiver_id).style = "background-color :#65676b";
	receiver = receiver_id;
}


setInterval(function () { updateChat() }, 1500);

console.log(a);