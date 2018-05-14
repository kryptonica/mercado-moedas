$(document).ready(function () {
    $(".quantidade-produto").change(function () {
        console.log("foi");
        $quantidade = $(this).val();
        $id = $(this).parent().parent().attr("id");
        $.ajax({
            url: $("#base-url").val() + "carrinho_c/alterar_quantidade",
            type: "POST",
            dataType: "json",
            data: {
                quantidade: $quantidade,
                id: $id
            },
            success: function (result) {
                if (result) {
                    location.reload();
                }
            }
        });

    });
});

