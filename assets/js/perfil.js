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
				console.log(dato);
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

	$("#enviarDatos").click((e)=>{

		console.log("click")
		e.preventDefault();

		name = validarNombre($("#nameEdit"),$("#error") ,"Error de nombre,");
		lastname = validarNombre($("#apeEdit"),$("#error") ,"Error de apellido,");
		id = validarCedula($("#cedulaEdit"),$("#error") ,"Error de cedula,");
		email = validarCorreo($("#emailEdit"),$("#error") ,"Error de email,");

		if(name && lastname && id && email) {
			$.ajax({
				method: "post",
				url: '',
				dataType: 'JSON',
				data: {
					nombre: $("#nameEdit").val(),
					apellido: $("#apeEdit").val(),
					dni: $("#cedulaEdit").val(),
					correo: $("#emailEdit").val()
				},
				success(pr){
					if (pr.resultado === "Editado") {
						rellenar();
						Toast.fire({ icon: 'success', title: 'Usuario Actualizado' });
						$("#perfil").click();
					}
				}
			})

		}else {
			e.preventDefault();
		}








	})
})