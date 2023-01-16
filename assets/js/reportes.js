$(document).ready(function(){

	fechaHoy($('#fecha'), $('#fecha2'));

	let tabla, tipo, fechaInicio, fechaFinal;

	$('#generar').click(()=>{
		generarReporte();
	});

	$('#exportar').click(()=>{
		exportarReporte();
	})

	function generarReporte(){
		tipo = $('#tipoReporte').val();
		fechaInicio = $('#fecha').val();
		fechaFinal = $('#fecha2').val();

		if($('#reporteLista tbody tr').length >= 1){
			tabla.destroy();
		}

		if(tipo == "" || tipo == null){
			$('#error').text('Seleccione un tipo de reporte.');
			throw new Error('Seleccione un tipo de reporte.');
		}else{$('#error').text('')}

		let thead, columns;

		switch(tipo){
			case 'venta' : 
			thead = `<tr>
						<th scope="col">Factura N°</th>
						<th scope="col">Cédula</th>
						<th scope="col">Cliente</th>
						<th scope="col">Fecha</th>
						<th scope="col">Monto</th>
					 </tr>`;
			$('#reporteLista thead').html(thead);
			columns = [{data : 'num_fact'},
					   {data : 'cedula'},
					   {data: 'nombre'},
					   {data : 'fecha'},
					   {data : 'monto'}];
			break;

			case 'compra' : 	
			thead = `<tr>
						<th scope="col">Orden de Compra</th>
						<th scope="col">Proveedor</th>
						<th scope="col">Fecha</th>
						<th scope="col">Cantidad de Productos</th>
						<th scope="col">Monto Total</th>
					 </tr>`;
			$('#reporteLista thead').html(thead);	
			columns = [{data : 'orden_compra'},
					   {data : 'razon_social'},
					   {data : 'fecha'},
					   {data : 'cantidad'},
					   {data : 'monto_total'}];
			break;	
			default: $('#error').text('Tipo de reporte inválido.');	 
		}

		$.post('', {mostrar: 'reporte', tipo, fechaInicio, fechaFinal},
			function(data){
				let reporte = JSON.parse(data);
				tabla = $('#reporteLista').DataTable({
							responsive: true,
							data : reporte,
							columns : columns
						});
				$('#reporte').removeClass('d-none');
		});
	}

	function exportarReporte(){
			$.post('',{exportar: 'reporte', tipo, fechaInicio, fechaFinal},function(e){
				data = JSON.parse(e);
				if(data.respuesta == "Archivo guardado"){
					descargarArchivo(data.ruta);
				}else{
					Toast.fire({ icon: 'error', title: 'No se pudo exportar el reporte.' })
				}
			})
	}

	function descargarArchivo(ruta){
		let link=document.createElement('a');
		link.href = ruta;
		link.download = ruta.substr(ruta.lastIndexOf('/') + 1);
		link.click();
	}

})
