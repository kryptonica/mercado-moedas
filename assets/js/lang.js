$(function () { 

    $(".opcao_lang").click(function (e) { 
        e.preventDefault();
        $lang = $(this).val();
        
        $.ajax({
            type: "post",
            url:  $base_url + 'usuario_c/mudar_lingua',
            data: {lang: $lang},
            dataType: "json",
            success: function (response) {
               location.reload();
               //console.log(response);
               
            },
            error: function (err1,err2,err3) {
                console.log(err1);
                console.log(err2);
                console.log(err3);
                
            }
        });
    });

});

