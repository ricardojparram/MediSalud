$(document).ready(function(){
  let tabla
  rellenar();

  function rellenar(){
    $.ajax({
      type: "POST",
      url: '',
      dataType: 'json',
      data:{mostrar: 'xd'},
      success(angeles){
        console.log(angeles);
        tabla = $("#tabla").DataTable({
          responsive: true,
          data: angeles
        });
      }
    })
  }

  $("#tipMon").keyup(()=> {  validarNombre($("#tipMon"),$("#error") ,"Error de Tipo de Moneda,") });
  $("#cambio").keyup(()=> {  validarNumero($("#cambio"),$("#error") ,"Error de Valor de Moneda,") });

  let vtipo, vcambio;  
  $("#enviar").click((e)=>{

    vtipo = validarNombre($("#tipMon"),$("#error") ,"Error de Tipo de Moneda,");
    vcambio = validarNumero($("#cambio"),$("#error") ,"Error de Valor de Moneda,");

    $.ajax({

     type:"POST",
     url:"",
     dataType:"json",
     data:{

       cambio: $("#cambio").val(),
       tipo: $("#tipMon").val()

     },
     success(data){
      console.log(vtipo, vcambio)
      if (vtipo == true && vcambio == true) {
        tabla.destroy();
        $("#close").click();
        Toast.fire({ icon: 'success', title: 'Tipo de cambio registrado'})
        rellenar();
      }else{
        e.preventDefault()
      }

    }
  })



  })

  let id;
  $(document).on('click', '.borrar', function(){
  	id = this.id;
    console.log("si funciona");
  })
  $("#delete").click(() =>{
    $.ajax({
     type:"POST",
     url:'',
     dataType:'json',
     data:{
      borrar:'cualquier cosita',
      id
    },
    success(yeli){
      if (yeli.resultado === "Eliminado"){
        tabla.destroy();
        $("#cerrar").click();
        Toast.fire({icon: 'error', title:'Tipo de moneda eliminado'})
        rellenar();

      }else{
        console.log("No se elimino");
      }
    }
  })




  })

  let unico;
  $(document).on('click','.editar', function(){
    unico = this.id;
    console.log(unico);

    $.ajax({
      type:"POST",
      url:'',
      dataType:'json',
      data:{
        editar:'noloserick',
        unico
      },
      success(uni){
        console.log(uni);
        $("#tipMonEdit").val(uni[0].nombre);
        $("#cambioEdit").val(uni[0].cambio);

      }

    })

  })

  $("#tipMonEdit").keyup(()=> {  validarNombre($("#tipMonEdit"),$("#error2") ,"Error de Tipo de Moneda,") });
  $("#cambioEdit").keyup(()=> {  validarNumero($("#cambioEdit"),$("#error2") ,"Error de Valor de Moneda,") });

  let etipo, ecambio;  
  $("#enviarEdit").click((e)=>{

    etipo = validarNombre($("#tipMonEdit"),$("#error2") ,"Error de Tipo de Moneda,");
    ecambio = validarNumero($("#cambioEdit"),$("#error2") ,"Error de Valor de Moneda,");

    $.ajax({

     type:"POST",
     url:"",
     dataType:"json",
     data:{
       cambioEdit: $("#cambioEdit").val(),
       tipoEdit: $("#tipMonEdit").val(),
       unico

     },
     success(data){
      console.log(etipo, ecambio)
      if (etipo == true && ecambio == true) {
        tabla.destroy();
        $("#closeEdit").click();
        Toast.fire({ icon: 'success', title: 'Tipo de cambio registrado'})
        rellenar();
      }else{
        e.preventDefault()
      }

    }
  })



  })






})