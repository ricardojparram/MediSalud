$(document).ready(function(){

	clientes();
	ventasHoy();
	ventas();
	comprasHoy();
	compras();

	function clientes(){


		$.ajax({
			method: 'POST',
			url: '',
			dataType: 'json',
			data: {clien: 'lol'},
			success(clin){
				$('#usuarios').text(clin[0].usuario);
				$('#proveedores').text(clin[0].proveedor);
				$('#clientes').text(clin[0].cliente);
				$('#producto').text(clin[0].producto);
			}
		})
	}
	

		function ventas(){
			let opcionV;

		$(document).on('click', '.ventas', function(){
			opcionV = this.id;

		switch(opcionV){
			case 'hoy':
			$('#ventas').text("| Dia");
			break;

			case 'mensual':
			$('#ventas').text("| Mes");
			break;

			case 'anual':
			$('#ventas').text("| Año");
			break;
			default: $('#ventas').text('Tipo de reporte inválido.');	
		}

		$.ajax({
			method: 'POST',
			url: '',
			dataType: 'json',
			data: {
				ventas: 'lalo', opcionV
			},
			success(ven){
				$('#valorV').text(ven[0].venta);
			}
		})
		})
		}

		function ventasHoy(){
			$.ajax({
			method: 'POST',
			url: '',
			dataType: 'json',
			data: {
				ventas: 'lalo', 
				opcionV: 'hoy'
			},
			success(ven){
				$('#valorV').text(ven[0].venta);
			}
		})
		}

		function compras(){
			let opcionC;

		$(document).on('click', '.compras', function(){
			opcionC = this.id;

		switch(opcionC){
			case 'hoy':
			$('#compras').text("| Dia");
			break;

			case 'mensual':
			$('#compras').text("| Mes");
			break;

			case 'anual':
			$('#compras').text("| Año");
			break;
			default: $('#compras').text('Tipo de reporte inválido.');	
		}

		$.ajax({
			method: 'POST',
			url: '',
			dataType: 'json',
			data: {
				compras: 'lalo', opcionC
			},
			success(com){
				$('#valorC').text(com[0].compra);
			}

		})


		})
		}

		function comprasHoy(){
			$.ajax({
			method: 'POST',
			url: '',
			dataType: 'json',
			data: {
				compras: 'lalo', 
				opcionC: 'hoy'
			},
			success(com){
				$('#valorC').text(com[0].compra);
			}

			})
		}

		let ventasG, comprasG, fechas;

		$.post('', {fechas:'asd'}, function(r){
			fechas = JSON.parse(r);
			$.post('',{grafico:'xd', venta:'xd'},function(data){
				ventasG = JSON.parse(data);

				$.post('',{grafico:'xd', compra:'xd'},function(response){
					comprasG = JSON.parse(response);
					new Chart("reportsChart", {
						type: "line",
						xAxisID: [0,5,10,15,20,25],
						data: {
							labels: fechas,
							datasets: [{
								label: "Ventas",
								data: ventasG,
								borderColor: "#efb710",
								borderRadius: 5,
								backgroundColor:"#efb710",
								pointBackgroundColor: "#efb710",
								fill: false
							},
							{
								label: "Compras",
								data: comprasG,
								borderColor: "#189be7",
								pointBackgroundColor: "#189be7",
								fill: false
							}]
						},
						options: {
							plugins: {
								legend: {
									display: true,
									position: 'bottom',
									labels: {
										color: "black",
										usePointStyle: true,
										pointStyle: "circle",

									}

								}
							},
							pointRadius: 4,
							pointHoverRadius: 6,
							pointBorderColor: "white",
							pointBorderWidth: 2,
							tension: 0.2,
							borderWidth: 2.5,
							borderCapStyle: "round",
							responsive: true,
							scales: {
								y: {
									min: 0,
									max: 10
								}
							},
						}
					});
				})
			})
		})


	})