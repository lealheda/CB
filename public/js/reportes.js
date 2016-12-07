	$( document ).ready(function() {
	    $('.oculto').hide()
	});

	$("#reporte").change(function() {
		$('.oculto').hide()
	        if($(this).find("option:selected").val() == "Ventas") {
	        	$("#tipo_reporte option[value='General']").show()
	            $("#tipo_reporte option[value='Cliente']").show()
	            $("#tipo_reporte option[value='Producto']").show()
	        }
	        if($(this).find("option:selected").val() == "Compras") {
	        	$(".compra").show()
	        }
	})

	function validatefecha() {
	    desde = document.querySelector('[name="desde"]').value;;
	    hasta = document.querySelector('[name="hasta"]').value;;
		if(desde<=hasta){
			return true;
		}
		else{
			alert("La fecha hasta no puede ser mayor que la fecha desde");
			return false;
		}
	    return false;
	}

    $(function() {
      $( "#datepickerdesde" ).datepicker({
        changeMonth: true,
        changeYear: true
      });
    });
    
    $(function() {
      $( "#datepickerhasta" ).datepicker({
        changeMonth: true,
        changeYear: true, 
      });
    });