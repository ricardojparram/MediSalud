$(document).ready(function() {


	fechaHoy($('#fecha'));

	rellenar();
// 	Rellena la tabla con las compras registradas
	let tablaMostrar;
	function rellenar(){ 
		$.ajax({
			method: "post",
			url: "",
			dataType: "json",
			data: {mostrar: "compras" },
			success(data){
				tablaMostrar = $('#tableMostrar').DataTable({
					responsive: true,
					data : data
				});
			}
		})

	}

// 	Rellena los detalles de compra con los productos de la compra indicada
	$(document).on('click', '.detalleCompra', function() {
		id = this.id; 
		$.post('', {detalleCompra: 'xd', id}, function(data){
			let lista = JSON.parse(data);
			let tabla;
			lista.forEach(row => {
				tabla += `
				<tr>
					<td>${row.descripcion}</td>
					<td>${row.cantidad}</td>
					<td>${row.precio_compra}</td>                      
				</tr>
				`
			})
			$('#compraNombre').text(`Orden de compra #${lista[0].orden_compra}.`);
			$('#bodyDetalle').html(tabla);
		})

	});

    var iva = parseFloat($('#config_iva').val());

	calculate();
	selectOptions();

	function calculate(){

		let total_price = 0,
		total_tax = 0;

		$('.table-body tbody tr').each( function(){
			let row = $(this),
			rate   = row.find('.rate input').val(),
			amount = row.find('.amount input').val();

			let sum = rate * amount;
			let tax = ("0."+iva)*sum;


			total_price = total_price + sum;
			total_tax = total_tax + tax;

			row.find('.sum').text( sum.toFixed(2) );
			row.find('.tax').text( tax.toFixed(2) );   

		});
		let precioTotal = (total_price + total_tax).toFixed(2);
		let ivatotal = total_tax.toFixed(2);
		let total = total_price.toFixed(2);

		$('#montos').text(`IVA: ${ivatotal} - Total: ${total}`)
		$('#montos2').text(`Total + IVA: ${precioTotal}`)
		$('#monto').val(precioTotal)


	}
//  rellena los select de las filas de productos
	function selectOptions(){
		$.ajax({
			url:'',
			type: 'post',
			dataType: 'json',
			data: {
				select: 'xd'
			},
			success(data){
				let option = ""
				data.forEach((row)=>{
					option += `<option value="${row.cod_producto}">${row.descripcion}</option>`;
				})
				$('.select-productos').each(function(){
					if(this.children.length == 1){
						$(this).append(option)
						$(this).chosen({
							width: '100%',
							no_results_text: 'No hay resultados para',
							placeholder_text_single: "Selecciona un producto",
							allow_single_deselect: true,
						});

						calculate()
					}
				})

			}
		})
	}

	let producto;
	let select;

// 	Selecciona cada producto
	cambio();
	function cambio(){
		$('.select-productos').change(function(){
			select = $(this);
			producto  = $(this).val();
			fillData($(this).val());
		})
	}

// 	Rellena los inputs con el precio y cantidad de cada producto
	function fillData(val){
		$.getJSON('', {producto, fill: 'data'}, function(data){
			if(producto == val){
				let cantidad = select.closest('tr').find('.amount input');
				let precio = select.closest('tr').find('.rate input');
				cantidad.val(data[0].stock);
				precio.val(data[0].p_venta);
				calculate()
			}
		})	
	}

//  fila que se inserta
	let newRow = `<tr>
					<td width="1%"><a class="removeRow a-asd" href="#"><i class="bi bi-trash-fill"></i></a></td>
					<td width='30%'> 
					<select class="select-productos select-asd">
						<option></option>
					</select>
					</td>
					<td width='10%' class="amount"><input class="select-asd" type="number" value=""/></td>
					<td width='10%' class="rate"><input class="select-asd" type="number" value="" /></td>
					<td width='10%'class="tax"></td>
					<td width='10%' class="sum"></td>
				  </tr>`;

	function filaN(){
		$('#ASD').append(newRow);
		selectOptions();
		cambio();
	}
//  Agrega fila para insertar producto
	$('.newRow').on('click',function(e){
		filaN()
	});

//  Elimina fila 
	$('body').on('click','.removeRow',function(e){
		$(this).closest('tr').remove();
	});

//  Evento keyup para que funcione calculate()
	$('.table-body').on('keyup','input',function(){
		calculate();
	});

// 	configuración de IVA
	$('#config_iva').on('keyup',function(){
		iva = parseFloat($(this).val());

		if (iva < 0 || iva > 100){
			iva = 0;
		}
		calculate();
	});

// 	validaciones keyup
	$('#orden').keyup(()=>{	validarNumero($('#orden'), $('#error'), "Error de Orden,")	})

//	regristro de la compra
	$('#registrar').click((e)=>{
		e.preventDefault()

		let vorden = validarNumero($('#orden'), $('#error'), "Error de Orden,");
		let vproductos = true;

		$('.table-body tbody tr').each(function(){
			let producto = $(this).find('.select-productos').val();
			if(producto == "" || producto == null){
				vproductos = false;
				$('#error').text('No debe haber productos vacíos.');
			}else{
				$('#error').text('');
			}
		})

		if(vorden && vproductos){

			$.post('',{
				proveedor : $('#proveedor').val(),
				orden : $('#orden').val(),
				fecha : $('#fecha').val(),
				montoT : $('#monto').val()
			},
			function(data){
				let idCompra = JSON.parse(data);
				enviarProductos(idCompra.id);
				tablaMostrar.destroy();
				rellenar();
				$('#agregarform').trigger('reset');
				$('.cerrar').click();
				$('.removeRow').click(); 
				fechaHoy($('#fecha'));
				Toast.fire({ icon: 'success', title: 'Compra registrada' })
				filaN()
			})

		}

	})

	//función para enviar productos uno por uno
	function enviarProductos(id){
		$('.table-body tbody tr').each(function(){
			let producto = $(this).find('.select-productos').val();
			let cantidad = $(this).find('.amount input').val();
			let precio = $(this).find('.rate input').val();

			$.post('',{cantidad, precio, producto, id})

		})
	}

	$(document).on('click', '.borrar', function() {
    	id = this.id;
    });

	$('#borrar').click(()=>{
		$.ajax({
			type : 'post',
			url : '',
			data : {eliminar : 'asd', id},
			success(data){
				tablaMostrar.destroy();
				$('.cerrar').click();
				Toast.fire({ icon: 'success', title: 'Compra eliminada' })
				rellenar();
			}
		})
	})

	$('#cancelar').click(()=>{
		$('#agregarform').trigger('reset');
		$('.removeRow').click(); 
		filaN()
		fechaHoy($('#fecha'));
	})


});



