<? require 'config.inc.php';
require 'connection.php';
require 'function.php';
//use Model;
require_once 'Lib/AutoLoader.php';
//AutoLoader::singleton()->register();
import('Lib.Core.*');
import('Lib.Model.*');


session_name($_SESSION_NAME);

session_start();

$cryptinstall = './extra/crypt/cryptographp.fct.php';

include_once $cryptinstall;

$sections = array('home', 'news', 'new', 'calendar', 'calendars', 'contact', 'func', 'students', 'student',
    'teachers', 'teacher', 'employees', 'employee', 'links', 'education', 'item.course', 'register',
    'categories_projects', 'research_projects', 'research_project', 'ext_projects', 'ext_project',
    'institucional', 'downloads', 'mural', 'oportunidades', 'oportunidade', 'report', 'monograph',
    'dissertation', 'thesis', 'cameras');

if (!isset($_GET['section']) || !in_array($_GET['section'], $sections))
    $section = 'home';
else
    $section = $_GET['section'];

$page = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] ? $_GET['page'] : 1;

if (isset($_GET['itemId']) && is_numeric($_GET['itemId']))
    $itemId = $_GET['itemId'];
else
    $itemId = 0;

$_CONFIGURE = HomeConfigurator::singleton()->getValue();
?>

  <!DOCTYPE html>
  <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
  <!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
  <!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
  <!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>UFMS - Faculdade de Computa&cedil;&atilde;o</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <link rel="alternate" type="application/rss+xml" title="RSS - Agendas DCT/UFMS" href="<?= $_URL ?>rss/calendar.php" />
    <link rel="alternate" type="application/rss+xml" title="RSS - Downloads DCT/UFMS" href="<?= $_URL ?>rss/downloads.php" />
    <link rel="alternate" type="application/rss+xml" title="RSS - Links DCT/UFMS" href="<?= $_URL ?>rss/links.php" />
    <link rel="alternate" type="application/rss+xml" title="RSS - Mural DCT/UFMS" href="<?= $_URL ?>rss/mural.php" />
    <link rel="alternate" type="application/rss+xml" title="RSS - Not&iacute;cias DCT/UFMS" href="<?= $_URL ?>rss/news.php" />
    <link rel="alternate" type="application/rss+xml" title="RSS - Oportunidades DCT/UFMS" href="<?= $_URL ?>rss/oportunidades.php" />

    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
      body {
        padding-top: 0px;
      }
    </style>
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/main.css">

    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <script src="js/vendor/jquery-1.10.1.min.js"></script>
    <script src="http://www.google.com/uds/api?file=uds.js&amp;v=1.0&amp;key=ABQIAAAAKvFZsRm-4Gs-yp64SE1gXRSQmMmAhM_n0122sy512XLESGUhnhTbqpf7RUiVHhOJ7QVl8U8E18j2pw" type="text/javascript"></script>
    <script src="js/googlesearch.js"></script>

  </head>
  <body>
  <!--[if lt IE 7]>
  <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
  <![endif]-->
  <div class="topo">
    <div class="topo-fixo">
      <div class="container">
        <div class="pull-left">
        </div>
  </div>
</div>

<div id="topo-principal" class="topo-principal">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-md-6">
        <div class="logo-principal">
          <div class="content-heading media">
            <!-- <img class="pull-left hidden-sm hidden-xs" src="img/logo-facom-titulo.png"/>-->
            <!--<h1>FACOM.UFMS.BR</h1>-->
            <small class="hidden-xs">Faculdade de Computa&ccedil;&atilde;o da</small>
            <small class="topo-principal-destaque">Universidade Federal de Mato Grosso do Sul</small>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-6">
        <div class="topo-buscar">
          <form action="#" method="post" id="searchForm" class="searchForm">
            <input class="form-control buscar input-lg" type="text" placeholder="Buscar na FACOM"/>
            <button class="btn btn-lg buscar-botao" type="submit" id="search" alt="Search">
              <span class="glyphicon glyphicon-search"></span>
            </button> 
          </form>
        </div>


        <div class="topo-social pull-right">
          Social
          <a href="facebook.com">facebook</a>
          <a href="twitter.com">twitter</a>
          <a href="plus.google.com">plus</a>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="menu-principal" class="navbar-principal">
  <div class="container">
    <nav class="navbar navbar-default" role="navigation">
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="navbar-collapse" id="principal-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="active"><a href="index.php">INICIO</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">INSTITUCIONAL <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="index.php?section=institucional&amp;itemId=5#container">Cursos da FACOM</a></li>
              <li><a href="index.php?section=institucional&amp;itemId=2#container">Hist&oacute;rico</a></li>
              <li><a href="index.php?section=institucional&amp;itemId=4#container">Pr&ecirc;mios e Disserta&ccedil;&otilde;es</a></li>
              <li><a href="index.php?section=institucional&amp;itemId=3#container">Salas e laborat&oacute;rios</a></li>
              <li><a href="index.php?section=institucional&amp;itemId=6#container">Identidade Visual</a></li>
              <li><a href="index.php?section=institucional&amp;itemId=1#container">Sobre a FACOM</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">PESSOAS <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="index.php?section=students">Alunos</a></li>
              <li><a href="index.php?section=employees">Funcion&aacute;rios</a></li>
              <li><a href="index.php?section=teachers">Professores</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">ENSINO <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="index.php?section=education&course=analise">An&aacute;lise de Sistemas</a></li>
              <li><a href="index.php?section=education&course=computacao">Ci&ecirc;ncia da Computa&ccedil;&atilde;o</a></li>
              <li><a href="index.php?section=education&course=engenharia">Engenharia da Computa&ccedil;&atilde;o</a></li>
              <li><a href="index.php?section=education&course=mestrado">Mestrado em Ci&ecirc;ncia da Computa&ccedil;&atilde;o</a></li>
              <li><a href="index.php?section=education&course=mestradop">Mestrado Profissional</a></li>
              <li><a href="index.php?section=education&course=tecnologia_sistemas">TRC</a></li>
              <li><a href="index.php?section=education&course=tecnologia_redes">TADS</a></li>
              <li><a href="index.php?section=education&course=doutorado">Doutorado em Ci&ecirc;ncia da Computa&ccedil;&atilde;o</a></li>
              <li><a href="index.php?section=education&course=estagio">Est&aacute;gio</a></li>
            </ul>
          </li>
          <li><a href="#">EXTENS&atilde;O</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">PESQUISA <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="index.php?section=categories_projects">&Aacute;reas de Pesquisa</a></li>
              <li><a href="index.php?section=research_projects">Projetos de Pesquisa</a></li>
              <li><a href="index.php?section=report">Relat&oacute;rios T&eacute;cnicos</a></li>
              <li><a href="index.php?section=monograph">Monografias</a></li>
              <li><a href="index.php?section=dissertation">Disserta&ccedil;&otilde;es</a></li>
              <li><a href="index.php?section=thesis">Teses</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">CANAIS <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="index.php?section=calendars">Agenda</a></li>
              <li><a href="index.php?section=mural">Mural</a></li>
              <li><a href="index.php?section=downloads">Download</a></li>
              <li><a href="index.php?section=links">Links</a></li>
              <li><a href="index.php?section=news">Not&iacute;cias</a></li>
              <li><a href="index.php?section=oportunidades">Oprtunidades</a></li>
            </ul>
          </li>
        </ul>
        <ul class="nav navbar-nav pull-right">
          <li class="dropdown">
            <a class="dropdown-toggle" href="#" data-toggle="dropdown">Login <strong class="caret"></strong></a>
            <div class="dropdown-menu">
              <form class="form-horizontal" role="form">
                <div class="form-group">
                  <div class="col-sm-10 topo-buscar">
                    <input type="input" class="form-control" id="inputEmail3" placeholder="Email">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-10 topo-buscar">
                    <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-default">Ok</button>
                  </div>
                </div>
              </form>
            </div>
          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </nav>

  </div>
</div>

</div>
          <div class="sqMain" id="results" style="display: none">
              <div class="sqBody" id="searchResults">
                Carregando...
              </div>
          </div>
            <? include ( $section . ".php" ) ?>
          
            
  
  <hr class="divisao-pagina">
  <footer>
      <div class="clearfix"></div>
      <div class="rodape">
          <div class="row">
              <div class="rodape-conteudo container">
                  <div class="col-md-4 rodape-logo hidden-xs hidden-sm">
                      <img alt="UFMS logo" src="img/logo-ufms2.png">
                  </div>
                  <div class="col-md-5 rodape-info">
                      <small>
                          Faculdade de Computa&cedil;&atilde;o - Facom
                          Universidade Federal de Mato Grosso do Sul
                          CEP: 79070-900 - Caixa Postal 549
                          Campo Grande/MS - Brasil

                          Tel: +55 (67) 3345-7455 Fax: +55 (67) 3345-7518
                          Email: <a href="mailto:secretaria@facom.ufms.br">secretaria@facom.ufms.br</a> 
                      </small>
                  </div>
                      <div class="col-md-3 rodape-brasil hidden-xs hidden-sm">
                          
                          <a href="http://www.ledes.net/">
                              <img alt="Laboratório de Engenharia de Software" src="img/ledes-base.png">
                          </a>
                          <a href="http://www.facom.ufms.br/">
                              <img alt="Faculdade de Computação" src="img/facom-logo.png">
                          </a>
                      </div>
                  </div>
              </div>
          </div>

      </footer>       
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.1.min.js"><\/script>')</script>

  <script src="js/vendor/bootstrap.min.js"></script>

  <script src="js/main.js"></script>

  <script>
  var _gaq = [['_setAccount', 'UA-XXXXX-X'], ['_trackPageview']];
  (function(d, t) {
      var g = d.createElement(t), s = d.getElementsByTagName(t)[0];
      g.src = '//www.google-analytics.com/ga.js';
      s.parentNode.insertBefore(g, s)
  }(document, 'script'));
  </script>
  </body>
  </html>
