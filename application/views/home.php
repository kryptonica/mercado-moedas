<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Aplicação destinada ao comércio peer-to-peer de criptomoedas">
    <meta name="author" content="Matheus Coqueiro Andrade">
    <title>Mercado de Moedas</title>
    <link rel="stylesheet" href="<?=base_url('assets/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/custom.css')?>">
    <link rel="stylesheet" type="text/css" href="//cloud.typography.com/746852/739588/css/fonts.css" />
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>

    <header>
      <nav class="navbar navbar-default">
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <a class="navbar-brand" href="#">Kriptonica</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <form class="navbar-form navbar-left">
              <div class="form-group">
                <input type="text" class="form-control search" placeholder="Search">
              </div>
            </form>
            <div class="navbar-right">
              <span class="fa fa-user-circle" style="font-size: 30px;    padding:  10px;"></span>
              <ul class="nav navbar-nav">
                <li class="dropdown">

                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Nome do Usuário <span class="fa fa-chevron-down"></span></a>
                  <ul class="dropdown-menu">
                  </ul>
                </li>
              </ul>
            </div>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </header>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <h2>Moedas</h2>
            <table class="table">
              <tr>
                <th>Moeda</th>
                <th>Menor Valor</th>
                <th>Maior Valor</th>
              </tr>
              <tr>
                <td>BTC</td>
                <td>R$ 30.000,00</td>
                <td>R$ 35.000,00</td>
              </tr>
              <tr>
                <td>ETH</td>
                <td>R$ 2.000,00</td>
                <td>R$ 10.000,00</td>
              </tr>
            </table>
            <div class="text-right">
              <a href="#">Mostrar mais...</a>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="card">
            <h2>Baseado nas buscas por ETC</h2>
            <table class="table">
              <tr>
                <th>Vendedor</th>
                <th>Valor</th>
                <th>Quantidade mínima</th>
                <th>Quantidade</th>
              </tr>
              <tr>
                <td>Teste1</td>
                <td>R$ 2.000,00</td>
                <td>0.5 ETC</td>
                <td>1 ETC</td>
              </tr>
              <tr>
                <td>Teste2</td>
                <td>R$ 3.000,00</td>
                <td>0.6 ETC</td>
                <td>2 ETC</td>
              </tr>
            </table>
            <div class="text-right">
              <a href="#">Ver mais ofertas de ETC</a>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <h2>Últimas compras</h2>
            <table class="table">
              <tr>
                <th>Moeda</th>
                <th>Data/Hora</th>
                <th>Valor</th>
              </tr>
              <tr>
                <td>BTC</td>
                <td>20/03/2018 20:30</td>
                <td>R$ 13.000,00</td>
              </tr>
              <tr>
                <td>ETH</td>
                <td>22/03/2018 10:30</td>
                <td>R$ 1.000,00</td>
              </tr>
            </table>
            <div class="text-right">
              <a href="#">Ver mais compras</a>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <h2>Últimos anuncios</h2>
            <table class="table">
              <tr>
                <th>Moeda</th>
                <th>Data/Hora</th>
                <th>Valor</th>
              </tr>
              <tr>
                <td>BTC</td>
                <td>20/03/2018 20:30</td>
                <td>R$ 13.000,00</td>
              </tr>
              <tr>
                <td>ETH</td>
                <td>22/03/2018 10:30</td>
                <td>R$ 1.000,00</td>
              </tr>
            </div>
          </table>
          <div class="text-right">
            <a href="#">Ver mais anuncios</a>
          </div>
        </div>
      </div>
    </div>
  </div><!-- BUG -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-2">
            <div class="text-center">
              <h2>Kriptonica</h2>
            </div>
          </div>
          <div class="col-xs-6 col-sm-5">
            <ul>
              <h3>Mapa do site</h3>
              <li><a href="#">Loren ipsum</a></li>
              <li><a href="#">Loren ipsum</a></li>
              <li><a href="#">Loren ipsum</a></li>
              <li><a href="#">Loren ipsum</a></li>
            </ul>
          </div><div class="col-xs-6 col-sm-5">
            <ul>
              <h3>Contato</h3>
              <li><a href="#">Loren ipsum</a></li>
              <li><a href="#">Loren ipsum</a></li>
              <li><a href="#">Loren ipsum</a></li>
              <li><a href="#">Loren ipsum</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="footer-bottom text-center">
        <p> Copyright 2018 Kriptonica - Todos os direitos reservados.</p>
      </div>
    </footer>
    <script	src="<?=base_url('assets/js/jquery-3.2.1.min.js')?>"></script>
    <script	src="<?=base_url('assets/js/bootstrap.min.js')?>"></script>
  </body>
</html>
