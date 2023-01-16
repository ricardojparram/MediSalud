$(document).ready(function(){

  $("#boton").click((e)=>{
    e.preventDefault()
    $.ajax({

      type: "post",
      url: '',
      dataType: 'json',
      data: {
        email: $("#email").val(),
      },
      success(data){
        let vemail
        validarCorreo($("#email"),$("#error") ,"Error de correo,")

        if(data.resultado === "Error de email"){
          $("#error").text(data.error);
          $("#cedula").attr("style","border-color: red;")
          $("#cedula").attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);"); 
        }else{
          vemail = true;
        }

        if(vemail){

          Swal.fire({
            title: 'Correo enviado!',
            text: 'La contraseña se ha enviado a su correo.',
            icon: 'success',
          })
          setTimeout(function(){
            location = '?url=login'
          }, 1600);

        }


      }

    })
  })

});
