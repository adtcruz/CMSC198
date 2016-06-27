$('document').ready(
	function(){
		$("#mngeApButton").addClass("black");
		$('ul.tabs').tabs();
	}
);

function getLogInLogs(url){
	$.post(url+"get_logs",{filter:"login"},function(data) {
		$("#logInLogs").html(
			"<div class=\"col s1 m1 l1\">&nbsp;</div><div class=\"col s10 m10 l10\">"+data+
			"</div><div class=\"col s1 m1 l1\">&nbsp;</div>"
		);
	});
}

function getLogOutLogs(url){
	console.log("Got it mate");
	$.post(url+"get_logs",{filter:"logout"},function(data) {
		$("#logOutLogs").html(
			"<div class=\"col s1 m1 l1\">&nbsp;</div><div class=\"col s10 m10 l10\">"+data+
			"</div><div class=\"col s1 m1 l1\">&nbsp;</div>"
		);
	});
}

function getJobActionsLogs(url){
	$.post(url+"get_logs",{filter:"jobActions"},function(data) {
		$("#jobActionsLogs").html(
			"<div class=\"col s1 m1 l1\">&nbsp;</div><div class=\"col s10 m10 l10\">"+data+
			"</div><div class=\"col s1 m1 l1\">&nbsp;</div>"
		);
	});
}

function getUsersLogs(url){
	usernameVal = $("#usernameInput").val();
	$.post(url+"get_logs",{filter:"byUser",username:usernameVal},function(data) {
		$("#searchByUser").html(
			"<div class=\"col s1 m1 l1\">&nbsp;</div><div class=\"col s10 m10 l10\">"+data+
			"</div><div class=\"col s1 m1 l1\">&nbsp;</div>"
		);
	});
	$("#enterUsernameModal").closeModal();
}

function goBackToAll(){
	$('ul.tabs').tabs('select_tab', 'allLogs');
	$("#enterUsernameModal").closeModal();
}
