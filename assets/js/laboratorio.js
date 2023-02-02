$(document).ready(function(){

	/* --- FUNCIÓN PARA RELLENAR LA TABLA --- */
	rellenar();
	let mostrar
	function rellenar(){ 
		$.ajax({
			type: "post",
			url: "",
			dataType: "json",
			data: {mostrar: "labs" },
			success(data){
				mostrar = $('#tableMostrar').DataTable({
					responsive: true,
					data: data
				})
			}
		})

	}

	/* --- AGREGAR --- */

	// VALIDACIONES
	function validarRif(input, div){
		$.post('',{rif : input.val(), validar: "rif"}, function(data){
			let mensaje = JSON.parse(data);
			if(mensaje.resultado === "Error de rif"){
				div.text(mensaje.error);
				input.attr("style","border-color: red;")
				input.attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);"); 
			}
		})
	}

	$("#rif").keyup(()=> {  let valid = validarCedula($("#rif"),$("#error") ,"Error de RIF,");
		if(valid){
			validarRif($("#rif"), $("#error"));
		}
	});
	$("#razon").keyup(()=> {  validarNombre($("#razon"),$("#error") , "Error de nombre,") });
	$("#direccion").keyup(()=> {  validarDireccion($("#direccion"),$("#error") , "Error de direccion,") });
	$("#telefono").keyup(()=> {  validarTelefono($("#telefono"),$("#error") ,"Error de telefono,") });

	$("#registrar").click((e)=>{
		e.preventDefault()

		let vrif, vnombre, vdireccion, vtelefono;
		validarCedula($("#rif"),$("#error") ,"Error de RIF,");
		vnombre = validarNombre($("#razon"),$("#error") , "Error de nombre,");
		vdireccion = validarDireccion($("#direccion"),$("#error") , "Error de direccion,");
		vtelefono = validarTelefono($("#telefono"),$("#error") ,"Error de telefono,");

		if(!vnombre || !vdireccion || !vtelefono){
			throw new Error('Error.');
		}

		$.ajax({

			type: "post",
			url: '',
			data: {
				rif : $("#rif").val(),
				razon : $("#razon").val(),
				direccion : $("#direccion").val(),
				telefono : $("#telefono").val(),
				contacto : $("#contacto").val()
			},
			success(data){

				if(data.resultado === "Error de rif"){
					$("#error").text(data.error);
					$("#rif").attr("style","border-color: red;")
					$("#rif").attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);"); 
					vrif = false;
				}else{
					vrif = true;
				}

				if(vrif && vnombre && vdireccion && vtelefono){

					mostrar.destroy(); 
					rellenar(); 
					$('#agregarform').trigger('reset'); 
					$('.cerrar').click(); 
					Toast.fire({ icon: 'success', title: 'Laboratorio registrado' }) 

				}   

			}

		})

	})

	/* --- EDITAR --- */
	let id 
    // SELECCIONA ITEM
    $(document).on('click', '.editar', function() {
        id = this.id; // se obtiene el id del botón, previamente le puse de id el codigo en rellenar()
       	// RELLENA LOS INPUTS
       		$.ajax({
       			method: "post",
       			url: "",
       			dataType: "json",
		        data: {select: "labs", id}, // id : id
		        success(data){
		        	$("#rifEdit").val(data[0].rif);
		        	$("#razonEdit").val(data[0].razon_social);
		        	$("#direccionEdit").val(data[0].direccion);
		        	$("#telefonoEdit").val(data[0].telefono);
		        	$("#contactoEdit").val(data[0].contacto);
		        }

		    })

	});



    // VALIDACIONES
	$("#rifEdit").keyup(()=> {  let valid = validarCedula($("#rifEdit"),$("#errorEdit") ,"Error de RIF,") 
		if(valid){
			validarRif($("#rifEdit"), $("#errorEdit"));
		}
	});
	$("#razonEdit").keyup(()=> {  validarNombre($("#razonEdit"),$("#errorEdit") , "Error de nombre,") });
	$("#direccionEdit").keyup(()=> {  validarDireccion($("#direccionEdit"),$("#errorEdit") , "Error de direccion,") });
	$("#telefonoEdit").keyup(()=> {  validarTelefono($("#telefonoEdit"),$("#errorEdit") ,"Error de telefono,") });

	// FORMULARIO DE EDITAR

	$("#editar").click((e)=>{

		e.preventDefault();
    	//VALIDACIONES
    	let vrif, vnombre, vdireccion, vtelefono;
		validarCedula($("#rifEdit"),$("#errorEdit") ,"Error de RIF,");
		vnombre =  validarNombre($("#razonEdit"),$("#errorEdit") , "Error de nombre,");
		vdireccion = validarDireccion($("#direccionEdit"),$("#errorEdit") , "Error de direccion,");
		vtelefono = validarTelefono($("#telefonoEdit"),$("#errorEdit") ,"Error de telefono,");

			// 	ENVÍO DE DATOS
			$.ajax({

				type: "post",
				url: '',
				data: {
					rifEdit : $("#rifEdit").val(),
					razonEdit : $("#razonEdit").val(),
					direccionEdit : $("#direccionEdit").val(),
					telefonoEdit : $("#telefonoEdit").val(),
					contactoEdit : $("#contactoEdit").val(),
					id
				},
				success(r){
					let data = JSON.parse(r);
					if(data.resultado === "Error de rif"){
						$("#errorEdit").text(data.error);
						$("#rifEdit").attr("style","border-color: red;")
						$("#rifEdit").attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);"); 
						throw new Error('Rif ya registrado.');
					}else{
						vrif = true;
					}
					if(vrif ==true && vnombre ==true && vdireccion ==true && vtelefono ==true){					
						mostrar.destroy();
						rellenar(); 
						$('#editarform').trigger('reset');
						$('.cerrar').click();
						Toast.fire({ icon: 'success', title: 'Laboratorio modificado' })
					}
				}

			})

	})

	$(document).on('click', '.cerrar', function() {
		$('#agregarform').trigger('reset'); 
		$('#editarform').trigger('reset');
	});


	$(document).on('click', '.borrar', function() {
		id = this.id;
		console.log(id)
	});

	$('#borrar').click(()=>{
		$.ajax({
			type : 'post',
			url : '',
			data : {eliminar : 'asd', id},
			success(data){
				console.log(id)
				mostrar.destroy();
				$('.cerrar').click();
				rellenar();
				Toast.fire({ icon: 'success', title: 'Laboratorio eliminado' })
			}
		})
	})

})

