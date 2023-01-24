 $(document).ready(function(){

  // MOSTRA TABLA CON DATATABLE

     let tablaMostrar;         
     rellenar();
       function rellenar(){
         $.ajax({
          method: "POST",
          url: " ",
          dataType: "json",
          data:{mostrar: "venta"},
          success(data){
            console.log(data)
            tablaMostrar = $('#tableMostrar').DataTable({
              responsive : true,
              data : data
            });
          }
        })
      }
      // MOSTRA DETALLES DE VENTA POR PRODUCTO

      let id;

      $(document).on('click', '.detalleV' , function(){
     
       id = this.id; // id = id
       console.log(id);
       $.post('',{detalleV : 'detV' , id}, function(data){
        let lista = JSON.parse(data);
        console.log(lista);
        let tabla;

         lista.forEach(row=>{
          tabla += `
           <tr>
             <td>${row.descripcion}</td>
             <td>${row.cantidad}</td>
             <td>${row.precio_actual}</td>                      
           </tr>
          `  
        })
         $('#ventaNombre').text(`Numero de Factura #${lista[0].num_fact}.`);
         $('#bodyDetalle').html(tabla);

      })
    })

     
     // FUNCION CALCULATE PARA PRECIOS

      var iva = parseFloat($('#config_iva').val());
      console.log(iva);
      selectOptions();
      calculate();

      function calculate(){
       let total_price = 0,
       total_tax = 0;

    // console.log('Calculando IVA:'+iva);

    $('.table-body tbody tr').each( function(){
         let row = $(this),
         rate = row.find('.rate input').val(),
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
        url: '',
        method: 'POST',
        dataType: 'json',
        data: {
          select: "Prod"
        },
        success(data){
          let option = ""
          data.forEach((row)=>{
            option += `<option value="${row.cod_producto}">${row.descripcion}</option>`
          })
          $('.select-productos').each(function(){
             if(this.children.length == 1){
               $(this).append(option);
               $(this).chosen({
                width: '25vw',
                placeholder_text_single: "Selecciona un producto",
                search_contains: true,
                allow_single_deselect: true,
                });
               calculate();
             }
          })

        }
      })
    } 

      let producto;
    //Selecciona cada producto 
    cambio();
    function cambio(){
       $('.select-productos').change(function(){
         select = $(this);
         producto = $(this).val();
         fillData($(this).val());
       })
    }
    //  Rellena los inputs con el precio y cantidad de cada producto
    function fillData(val){
      $.getJSON('',{producto, fill: "data"}, function(data){
        if(producto == val){
          let cantidad = select.closest('tr').find('.amount input');
          let precio = select.closest('tr').find('.rate input');
          cantidad.val(data[0].stock);
          precio.val(data[0].p_venta);
          calculate();
       }
       
     })
    }
    
    //  SELECT2 CON BOOTSTRAP-5 
    $(".select2").select2({
      theme: 'bootstrap-5',
      dropdownParent: $('#Agregar .modal-body'),
    })
 

     //  fila que se inserta
     let newRow = `<tr>
          <td width="1%"><a class="removeRow a-asd" href="#"><i class="bi bi-trash-fill"></i></a></td>
          <td width='40%'> 
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

    // Agregar fila para insertar producto
     $('.newRow').on('click',function(e){
       filaN();
     });

    // ELiminar fila
     $('body').on('click','.removeRow', function(e){
        $(this).closest('tr').remove();
     });

    //Evento keyup para que funcione calculate()
    $('.table-body').on('keyup','input',function(){
      calculate();
    })

    //configuracion de IVA
     $('#config_iva').on('keyup', function(){
      iva = parseFloat($(this).val())
       
      if(iva < 0 || iva > 100){
       iva = 0
      }
      console.log('valor de iva cambio a : '+iva);
      calculate();

     })
     
     // REGISTRAR VENTA
     

     $('#cedula').keyup(()=> {validarCedula($("#cedula"),$("#error"),"Error de Cedula") });
     $('#metodo').keyup(()=> {validarNumero($("#metodo"),$("#error"),"Error de metodo de pago") });
     $('#monto').keyup(()=> {validarNumero($("#monto"),$("#error"),"Error de monto") });


     $("#registrar").click((e)=>{
       e.preventDefault();

       let cedula =validarCedula($("#cedula"),$("#error"),"Error de Cedula");
       let metodo = validarNumero($("#metodo"),$("#error"),"Error de metodo de pago");
       let montoT = validarNumero($("#monto"),$("#error"),"Error de monto");

       let vproductos = true;

       $('.table-body tbody tr').each(function(){
        let producto = $(this).find('.select-productos').val();
        console.log(producto);
         if(producto == "" || producto == null){
           vproductos = false;
          $('#error').text('No debe haber productos vacíos.')
         }
      })


       if(cedula == true && metodo == true && montoT == true && vproductos == true){

         console.log("Enviando ...");

         $.post('',{
          cedula: $('#cedula').val(),
          metodo: $('#metodo').val(),
          montoT: $('#monto').val()
        },
        function(data){
         let idVenta = JSON.parse(data);
         console.log(idVenta);
         enviarProductos(idVenta.id);
         tablaMostrar.destroy();
            rellenar();  // FUNCIÓN PARA RELLENAR
            $('.select2').val(null).trigger('change'); // LIMPIA EL SELECT2
            $('#agregarform').trigger('reset'); // LIMPIAR EL FORMULARIO
            $('.cerrar').click(); // CERRAR EL MODAL
            $('.removeRow').click(); 
            filaN()
            Toast.fire({ icon: 'success', title: 'Venta registrada' }) // ALERTA 

          })
       }
     })

  //función para enviar productos uno por uno
  function enviarProductos(id){
    $('.table-body tbody tr').each(function(){
     let producto = $(this).find('.select-productos').val();
     let cantidad = $(this).find('.amount input').val();
     let precio = $(this).find('.rate input').val();

     $.post("",{producto, precio , cantidad, id})

    })
  }

  $('#cerrar').click(()=>{
     $('.select2').val(null).trigger('change'); // LIMPIA EL SELECT2
     $('#agregarform').trigger('reset'); // LIMPIAR EL FORMULARIO
     $('.removeRow').click(); // LIMPIAR FILAS 
     filaN() // 
  })

  // ELIMNINAR VENTA

       $(document).on('click', '.borrar', function(){
        id = this.id;

      })   
       
       $("#delete").click(()=>{ 
         console.log(id);
         $.ajax({
          type: "POST",
          url: '',
          data: {eliminar: "asd", id},
          success(data){
            tablaMostrar.destroy();
            rellenar();
            $('.cerrar').click();
              Toast.fire({ icon: 'error', title: 'Venta eliminada' }) // ALERTA 
            }
          })
       })
  

});