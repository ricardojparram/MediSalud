   $(document).ready(function(){ 

    let rif = $("#rif");
    let razon = $("#razon");
    let direccion = $("#direccion");
    let telefono = $("#telefono");
    let contacto = $("#contacto");
   

    $("#enviar").on("click", function(e){

       let valid1 = /^[0-9][a-zA-Z]{7,60}$/;
       let valid2 = /^[A-Za-z0-9,-\s]+$/g;
       let valid3 = /^[a-zA-Z]{3,30}$/;
       let valid4 =  /^[0-9]{1,12}$/;
       
       a = valid4.test(rif.val());
       b = valid3.test(razon.val());
       c = valid4.test(telefono.val());
       d = valid2.test(direccion.val());

        if(d){
          $("#error_4").attr("style","display:none");
          $("#direccion").attr("style","backgraund-image: none;");
        
        }else{          
          e.preventDefault();
          $("#error_4").attr("style","display:block;block;color: #ff0000; text-align: justify");
          $("#direccion").attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);");         
        }

        
        if(c){
        	$("#error_3").attr("style","display:none");
          $("#telefono").attr("style","backgraund-image: none;");


        }else{
        	e.preventDefault();
        	$("#error_3").attr("style","display:block;block;color: #ff0000; text-align: justify");
          $("#telefono").attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);");
        }

        if(b){
        	$("#error_2").attr("style","display:none");
          $("#razon").attr("style","backgraund-image: none;");


        }else{
        	e.preventDefault();
          $("#error_2").attr("style","display:block;color: #ff0000; text-align: justify");
          $("#razon").attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);");
        }
        if(a){
          $("#error_1").attr("style","display:none");
          $("#rif").attr("style","backgraund-image: none;");


        }else{
          e.preventDefault();
          $("#error_1").attr("style","display:block;color: #ff0000; text-align: justify");
          $("#rif").attr("style","border-color: red; background-image: url(assets/img/Triangulo_exclamacion.png); background-repeat: no-repeat; background-position: right calc(0.375em + 0.1875rem) center; background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);");
        }  
   })
}) 