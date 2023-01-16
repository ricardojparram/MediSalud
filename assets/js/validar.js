// expresiones regulares 


const expresiones = {
	nombre: /^[a-zA-Z]{0,30}$/,
	correo: /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/,
	direccion: /^[a-zA-Z]+([a-zA-Z0-9\s#/,.-]){7,50}$/,
	cedula: /^[0-9]{7,10}$/
}

function validarNombre(input, div, mensaje){
	parametro = input.val();
	let valid = expresiones.nombre.test(parametro);

	if (parametro==null||parametro=="") {
		div.text(mensaje+" debe introducir datos.")
		input.attr("style","border-color: red;")
		input.attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);");															
		return false
	}else if (!valid) {
		div.text(mensaje+" el nombre debe ser solo letras")	
		input.attr("style","border-color: red;")
		input.attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);");						
		return false
	}else if (parametro.length<3) {
		div.text(mensaje+" el nombre debe tener mínimo 3 carácteres.")	
		input.attr("style","border-color: red;")
		input.attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);");									
		return false
	}else{
		div.text(" ");
		input.attr("style","border-color: none;")
		input.attr("style","backgraund-image: none;");	
		return true
	}			             
}	

function validarDireccion(input, div, mensaje){
	parametro = input.val();
	let valid = expresiones.direccion.test(parametro);
	if (parametro==null||parametro=="") {
		div.text(mensaje+" debe intruducir la dirección.")
		input.attr("style","border-color: red;")
		input.attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);");								
		return false
	}else if(!valid){
		div.text(mensaje+" debe intruducir una dirección válida")
		input.attr("style","border-color: red;")
		input.attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);");		
		return false
	}else{
		div.text(" ");
		input.attr("style","border-color: none;")
		input.attr("style","backgraund-image: none;");
		return true
	}	
}

function validarString(input, div, mensaje){
	parametro = input.val();
	if (parametro==null||parametro=="") {
		div.text(mensaje+" debe introducir datos.")	
		input.attr("style","border-color: red;")
		input.attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);");														
		return false
	}else if (!isNaN(parametro)) {
		div.text(mensaje+" debe ser solo letras")	
		input.attr("style","border-color: red;")
		input.attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);");							
		return false
	}else{
		div.text(" ");
		input.attr("style","border-color: none;")
		input.attr("style","backgraund-image: none;");
		return true
	}			             
}

function validarNumero(input, div, mensaje){
	parametro = input.val();
	if (parametro==null||parametro=="") {
		div.text(mensaje+" debe introducir datos.")	
		input.attr("style","border-color: red;")
		input.attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);");														
		return false
	}else if (isNaN(parametro)) {
		div.text(mensaje+" debe ser solo números.")	
		input.attr("style","border-color: red;")
		input.attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);");							
		return false
	}else{
		div.text(" ");
		input.attr("style","border-color: none;")
		input.attr("style","backgraund-image: none;");
		return true
	}			             
}

function validarTelefono(input, div, mensaje){
	parametro = input.val();
	if (parametro==null||parametro=="") {
		div.text(mensaje+" debe introducir datos.")	
		input.attr("style","border-color: red;")
		input.attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);");														
		return false
	}else if (isNaN(parametro)) {
		div.text(mensaje+" debe ser solo números.")	
		input.attr("style","border-color: red;")
		input.attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);");							
		return false
	}else if (parametro.length<10){
		div.text(mensaje+" debe introducir mínimo 10 carácteres.")	
		input.attr("style","border-color: red;")
		input.attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);");														
		return false	
	}else{
		div.text(" ");
		input.attr("style","border-color: none;")
		input.attr("style","backgraund-image: none;");
		return true
	}			             
}						

function validarCedula(input, div, mensaje){
	parametro = input.val();
	if (parametro==null||parametro=="") {
		div.text(mensaje+" debe introducir datos.")	
		input.attr("style","border-color: red;")	
		input.attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);");														
		return false
	}else if (isNaN(parametro)) {
		div.text(mensaje+" debe ser solo números.")	
		input.attr("style","border-color: red;")
		input.attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);");							
		return false
	}else if (parametro.length<7) {
		div.text(mensaje+" debe tener mínimo 7 caracteres.")
		input.attr("style","border-color: red;")
		input.attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);");								
		return false
	}else{
		div.text(" ");
		input.attr("style","border-color: none;")
		input.attr("style","backgraund-image: none;");
		return true
	}			             
}	

function validarContraseña(input, div, mensaje){
	parametro = input.val();
	if (parametro==null||parametro=="") {
		div.text(mensaje+" debe introducir datos.")	
		input.attr("style","border-color: red;")	
		input.attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);");								
		return false
	}else if (parametro.length<8) {
		div.text(mensaje+" debe tener un mínimo de 8 caracteres.")	
		input.attr("style","border-color: red;")			
		input.attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);");				
		return false
	}else{
		div.text(" ");
		input.attr("style","border-color: none;")
		input.attr("style","backgraund-image: none;");
		return true
	}			             
}

function validarRepContraseña(input, div, inputDos){
	parametro = input.val();
	parametroDos = inputDos.val();
	if (parametro==null||parametro=="") {
		div.text("Debe introducir datos.")	
		input.attr("style","border-color: red;")	
		input.attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);");								
		return false
	}else if(parametro!=parametroDos){
		div.text("Las contraseñas deben coincidir.");
		input.attr("style","border-color: red;")
		input.attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);");
		return false
	}else{
		div.text(" ");
		input.attr("style","border-color: none;")
		input.attr("style","backgraund-image: none;");
		return true
	}
} 

function validarCorreo(input, div, mensaje){
	parametro = input.val();
	let valid = expresiones.correo.test(parametro);

	if (parametro==null||parametro=="") {
		div.text(mensaje+" debe introducir datos.")	
		input.attr("style","border-color: red;")	
		input.attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);");								
		return false
	}
	if(!valid){
		div.text(mensaje+" debe introducir un correo válido.")
		input.attr("style","border-color: red;")
		input.attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);");
		return false
		
	}else{
		div.text(" ");
		input.attr("style","border-color: none;")
		input.attr("style","backgraund-image: none;")
		return true
	}
}	


  function validarCorreoOp(input, div, mensaje){
    parametro = input.val();
    let valid = expresiones.correo.test(parametro);

  if (parametro==null||parametro=="") {
    div.text(" ");
    input.attr("style","border-color: none;")
    input.attr("style","backgraund-image: none;")
    return true
  }
  if(!valid){
    div.text(mensaje+" debe introducir un correo válido.")
    input.attr("style","border-color: red;")
    input.attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);");
    return false
    
  }else{
    div.text(" ");
    input.attr("style","border-color: none;")
    input.attr("style","backgraund-image: none;")
    return true
  }
}

function validarTelefonoOp(input, div, mensaje){
  parametro = input.val();
  if (parametro==null||parametro=="") {
    div.text(" ");
    input.attr("style","border-color: none;")
    input.attr("style","backgraund-image: none;");
    return true                           
  }else if (isNaN(parametro)) {
    div.text(mensaje+" debe ser solo números.") 
    input.attr("style","border-color: red;")
    input.attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);");             
    return false
  }else if (parametro.length<10){
    div.text(mensaje+" debe introducir mínimo 10 carácteres.")  
    input.attr("style","border-color: red;")
    input.attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);");                           
    return false  
  }else{
    div.text(" ");
    input.attr("style","border-color: none;")
    input.attr("style","backgraund-image: none;");
    return true
    }
  }


Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,10);
});
const fechaActual = new Date().toDateInputValue();

// FUNCION PARA INSERTAR FECHAS ACTUALES
function fechaHoy(...input){
	input.forEach((n) =>{
		n.val(fechaActual)
	})
}

// FUNCION PARA ALERTA

const Toast = Swal.mixin({ 
				toast: true, 
				position: 'top-end', 
				showConfirmButton: false, 
				timer: 4000, timerProgressBar: true, 
				didOpen: (toast) => { 
					toast.addEventListener('mouseenter', Swal.stopTimer) 
					toast.addEventListener('mouseleave', Swal.resumeTimer) } 
			  }) 

// INICIALIZADOR DE POPPERS

const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))