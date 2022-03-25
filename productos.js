function tomar_datos(){
	cve_prod=document.f_productos.cve_prod.value;
	nom_prod=document.f_productos.nom_prod.value;
	tipo_prod=document.f_productos.tipo_prod.value;
	presenta_prod=document.f_productos.presenta_prod.value;
}

function altas() {
	tomar_datos();
	//alert(cve_prod+" "+nom_prod+" "+tipo_prod+" "+presenta_prod);
	if ((cve_prod.length==0) || (nom_prod.length==0) || (tipo_prod.length==0) || (presenta_prod.length==0)) {
		alert("Error, Todos los campos son obligatorios");
		if (cve_prod.length==0) document.f_productos.cve_prod.style.background="red";
		if (nom_prod.length==0) document.f_productos.nom_prod.style.background="red";
		if (tipo_prod.length==0) document.f_productos.tipo_prod.style.background="red";
		if (presenta_prod.length==0) document.f_productos.presenta_prod.style.background="red";
	}
	else{
		document.f_productos.cve_prod.style.background="blue";
		document.f_productos.nom_prod.style.background="blue";
		document.f_productos.tipo_prod.style.background="blue";
		document.f_productos.presenta_prod.style.background="blue";
		url="productos.php?op=1&cve_prod="+cve_prod+"&nom_prod="+nom_prod;
		url=url+"&tipo_prod="+tipo_prod+"&presenta_prod="+presenta_prod;
		// alert(url);
		location.href=url;
	}
}

function bajas(){
	tomar_datos();
	if (cve_prod.length==0){
		alert("Error, se debe indicar la clave de producto a eliminar");
		document.f_productos.cve_prod.style.background="red";
	}
	else{
		document.f_productos.cve_prod.style.background="blue";
		nom_prod="";
		tipo_prod="";
		presenta_prod="";
		if (confirm("Seguro de Eliminar ??")) {
			url="productos.php?op=2&cve_prod="+cve_prod+"&nom_prod="+nom_prod;
			url=url+"&tipo_prod="+tipo_prod+"&presenta_prod="+presenta_prod;
			// alert(url);
			location.href=url;
		}
		else{
			alert("La acción de BAJA a sido CANCELADA");
		}

	}
}

function Consultas(){
	tomar_datos();
	if (cve_prod.length==0){
		alert("Error, se debe indicar la clave de producto a consultar");
		document.f_productos.cve_prod.style.background="red";
	}
	else{
		document.f_productos.cve_prod.style.background="blue";
		nom_prod="";
		tipo_prod="";
		presenta_prod="";
		url="productos.php?op=3&cve_prod="+cve_prod+"&nom_prod="+nom_prod;
		url=url+"&tipo_prod="+tipo_prod+"&presenta_prod="+presenta_prod;
		// alert(url);
		location.href=url;
	}
}

function cambios(){
	tomar_datos();
	if (cve_prod.length==0){
		alert("Error, se debe indicar la clave de producto a modificar");
		document.f_productos.cve_prod.style.background="red";
	}
	else{
		document.f_productos.cve_prod.style.background="blue";
		url="productos.php?op=4&cve_prod="+cve_prod+"&nom_prod="+nom_prod;
		url=url+"&tipo_prod="+tipo_prod+"&presenta_prod="+presenta_prod;
		// alert(url);
		location.href=url;
	}
}