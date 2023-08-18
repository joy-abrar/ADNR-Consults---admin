var switchStatus = "registryMode" ;

function switchFunction()
{
	console.log(switchStatus);

	switch(switchStatus)
	{
		case 'loginMode' :
		
		document.getElementById('connectionBloc').style.display= "flex" ;
		document.getElementById('createAccountBloc').style.display= "none" ;

		document.getElementById('linkParam1').style.display= "none" ;
		document.getElementById('linkParam2').style.display= "flex" ;
		switchStatus = "registryMode";
		
		break;

		
		case 'registryMode' :
		
		document.getElementById('connectionBloc').style.display = "none";
		document.getElementById('createAccountBloc').style.display = "flex";

		document.getElementById('linkParam1').style.display= "flex" ;
		document.getElementById('linkParam2').style.display= "none" ;
		switchStatus = "loginMode";
		break;
	}
}


var switchStatus2 = "registryMode" ;

function switchFunction2()
{
	console.log(switchStatus2);

	switch(switchStatus2)
	{
		case 'loginMode' :
		
		document.getElementById('connectionBloc2').style.display= "none" ;
		document.getElementById('createAccountBloc2').style.display= "flex" ;
		switchStatus2 = "registryMode";
		
		break;

		
		case 'registryMode' :
		
		document.getElementById('connectionBloc2').style.display = "flex";
		document.getElementById('createAccountBloc2').style.display = "none";
		switchStatus2 = "loginMode";
		break;
	}
}

let passwordStatus = "hidden";

function showOrHide()
{
	console.log("click found !" );

	switch(passwordStatus)
	{

		case 'hidden':
		var getId = document.getElementById("showOrHidePassword");
		getId.className="fa-regular fa-eye-slash" ;
		passwordStatus = "shown";

		var getPasswordId = document.getElementById("inputPasswordForm");
		getPasswordId.type="text";
		break;

		case 'shown':
		var getId = document.getElementById("showOrHidePassword");
		getId.className="fa-regular fa-eye" ;
		passwordStatus = "hidden";		
		
		var getPasswordId = document.getElementById("inputPasswordForm");
		getPasswordId.type="password";
		break;
	
	}
}
 

/*
$('.showhide').click(function() 
{
	$(this).removeClass('myclass');
	$(this).addClass('showhidenew');
});
*/