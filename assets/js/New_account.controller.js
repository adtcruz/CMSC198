$('document').ready(
	function(){
		$("#mngeApButton").addClass("black");
		$('select').material_select();
});

function addClient(url){

	username = $("#username").val();
	password = $("#password").val();
	givenName = $("#givenName").val();
	lastName = $("#lastName").val();
	designation = $("#designation").val();
	officeId = $("#officeId").val();

	if (username==="") return;
	if (password==="") return;
	if (givenName==="") return;
	if (lastName==="") return;
	if (designation==="") return;
	if (officeId==null) return;

	$.post(url+"create_client",
				{
					username:username,
					password:password,
					givenName:givenName,
					lastName:lastName,
					designation:designation,
					officeId:officeId
				},
				function(data){
					if(data==="Created new client"){
						Materialize.toast("Added!",3000);
						//reset forms
						$("#username").val("");
						$("#password").val("");
						$("#givenName").val("");
						$("#lastName").val("");
						$("#designation").val("");
						$("#officeId").val("");
						$('select').material_select(); //reload materialize select after changing its value
					}
					if(data==="Account already exists"){
						Materialize.toast("Account already exists!",3000);
					}
				}
	);
}
