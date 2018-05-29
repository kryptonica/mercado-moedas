$(document).ready(function () {
    get_notificacoes();//carrega as notificações no primeiro load na pagina
    setInterval(get_notificacoes, 40000);//depois fica verficando de tempos em tempos se tem coisa nova
});

function get_notificacoes() {
    $dropdown_notificacoes = $(".drop-content");
    $dropdown_notificacoes.html("");
    $.ajax({
        url: $("#base-url").val() + 'notificacao_c/get_notificacoes',
        type: "GET",
        dataType: "json",
        success: function (result) {
            $(".total_notificacoes").text(result.total);
            $(result.conteudo).each(function(){
                $dados = '<a href='+this.link+'><div class="col-md-3 col-sm-3 col-xs-3">'+'\
                <div class="notify-img"><img src="http://placehold.it/45x45" alt=""></div></div>' +
                '<div class="col-md-9 col-sm-9 col-xs-9 pd-l0">Nova mensagem de <b>'+this.usuario+'</b>' +
                '<p>'+this.msg+'</p>'+
                '<p class="time">Em '+this.data+' às '+this.hora+'</p></div></a>';
                $item_notificacao = $("<li>");
                $item_notificacao.append($dados);
                $dropdown_notificacoes.append($item_notificacao);
            });
        }
    });
}

