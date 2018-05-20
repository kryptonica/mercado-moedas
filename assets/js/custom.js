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


	
	


});
