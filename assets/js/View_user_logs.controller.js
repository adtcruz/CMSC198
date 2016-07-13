$('document').ready(
	function(){
		$("#mngeApButton").addClass("black");
		$('ul.tabs').tabs();
	}
);

//function that gets login logs table from the API
//displays the table in the div with the id logInLogs
function getLogInLogs(url){
	$.post(url+"get_logs",{filter:"login"},function(data) {
		$("#logInLogs").html(
			"<div class=\"col s1 m1 l1\">&nbsp;</div><div class=\"col s10 m10 l10\">"+data+
			"</div><div class=\"col s1 m1 l1\">&nbsp;</div>"
		);
	});
}

//function that gets logout logs table from the API
//displays the table in the div with the id logInLogs
function getLogOutLogs(url){
	$.post(url+"get_logs",{filter:"logout"},function(data) {
		$("#logOutLogs").html(
			"<div class=\"col s1 m1 l1\">&nbsp;</div><div class=\"col s10 m10 l10\">"+data+
			"</div><div class=\"col s1 m1 l1\">&nbsp;</div>"
		);
	});
}

//function that gets jobActions logs table from the API
//displays the table in the div with the id logInLogs
function getJobActionsLogs(url){
	$.post(url+"get_logs",{filter:"jobActions"},function(data) {
		$("#jobActionsLogs").html(
			"<div class=\"col s1 m1 l1\">&nbsp;</div><div class=\"col s10 m10 l10\">"+data+
			"</div><div class=\"col s1 m1 l1\">&nbsp;</div>"
		);
	});
}

//function that gets user logs table from the API
//displays the table in the div with the id logInLogs
//resets the username input
//closes the enter username modal
function getUsersLogs(url){
	usernameVal = $("#usernameInput").val();
	$.post(url+"get_logs",{filter:"byUser",username:usernameVal},function(data) {
		$("#searchByUser").html(
			"<div class=\"col s1 m1 l1\">&nbsp;</div><div class=\"col s10 m10 l10\">"+data+
			"</div><div class=\"col s1 m1 l1\">&nbsp;</div>"
		);
	});
	$("#usernameInput").val("");
	$("#enterUsernameModal").closeModal();
}

//selects the all logs tab
function goBackToAll(){
	$('ul.tabs').tabs('select_tab', 'allLogs');
	$("#enterUsernameModal").closeModal();
}
