// 1ERE VERIFICATION : en JavaScript
function validLivredor(){
	var error 			= '';
	var setfocus 		= 0;
	var idnom 			= document.getElementById('idnom');
	var idmessage 		= document.getElementById('idmessage');
	var idmail 			= document.getElementById('idmail');	// PAS obligatoire
 
	// Vérification des champs obligatoires 
	if(idnom.value == '' || idnom.value.length < 2) {
		error += '- nom\n';
		if(setfocus == 0) { idnom.focus();  }
		setfocus += 1;
	}
	if(idmessage.value=='') {
		error += '- Message\n';
		if(setfocus == 0) { idmessage.focus();  }
		setfocus += 1;
	}
	// erreur ? 
	if(error!='') {
		if(setfocus==1) { alert('Merci de remplir le champ obligatoire :\n\n'+error); }
		else { alert('Merci de remplir les champs obligatoires :\n\n'+error); }
		return false;
	}
	else {
		document.submit();
	}
}
