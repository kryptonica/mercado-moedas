$(function () {

	$("#quantidade_anuncio").on("change", function () {
		$(this).val(parseFloat($(this).val()).toFixed(8));
	});

	$(".form_busca input[name='texto_busca']").keyup(function (e) {
        var code = e.keyCode || e.which;
        
		if (code == 13) { 
            	$($(this).parent()).find('button').click();
		}

	});

	$("#quantidade-compra").change(function () {
		$("#quantidade").val($(this).val());
	});

	$('#select_anuncio').change(function(){
		$('.form_busca').submit();
	});
	
	$('.checkbox-busca').click(function(){
		$('.form_busca').submit();
	});

	

	var timerid;
	$("#campo-anuncio").keyup(function() {
		clearTimeout(timerid);
		timerid = setTimeout(function() {
			$('.form_busca').submit(); 
		}, 500);
	});

});
