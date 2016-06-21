$(document).ready(
	function(){
		if(!($('body').hasClass('light-blue')&&$('body').hasClass('lighten-1'))){
			$('body').addClass('light-blue');
			$('body').addClass('lighten-1');
		}
	}
);

//php passes the base url via onclick value/function call in the document
//javascript function handling the login 
function logIn(url){
	//gets the username from the username input
	uname = usernameInput.value;
	//gets the password from the password input
	pword = passwordInput.value;
	
	//do not proceed to AJAX if either username or password fields are blank
	if (uname === "") return;
	if (pword === "") return;
	
	//jQuery post communication
	//communicates to the API
	//first argument is the API URL
	//second argument is the JSON format of the key-value pairs to be sent
	//third argument is an anonymous function that handles the event 
	$.post(url+'login',{username:uname,password:pword}, function(data){
		
		//if the event received a "Logged-on" message
		if(data === "Logged-on"){
			//manually redirect to the base url
			window.location.href = url;	 
		}
		//if the event received an "Invalid" message
		else if (data === "Invalid"){
			//tell the user that it entered an invalid credentials
			
			//adding the "invalid" class in an input field should display the error message contained
			//in the data-error attribute's value in the label 
			
			//if usernameInput and passwordInput do not have "invalid" classes
			if(!($("#usernameInput").hasClass("invalid")&&$("#passwordInput").hasClass("invalid"))){
				
				//adds the "invalid" classes to the username and password input fields
				$("#usernameInput").addClass("invalid");
				$("#passwordInput").addClass("invalid");
				
				//appends several spaces to the username and password input labels to properly display the error messages
				$("#usernameInputLabel").html(
				"Username&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
				"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
				"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
				"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
				"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
				"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
				"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
				"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
				"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
				"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
				);
				$("#passwordInputLabel").html(
				"Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
				"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
				"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
				"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
				"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
				"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
				"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
				"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
				"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
				"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
				);
			}
		}
	});
}

//javascript function handling the changes in the input fields
//removes the error messages in the event of a change in the input fields in case they have the invalid class
function logInFormOnChange(){
	if($("#usernameInput").hasClass("invalid")&&$("#passwordInput").hasClass("invalid")){
		
		//removes the invalid classes from the input fields
		$("#usernameInput").removeClass("invalid");
		$("#passwordInput").removeClass("invalid");
		
		//removes the spaces from the input labels
		$("#usernameInputLabel").text("Username");
		$("#passwordInputLabel").text("Password");
	}
}