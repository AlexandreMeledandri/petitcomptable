function catChange() {
	var idCat 		= document.getElementById("idCategory").value;
	var typeElem 	= document.getElementById("type");
	var isVisible = 1;
	if(idCat == 7 && typeElemen) {
		type.options[type.options.length - 1] = null;
	}else {
		type.options[type.options.length] = new Option('Crédit', 'credit');
	}
}
