$(document).ready(function(){
	rellenar();
	function rellenar(){
		$.ajax({
			method: "post",
			url: '',
			dataType: 'JSON',
			data: {
				mostrar: 'lol'
			},
			success(dato){
				$('.nombreCompleto').text(dato[0].nombre+' '+dato[0].apellido);
				$('#name').text(dato[0].nombre+' '+dato[0].apellido);
				$('#nivel').text(dato[0].nivel);
				$('#cedula').text(dato[0].cedula);
				$('#email').text(dato[0].correo);

				$('#nameEdit').val(dato[0].nombre);
				$('#apeEdit').val(dato[0].apellido);
				$('#cedulaEdit').val(dato[0].cedula);
				$('#emailEdit').val(dato[0].correo);
			}
		})
	}

	$("#nameEdit").keyup(()=> {  validarNombre($("#nameEdit"),$("#error") ,"Error de nombre,") });
	$("#apeEdit").keyup(()=> {  validarNombre($("#apeEdit"),$("#error") ,"Error de apellido,") });
	$("#cedulaEdit").keyup(()=> {	validarCedula($("#cedulaEdit"),$("#error") ,"Error de cedula,") });
	$("#emailEdit").keyup(()=> {  validarCorreo($("#emailEdit"),$("#error") ,"Error de email,") });
	let name, lastname, id, email;

	$('#borrarFoto').click(()=>{
		$('#imgEditar').attr('src', 'assets/img/profile_photo.jpg');
	})

	$('#foto').change(function(){
		let imagen = $('#foto')[0].files[0];

		if(imagen == null || imagen == ""){
			throw new Error('Imagen inválida');
		}

		let url = URL.createObjectURL(imagen);
		$('#imgEditar').attr('src', url)
	})

	$("#enviarDatos").click((e)=>{

		e.preventDefault();

		name = validarNombre($("#nameEdit"),$("#error") ,"Error de nombre,");
		lastname = validarNombre($("#apeEdit"),$("#error") ,"Error de apellido,");
		id = validarCedula($("#cedulaEdit"),$("#error") ,"Error de cedula,");
		email = validarCorreo($("#emailEdit"),$("#error") ,"Error de email,");



		if(name && lastname && id && email) {

			let form = new FormData($('#formEditar')[0]);

			let borrar = $('#imgEditar').is('[src="assets/img/profile_photo.jpg"]');
			if(borrar){
				form.append("borrar", "borrarImg");
			}

			$.ajax({
				type: "POST",
				url: '',
				dataType: 'JSON',
				data: form,
				contentType: false,
				processData: false,
				success(data){
					
					if(data.foto.respuesta == 'Error'){
						$('#error').text(data.foto.error);
						throw new Error('Error de foto.');
					}
					if(data.foto.respuesta == 'Imagen guardada.' || data.foto.respuesta == 'Imagen eliminada.'){
						$('.fotoPerfil').attr('src', data.foto.url);
					}
					if (data.edit.respuesta == "Editado correctamente") {
						$('#formEditar').trigger('reset');
						rellenar();
						Toast.fire({ icon: 'success', title: 'Usuario Actualizado' });
						$("#perfil").click();
					}
				}
			})

		}

	})

})