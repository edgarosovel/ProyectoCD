var sql = { 
	controller: "",
	whereAtt: "",
	whereValue: "",
	order: "",
	page: "true"
};

function loadController( controlador ){
	sql['controller'] = controlador;
}

function setWhere(){
	campo = document.getElementById('campoBusqueda').value;
	valor = document.getElementById('valorBusqueda').value;

	if( campo != null && campo != '' && 
		valor != null && valor != ''){

		sql['whereAtt'] = campo;
		sql['whereValue'] = valor;
		sql['order']='';
		sql['page']='true';
		cargarConsulta();
	} else {
		alert("Escoge un criterio y un valor para filtrar");
	}
}

function setOrder(campo, tipo){

	if( campo != null && campo != '' &&
		tipo != null && tipo != ''){
		sql['order'] = campo+" "+tipo;
		sql['page']='true';
		cargarConsulta();
	}
}

function setPage( page ){
	if( page != null && page != ''){
		sql['page'] = page;
		cargarConsulta();
		
	}
}

function cargarConsulta(){
	var url = config['url']+sql['controller']+'/consultaFiltro/';
	var datos = "whereAtt=" + sql['whereAtt'] + "&whereValue=" + sql['whereValue'] + 
		"&order=" + sql['order'] + "&page="+sql['page'];

	consulta = new XMLHttpRequest();
	consulta.open("POST", url ,true);
	consulta.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	consulta.send(datos);

	consulta.onreadystatechange = function (){
		if (consulta.readyState == 4) {
			document.getElementById('consultaFiltro').innerHTML = consulta.responseText;
		}
	}
}