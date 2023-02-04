$(document).ready(function(){
	rellenar();
	let mostrar;
	function rellenar(){
		$.ajax({
			type: "post",
			url: "",
			dataType: "json",
			data: {mostrar: "labs" },
			success(list){
				mostrar = $('#tabla').DataTable({
					responsive: true,
					data: list
				})
			}
		})
	}


	$("#clase").keyup(()=> {  validarNombre($("#clase"),$("#error"), "Error de clase,") });
	let vclase
	$("#enviar").click((e)=>{
		e.preventDefault();
		vclase = validarNombre($("#clase"),$("#error") , "Error de clase,");

		$.ajax({
			type: "post",
			url: '',
			dataType: 'json',
			data: {
				clase: $("#clase").val()
			},
			success(data){
				if (vclase) {
					mostrar.destroy(); // VACÍA LA DATATABLE
					rellenar();  // FUNCIÓN PARA RELLENAR DATATABLE
				  	$('#close').click(); // CERRAR EL MODAL
				    Toast.fire({ icon: 'success', title: 'Clase registrada' }) // ALERTA 
				}
			}
		})
	})


	let id
	$(document).on('click', '.borrar', function() {
		id = this.id;
	});
	$('#borrar').click(()=>{
		$.ajax({
			type : 'post',
			url : '',
			dataType: 'json',
			data : {borrar : 'asd', id},
			success(data){
				mostrar.destroy();
				$('#cerrar').click();
				rellenar();
				Toast.fire({ icon: 'error', title: 'Clase eliminada' })
			}
		})
	})


	/* --- EDITAR --- */
	let idedit;
    // SELECCIONA ITEM
    $(document).on('click', '.editar', function() {
        idedit = this.id; // se obtiene el id del botón, previamente le puse de id el codigo en rellenar()
       	// RELLENA LOS INPUTS
       	$.ajax({
       		method: "post",
       		url: "",
       		dataType: "json",
		        data: {item: "lol", idedit}, // id : id
		        success(data){
		        	$("#claseEdit").val(data[0].des_clase);
		        }

		    })

       });

    $("#claseEdit").keyup(()=> {  validarNombre($("#claseEdit"),$("#error2"), "Error de clase,") });
    let eclase
    $("#enviarEdit").click((e)=>{
    	e.preventDefault();
    	eclase = validarNombre($("#claseEdit"),$("#error2") , "Error de clase,");

    	$.ajax({
    		type: "post",
    		url: '',
    		dataType: 'json',
    		data: {
    			claseEdit: $("#claseEdit").val(),idedit
    		},
    		success(data){
    			if (eclase) {
					mostrar.destroy(); // VACÍA LA DATATABLE
					rellenar();  // FUNCIÓN PARA RELLENAR DATATABLE
				  	$('#closeEdit').click(); // CERRAR EL MODAL
				    Toast.fire({ icon: 'success', title: 'Clase actualizada' }) // ALERTA 
				}
			}
		})
    })
    



})