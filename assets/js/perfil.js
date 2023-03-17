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

	mostrarUsuarios();
	function mostrarUsuarios(){
		$.post('', {lista: 'mostrar', usuarios: 'usuarios'},
			function(response){
				let usuarios = JSON.parse(response);
				console.log(usuarios);
				let imgDefault = 'assets/img/profile_photo.jpg';
				let lista = '';
				usuarios.forEach(fila =>{
					if(fila.img == null) fila.img = imgDefault

					lista += ` <li class="list-group-item">
			                    <img src="${fila.img}" alt="Profile" class="imgUser">
			                    <p>${fila.nombre}</p>
			                  </li>`
				})
				$('#users').html(lista);
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
						mostrarUsuarios();
						Toast.fire({ icon: 'success', title: 'Usuario Actualizado' });
						$("#perfil").click();
					}
				}
			})

		}

	})

	let actContra;
	function validarContra(input, div){
		let password = input.val();
		$.post('', {password, validarContraseña : 'asd'},
			function(response){
				data = JSON.parse(response);
				if(data.resultado == 'Error de contraseña'){
					actContra = false;
					div.text(data.error);
					input.attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);");							
				}else{
					actContra = true;
				}
			});
	}

	$("#password").keyup(()=> {  let valid = validarContraseña($("#password"),$("#error2") ,"Error de Contraseña Actual,") 
		if(valid){
			validarContra($("#password"),$("#error2"));
		}
	});
	$("#newPassword").keyup(()=> {  validarContraseña($("#newPassword"),$("#error2") ,"Error de Contraseña Nueva,") });
	$("#rePassword").keyup(()=> {  validarRepContraseña($("#rePassword"),$("#error2") ,$("#newPassword")) });
	let contra, reContra;
	$("#editContra").click(()=> {
		reContra = validarRepContraseña($("#rePassword"),$("#error2") ,$("#newPassword"));
		contra = validarContraseña($("#newPassword"),$("#error2") ,"Error de Contraseña Nueva,");

		if (actContra && contra && reContra) {
			$.ajax({
				url:'',
				method: 'post',
				dataType: 'JSON',
				data: {
					passwordAct: $("#password").val(),
					passwordNew: $("#newPassword").val(),
					passwordNewR: $("#rePassword").val()
				},success(des){
					console.log(des);
					if (des.resultado === 'Error de contraseña') {
						$("#error2").text(des.error);
          				$("#password").attr("style","border-color: red;")
          				$("#password").attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);"); 
					}
					if (des.resultado === 'Editada Contraseña') {
						Toast.fire({ icon: 'success', title: 'Contraseña Actualizada' });
						$("#perfil").click();
						$("#profile-change-password input").val("")
					}
				}
			})
		}
	})

})