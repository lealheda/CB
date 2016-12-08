$(document).ready(function () {
    var wrapper = $(".table"); //Fields wrapper
    var add_button = $(".add_field_button"); //Add button codigo
    $(add_button).click(function (e) { //on add input button click
        e.preventDefault();
        var name = $('#combobox').find(":selected").text();
        var producto = $('#combobox').find(":selected").attr("data-subtext").split("-");
        var codigo = producto[0];
        var codigos_existentes = $("input[name='codigo[]']").map(function () { return $(this).val(); }).get();
        var impuesto = 0;
        if (codigos_existentes.length == 0 || $.inArray(codigo, codigos_existentes) == -1) {
            var precio = producto[1];
            temporal_impuesto = (precio * (producto[2]/100)) + (precio * (producto[3]/100));
            impuesto = temporal_impuesto.toFixed(2);
            $(wrapper).append(
                '<tr id="'+codigos_existentes.length+'">' +
                '<td><input type="text" name="codigo[]" id="codigo_' + codigos_existentes.length + '" value="' + codigo + '" class="form-control" readOnly="true" /></td>' +
                '<td><input type="text" name="descripcion[]" id="descripcion_' + codigos_existentes.length + '" value="' + name + '" class="form-control" readOnly="true" /></td>' +
                '<td><input type="text" name="precio[]" id="precio_' + codigos_existentes.length + '" value="' + precio + '" class="form-control" readOnly="true" /></td>' +
                '<td><input type="text" name="cantidad[]" id="cantidad_' + codigos_existentes.length + '" value="0" class="form-control" /></td>' +
                '<td><input type="text" name="importe[]" id="importe_' + codigos_existentes.length + '" value="0" class="form-control" readOnly="true" /></td>' +
                '<td><input type="text" name="descuento[]" id="descuento_' + codigos_existentes.length + '" value="0" class="form-control" /></td>' +
                '<td><input type="text" name="impuestos[]" id="impuesto_' + codigos_existentes.length + '" value="' + impuesto + '" class="form-control" readOnly="true" /></td>' +
                '<td><input type="text" name="totales[]" id="total_' + codigos_existentes.length + '" value="0" class="form-control" readOnly="true"/></td>' +
                '<td><a id="' + codigos_existentes.length + '" href="#" class="remove_field">Eliminar</a></div></td>' +
                '<tr>'
                ); //add input box
        } else {
            alert("El producto ya existe en la lista");
        }
    });

    $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
        id_seleccionado = this.id;
        e.preventDefault(); $('#'+id_seleccionado).remove();
    });

    //Cambios en input cantidad
    $(document).on('change', "input[name='cantidad[]']", function () {
        id_seleccionado = this.id;
        var posicion = id_seleccionado.split("_")[1];
        var precio = $("#precio_" + posicion).val();
        var cantidad = $(this).val();
        var descuento_porcentaje = $('#descuento_' + posicion).val();
        var impuestos = $('#impuesto_' + posicion).val();
        var total = $('#total_' + posicion).val();
        var importe = precio * cantidad;
        $('#importe_' + posicion).val(importe);
        var descuento_pesos=0;
        if(descuento_porcentaje != ""){
            descuento_pesos = importe * (descuento_porcentaje/100);
        }
        var total = parseFloat(importe) + parseFloat(impuestos) - parseFloat(descuento_pesos);
        var final = total.toFixed(2);
        $('#total_' + posicion).val(final);
        
        //Resumen venta
        var importes = $("input[name='importe[]']").map(function () { return $(this).val(); }).get();
        var resumen_importe=0;
        $.each(importes, function (index, value) {
            resumen_importe += parseFloat(value);
        });
        $('#resumen_importe').val(resumen_importe.toFixed(2));
        var descuentos = $("input[name='descuento[]']").map(function () { return $(this).val(); }).get();
        var resumen_descuento=0;
        $.each(descuentos, function (index, value) {
            resumen_descuento += parseFloat(value);
        });
        $('#resumen_descuento').val(resumen_descuento.toFixed(2));
        var impuestos = $("input[name='impuestos[]']").map(function () { return $(this).val(); }).get();
        var resumen_impuestos=0;
        $.each(impuestos, function (index, value) {
            resumen_impuestos += parseFloat(value);
        });
        $('#resumen_impuestos').val(resumen_impuestos.toFixed(2));
        var totales = $("input[name='totales[]']").map(function () { return $(this).val(); }).get();
        var resumen_total=0;
        $.each(totales, function (index, value) {
            resumen_total += parseFloat(value);
        });
        $('#resumen_total').val(resumen_total.toFixed(2));
    });

    //Cambios en input descuento
    $(document).on('change', "input[name='descuento[]']", function () {
        id_seleccionado = this.id;
        var posicion = id_seleccionado.split("_")[1];
        var precio = $("#precio_" + posicion).val();
        var cantidad = $('#cantidad_' + posicion).val();
        var descuento_porcentaje = $(this).val();
        var impuestos = $('#impuesto_' + posicion).val();
        var total = $('#total_' + posicion).val();
        var importe = precio * cantidad;
        $('#importe_' + posicion).val(importe);
        var descuento_pesos = 0;
        if (descuento_porcentaje != "") {
            descuento_pesos = importe * (descuento_porcentaje / 100);
        }
        var total = parseFloat(importe) + parseFloat(impuestos) - parseFloat(descuento_pesos);
        var final = total.toFixed(2);
        $('#total_' + posicion).val(final);

        //Resumen venta
        var importes = $("input[name='importe[]']").map(function () { return $(this).val(); }).get();
        var resumen_importe=0;
        $.each(importes, function (index, value) {
            resumen_importe += parseFloat(value);
        });
        $('#resumen_importe').val(resumen_importe.toFixed(2));
        var descuentos = $("input[name='descuento[]']").map(function () { return $(this).val(); }).get();
        var resumen_descuento=0;
        $.each(descuentos, function (index, value) {
            resumen_descuento += parseFloat(value);
        });
        $('#resumen_descuento').val(resumen_descuento.toFixed(2));
        var impuestos = $("input[name='impuestos[]']").map(function () { return $(this).val(); }).get();
        var resumen_impuestos=0;
        $.each(impuestos, function (index, value) {
            resumen_impuestos += parseFloat(value);
        });
        $('#resumen_impuestos').val(resumen_impuestos.toFixed(2));
        var totales = $("input[name='totales[]']").map(function () { return $(this).val(); }).get();
        var resumen_total=0;
        $.each(totales, function (index, value) {
            resumen_total += parseFloat(value);
        });
        $('#resumen_total').val(resumen_total.toFixed(2));
    });

    $('#valida_productos').submit(function (e) {
        if ($("input[name='codigo[]']").length != 0) {
            var descripcion = $("input[name='descripcion[]']").map(function () { return $(this).val(); }).get();
            var inputscantidad = $("input[name='cantidad[]']").map(function () { return $(this).val(); }).get();
            var inputsdescuentos = $("input[name='descuento[]']").map(function () { return $(this).val(); }).get();
            $.each(inputscantidad, function (index, value) {
                if (value == 0) {
                    alert("Por favor ingrese una cantidad en el producto " + descripcion[index]);
                    e.preventDefault();
                    return false;
                }
            });
            return true;
        } else {
            alert("Agregue productos a la lista");
            return false;
        }
    });

}); //END
