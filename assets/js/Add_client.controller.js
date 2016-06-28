$('document').ready(
	function(){
		//$("#addClientButton").addClass("black");
});

function addClient(url){
	$.post(url+"create_client",
				{
					username:username.value,
					password:password.value,
					givenName:givenName.value,
					lastName:lastName.value,
					designation:designation.value,
					officeId:officeId.value
				},
				function(data){
					if(data==="Created new client") Materialize.toast("Added!",3000);
				}
	);
}
