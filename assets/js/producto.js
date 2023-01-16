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


    $('#descripcion').keyup(()=> {validarString($("#descripcion"),$("#error"),"Error de descripcion,") });
    $('#composición').keyup(()=> {validarString($("#composición"),$("#error"),"Error de Composición,") });
    $('#posologia').keyup(()=> {validarString($("#posologia"),$("#error"),"Error de posologia,") });
    $('#laboratorio').keyup(()=> {validarNumero($("#laboratorio"),$("#error"),"Error elige laboratorio,") });
    $('#tipoP').keyup(()=> {validarNumero($("#tipoP"),$("#error"),"Error elige tipo producto,") });
    $('#presentación').keyup(()=> {validarNumero($("#presentación"),$("#error"),"Error elige presentación,") });
    $('#ubicación').keyup(()=> {validarString($("#ubicación"),$("#error"),"Error elige ubicación") });
    $('#contraIn').keyup(()=> {validarString($("#contraIn"),$("#error"),"Error elige ubicación,") });
    $('#cantidad').keyup(()=> {validarNumero($("#cantidad"),$("#error"),"Error de cantidad,") });
    $('#precioV').keyup(()=> {validarNumero($("#precioV"),$("#error"),"Error de precio venta,") });
   

    /* --- AGREGAR --- */

    $("#boton").click((e)=>{

    $descripcionP = $('#descripcion');
    $fechaVP = $('#fecha');
    $composicionP = $('#composición');
    $posologiaP = $('#posologia');
    $laboratorioP = $('#laboratorio');
    $tipoP = $('#tipoP');
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
        "presentación" : $presentaciónP.val(),
        "ubicación" : $ubicaciónP.val(),
        "contraIn" : $contraInP.val(),
        "cantidad" : $cantidadP.val(),
        "precioV" : $precioVenP.val(),
        
      },
      success(data){
        
        let vfecha = false;

        let descripcion = validarString($("#descripcion"),$("#error"),"Error de descripcion,");
        let composición = validarString($("#composición"),$("#error"),"Error de Composición,");
        let posologia = validarString($("#posologia"),$("#error"),"Error de posologia,");
        let laboratorio = validarNumero($("#laboratorio"),$("#error"),"Error elige laboratorio,");
        let tipo = validarNumero($("#tipoP"),$("#error"),"Error elige tipo producto,");
        let presentación = validarNumero($("#presentación"),$("#error"),"Error elige presentación,");
        let ubicación = validarString($("#ubicación"),$("#error"),"Error elige ubicación");
        let contraIn = validarString($("#contraIn"),$("#error"),"Error elige ubicación,");
        let cantidad = validarNumero($("#cantidad"),$("#error"),"Error de cantidad,");
        let precioV = validarNumero($("#precioV"),$("#error"),"Error de precio venta,");

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
              $("#presentaciónEd").val(data[0].cod_pres);
              $("#posologiaEd").val(data[0].posologia);
              $("#ubicaciónEd").val(data[0].ubicacion);
              $("#contraInEd").val(data[0].contraindicaciones);
              $("#cantidadEd").val(data[0].stock);
              $("#VentaEd").val(data[0].p_venta);
              
            }

          })
      });
          
      $('#descripcionEd').keyup(()=> {validarString($("#descripcionEd"),$("#error"),"Error de descripcion,") });
      $('#composicionEd').keyup(()=> {validarString($("#composicionEd"),$("#error"),"Error de Composición,") });
      $('#posologiaEd').keyup(()=> {validarString($("#posologiaEd"),$("#error"),"Error de posologia,") });
      $('#laboratorioEd').keyup(()=> {validarNumero($("#laboratorioEd"),$("#error"),"Error elige laboratorio,") });
      $('#tipoEd').keyup(()=> {validarNumero($("#tipoEd"),$("#error"),"Error elige tipo producto,") });
      $('#presentaciónEd').keyup(()=> {validarNumero($("#presentaciónEd"),$("#error"),"Error elige presentación,") });
      $('#ubicaciónEd').keyup(()=> {validarString($("#ubicaciónEd"),$("#error"),"Error elige ubicación") });
      $('#contraInEd').keyup(()=> {validarString($("#contraInEd"),$("#error"),"Error elige ubicación,") });
      $('#cantidadEd').keyup(()=> {validarNumero($("#cantidadEd"),$("#error"),"Error de cantidad,") });
      $('#VentaEd').keyup(()=> {validarNumero($("#VentaEd"),$("#error"),"Error de precio venta,") });

     
      // FORMULARIO DE EDITAR

      $("#Actualizar").click((e)=>{
          //VALIDACIONES
    let descripcionE = validarString($("#descripcionEd"),$("#error"),"Error de descripcion,");
    let composicionE = validarString($("#composicionEd"),$("#error"),"Error de Composición,") ;
    let posologiaE = validarString($("#posologiaEd"),$("#error"),"Error de posologia,") ;
    let laboratorioE = validarNumero($("#laboratorioEd"),$("#error"),"Error elige laboratorio,");
    let tipoE = validarNumero($("#tipoEd"),$("#error"),"Error elige tipo producto,");
    let presentaciónE = validarNumero($("#presentaciónEd"),$("#error"),"Error elige presentación,");
    let ubicaciónE = validarString($("#ubicaciónEd"),$("#error"),"Error elige ubicación");
    let contraInE = validarString($("#contraInEd"),$("#error"),"Error elige ubicación,");
    let cantidadE = validarNumero($("#cantidadEd"),$("#error"),"Error de cantidad,");
    let VentaE = validarNumero($("#VentaEd"),$("#error"),"Error de precio venta,");
   

  if(descripcionE == true && composicionE == true && posologiaE == true && laboratorioE == true && tipoE == true && presentaciónE == true && ubicaciónE == true && contraInE == true && cantidadE == true && VentaE == true){ 
   
      let descripcionEd = $('#descripcionEd').val();
      let fechaEd = $('#fechaEd').val();
      let composicionEd = $('#composicionEd').val();
      let posologiaEd = $('#posologiaEd').val();
      let laboratorioEd = $('#laboratorioEd').val();
      let tipoEd = $('#tipoEd').val();
      let presentaciónEd = $('#presentaciónEd').val();
      let ubicaciónEd = $('#ubicaciónEd').val();
      let contraInEd = $('#contraInEd').val();
      let cantidadEd = $('#cantidadEd').val();
      let VentaEd = $('#VentaEd').val();
      
      //  ENVÍO DE DATOS
        $.ajax({
        type: "POST",
        url: '',
        dataType: "json",
        data: {
        descripcionEd ,
        fechaEd,
        composicionEd, 
        posologiaEd,
        laboratorioEd ,
        tipoEd ,
        presentaciónEd ,
        ubicaciónEd ,
        contraInEd ,
        cantidadEd ,
        VentaEd ,
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
           
      }else{
       e.preventDefault();
      }
    
  })


    /* --- ELIMINAR --- */


  $(document).on('click','.borrar', function(){
   id = this.id;
   console.log(id);
   $('#delete').click(()=>{
     $.ajax({
        type: 'POST',
        url: '',
        data: {delete : 'delete' , id},
        success(data){
          tablaMostrar.destroy();
          rellenar();
          $('.cerrar').click();
          Toast.fire({ icon: 'error', title: 'producto anulado' }) // ALERTA 
         }
      })
    })
  })


});