$(document).ready(function(){

  fechaHoy($('#fecha'));

   /* --- FUNCIÓN PARA RELLENAR LA TABLA --- */
    let tablaMostrar
    rellenar();
       function rellenar(){
         $.ajax({
          method: "POST",
          url: " ",
          dataType: "json",
          data:{mostrar: "produ"},
          success(data){
            console.log(data);
            tablaMostrar = $('#tableMostrar').DataTable({
              responsive : true, 
              data : data
            });
          }
        })
      }


    $('#descripcion').keyup(()=> {validarString($("#descripcion"),$("#error"),"Error de descripcion") });
    $('#composición').keyup(()=> {validarString($("#composición"),$("#error"),"Error de Composición") });
    $('#posologia').keyup(()=> {validarString($("#posologia"),$("#error"),"Error de posologia") });
    $('#contraIn').keyup(()=> {validarString($("#contraIn"),$("#error"),"Error elige ubicación") });
    $('#cantidad').keyup(()=> {validarNumero($("#cantidad"),$("#error"),"Error de cantidad") });
    $('#precioV').keyup(()=> {validarNumero($("#precioV"),$("#error"),"Error de precio venta") });
   

    /* --- AGREGAR --- */

    $("#boton").click((e)=>{

      let descripcion = validarString($("#descripcion"),$("#error"),"Error de descripcion");
      let composición = validarString($("#composición"),$("#error"),"Error de Composición");
      let posologia = validarString($("#posologia"),$("#error"),"Error de posologia");
      let laboratorio = validarNumero($("#laboratorio"),$("#error"),"Error elige laboratorio");
      let tipo = validarNumero($("#tipoP"),$("#error"),"Error elige tipo producto");
      let clase = validarNumero($("#clase"),$("#error"),"Error elige clase");
      let presentación = validarNumero($("#presentación"),$("#error"),"Error elige presentación");
      let ubicación = validarString($("#ubicación"),$("#error"),"Error elige ubicación");
      let contraIn = validarString($("#contraIn"),$("#error"),"Error elige ubicación");
      let cantidad = validarNumero($("#cantidad"),$("#error"),"Error de cantidad");
      let precioV = validarNumero($("#precioV"),$("#error"),"Error de precio venta");


    $descripcionP = $('#descripcion');
    $fechaVP = $('#fecha');
    $composicionP = $('#composición');
    $posologiaP = $('#posologia');
    $laboratorioP = $('#laboratorio');
    $tipoP = $('#tipoP');
    $clase = $('#clase');
    $presentaciónP = $('#presentación');
    $ubicaciónP = $('#ubicación');
    $contraInP = $('#contraIn');
    $cantidadP = $('#cantidad');
    $precioVenP = $('#precioV');
   
           
        //  ENVÍO DE DATOS
        $.ajax({
        type: "POST",
        url: '',
        dataType: 'json',
        data: {
        "descripcion" : $descripcionP.val(),  
        "fechaV" : $fechaVP.val(),
        "composicionP" : $composicionP.val(),
        "posologia" : $posologiaP.val(),
        "laboratorio" : $laboratorioP.val(),
        "tipoP" : $tipoP.val(),
        "clase" : $clase.val(),
        "presentación" : $presentaciónP.val(),
        "ubicación" : $ubicaciónP.val(),
        "contraIn" : $contraInP.val(),
        "cantidad" : $cantidadP.val(),
        "precioV" : $precioVenP.val(),
        
      },
      success(data){
        
        let vfecha = false;

        if(data.resultado === "Error de fecha"){
          $("#error").text(data.error);
          $("#fecha").attr("style","border-color: red;")
        }else{
           $("#fecha").attr("style","border-color: none;")
          vfecha = true;
         }

        if(descripcion && composición && posologia && laboratorio && tipo && presentación && ubicación && contraIn && cantidad && precioV && vfecha){
          tablaMostrar.destroy()
          rellenar();  // FUNCIÓN PARA RELLENAR
          $('#agregarform').trigger('reset'); // LIMPIAR EL FORMULARIO
          $('.cerrar').click();
          fechaHoy($('#fecha'));
          Toast.fire({ icon: 'success', title: 'Producto registrada' });
          }
        }
      })
        
    

  });

   /* --- EDITAR --- */
   let id;

   $(document).on('click', '.editar', function() {
        id = this.id; // se obtiene el id del botón, previamente le puse de id el codigo en rellenar()
          // RELLENA LOS INPUTS
          $.ajax({
            method: "POST",
            url: "",
            dataType: "json",
            data: {select: "edit", id},
            success(data){
              $("#descripcionEd").val(data[0].descripcion);
              $("#fechaEd").val(data[0].vencimiento);
              $("#composicionEd").val(data[0].composicion);
              $("#laboratorioEd").val(data[0].cod_lab); 
              $("#tipoEd").val(data[0].cod_tipo);
              $("#claseEd").val(data[0].cod_clase);
              $("#presentaciónEd").val(data[0].cod_pres);
              $("#posologiaEd").val(data[0].posologia);
              $("#ubicaciónEd").val(data[0].ubicacion);
              $("#contraInEd").val(data[0].contraindicaciones);
              $("#cantidadEd").val(data[0].stock);
              $("#VentaEd").val(data[0].p_venta);
              
            }

          })
      });
          
      $('#descripcionEd').keyup(()=> {validarString($("#descripcionEd"),$("#error"),"Error de descripcion") });
      $('#composicionEd').keyup(()=> {validarString($("#composicionEd"),$("#error"),"Error de Composición") });
      $('#posologiaEd').keyup(()=> {validarString($("#posologiaEd"),$("#error"),"Error de posologia") });
      $('#contraInEd').keyup(()=> {validarString($("#contraInEd"),$("#error"),"Error elige ubicación") });
      $('#cantidadEd').keyup(()=> {validarNumero($("#cantidadEd"),$("#error"),"Error de cantidad") });
      $('#VentaEd').keyup(()=> {validarNumero($("#VentaEd"),$("#error"),"Error de precio venta") });

     
      // FORMULARIO DE EDITAR

      $("#actualizar").click((e)=>{
          //VALIDACIONES
    let descripcionE = validarString($("#descripcionEd"),$("#error"),"Error de descripcion");
    let composicionE = validarString($("#composicionEd"),$("#error"),"Error de Composición") ;
    let posologiaE = validarString($("#posologiaEd"),$("#error"),"Error de posologia") ;
    let laboratorioE = validarNumero($("#laboratorioEd"),$("#error"),"Error elige laboratorio");
    let tipoE = validarNumero($("#tipoEd"),$("#error"),"Error elige tipo producto");
    let claseE = validarNumero($("#claseEd"),$("#error"),"Error elige clase");
    let presentaciónE = validarNumero($("#presentaciónEd"),$("#error"),"Error elige presentación");
    let ubicaciónE = validarString($("#ubicaciónEd"),$("#error"),"Error elige ubicación");
    let contraInE = validarString($("#contraInEd"),$("#error"),"Error elige ubicación");
    let cantidadE = validarNumero($("#cantidadEd"),$("#error"),"Error de cantidad");
    let VentaE = validarNumero($("#VentaEd"),$("#error"),"Error de precio venta");
   

  if(descripcionE == true && composicionE == true && posologiaE == true && laboratorioE == true && tipoE == true && claseE == true  && presentaciónE == true && ubicaciónE == true && contraInE == true && cantidadE == true && VentaE == true){ 
      
      //  ENVÍO DE DATOS
        $.ajax({
        type: "POST",
        url: '',
        dataType: "json",
        data: {
        descripcionEd : $('#descripcionEd').val(),
        fechaEd : $('#fechaEd').val() ,
        composicionEd : $('#composicionEd').val(), 
        posologiaEd: $('#posologiaEd').val(),
        laboratorioEd : $('#laboratorioEd').val() ,
        tipoEd : $('#tipoEd').val() ,
        claseEd : $('#claseEd').val(),
        presentaciónEd : $('#presentaciónEd').val() ,
        ubicaciónEd : $('#ubicaciónEd').val() ,
        contraInEd : $('#contraInEd').val() ,
        cantidadEd : $('#cantidadEd').val() ,
        VentaEd : $('#VentaEd').val() ,
        id 
        },
        success(result){
        console.log(result);
         tablaMostrar.destroy();
          rellenar();  // FUNCIÓN PARA RELLENAR
          $('#editarform').trigger('reset');
          $('#Cancelar').click();
          Toast.fire({ icon: 'success', title: 'Producto Actualizado' });
        }
      }) 
        e.preventDefault();
           
      }else{
        console.log('error');
       e.preventDefault();
      }
    
  })


    /* --- ELIMINAR --- */


    $(document).on('click','.borrar', function(){
     id = this.id;

   })

    $('#delete').click(()=>{
      console.log(id);
      $.ajax({
        type: 'POST',
        url: '',
        data: {delete : 'delete' , id},
        success(data){
          tablaMostrar.destroy();
          rellenar();
          $('.cerrar').click();
          Toast.fire({ icon: 'success', title: 'producto anulado' }) // ALERTA 
        }
      })
    })



});