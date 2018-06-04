$(document).ready(function () {
    get_notificacoes();//carrega as notificações no primeiro load na pagina
    var $notificacoes_async = setInterval(get_notificacoes, 500);//depois fica verficando de tempos em tempos se tem coisa nova
});

function get_notificacoes() {
    $dropdown_notificacoes = $(".drop-content");
    
    $.ajax({
        url: $base_url + 'notificacao_c/get_notificacoes',
        type: "GET",
        dataType: "json",
        success: function (result) {
            
            if( $($(".total_notificacoes")[0]).text() != result.total ){
                $dropdown_notificacoes.html("");
                
                $(".total_notificacoes").text(result.total);
                $(result.conteudo).each(function(){
                    
                    switch(this.tipo){
                        case "msg":
                        $dados = '<a href='+this.link+'><div class="col-md-3 col-sm-3 col-xs-3">'+'\
                        <div class="notify-img"><img src="'+$base_url + "assets/img/notification.png" +'" alt=""></div></div>' +
                        '<div class="col-md-9 col-sm-9 col-xs-9 pd-l0">Nova mensagem de <b>'+this.usuario+'</b>' +
                        '<p>'+this.msg+'</p>'+
                        '<p class="time">Em '+this.data+' às '+this.hora+'</p></div></a>';
                        break;
                        case "transacao_recebida":
                        $dados = '<a href='+this.link+'><div class="col-md-3 col-sm-3 col-xs-3">'+'\
                        <div class="notify-img"><img src="'+$base_url + "assets/img/notification.png" +'" alt=""></div></div>' +
                        '<div class="col-md-9 col-sm-9 col-xs-9 pd-l0">Nova solicitação de transação' +
                        '<p>'+this.anuncio+'</p>'+
                        '<p class="time">Solicitação recebida em '+this.data+' às '+this.hora+'</p></div></a>';
                        break;
                        case "transacao_aceita":
                        $dados = '<a href='+this.link+'><div class="col-md-3 col-sm-3 col-xs-3">'+'\
                        <div class="notify-img"><img src="'+$base_url + "assets/img/notification.png" +'" alt=""></div></div>' +
                        '<div class="col-md-9 col-sm-9 col-xs-9 pd-l0">Sua solicitação de transação foi aceita' +
                        '<p>'+this.anuncio+'</p>'+
                        '<p class="time">Solicitação feita em '+this.data+' às '+this.hora+'</p></div></a>';
                        break;
                    }
                    $item_notificacao = $("<li>");
                    $item_notificacao.append($dados);
                    $dropdown_notificacoes.prepend($item_notificacao);
                });
            }
        }
    });
}

