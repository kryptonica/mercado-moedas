$("#quantidade_anuncio").on("change",function(){
   $(this).val(parseFloat($(this).val()).toFixed(8));
});
