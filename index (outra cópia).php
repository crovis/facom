<?
require 'config.inc.php';
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
        <!--<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Facom - Faculdade de Computa&ccedil;&atilde;o </title>

        <link rel="stylesheet" href="styles/layout.css" type="text/css" />
        <link rel="stylesheet" href="styles/teacher.css" type="text/css" />
		<link rel="stylesheet" href="css/style.css" type="text/css" />
        <!-- Homepage Specific Elements -->

      <meta charset="iso-8859-1">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <title>UFMS - Faculdade de Computação</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width">
      <link rel="stylesheet" href="css/fonts.css">
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <style>
      body {
          padding-top: 0px;
      }
      </style>
      <link rel="stylesheet" href="css/bootstrap-theme.min.css">
      <link rel="stylesheet" href="css/main.css">
      <!--
        <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
		<script type='text/javascript' src='jquery/jquery-1.10.2.js'></script>
        <script type='text/javascript' src='jquery/jquery-ui.js'></script>
		<script type="text/javascript"  src="js/login.js"></script>

        <!-- End Homepage Specific Elements 
		
        <script src="http://www.google.com/uds/api?file=uds.js&amp;v=1.0&amp;key=ABQIAAAAKvFZsRm-4Gs-yp64SE1gXRSQmMmAhM_n0122sy512XLESGUhnhTbqpf7RUiVHhOJ7QVl8U8E18j2pw" type="text/javascript"></script>
        <script type="text/javascript" src="gestor/titan.php?target=loadFile&amp;file=js/sha1.js"></script>
     <!--   <script type="text/javascript" src="js/prototype.js"></script> 
        <script type="text/javascript" src="js/js.js"></script>
        <script type="text/javascript" src="js/googlesearch.js"></script>
        <!-- jquery for equal height elements 
        <script type="text/javascript" src="js/formee.js"></script>
		<script type='text/javascript' src='slide/amazingslider.js'></script>
		<script type='text/javascript' src="slide/initslider.js"></script>
        <!-- css for structure -->
    
		<!--                        -->       
        <!--<script type="text/javascript" src="js/tabscript.js"></script>
		<!--
        <script>
            $(function() {
				$( "#accordion" ).accordion({heightStyle:'content', active:true});
				$( "#accordion1" ).accordion({heightStyle:'content', active:true});
				$( "#accordion2" ).accordion({heightStyle:'content', active:true});
				$( "#accordion3" ).accordion({heightStyle:'content', active:true});
				$( "#accordion4" ).accordion({heightStyle:'content', active:true});
				$( "#accordion5" ).accordion({heightStyle:'content', active:true});
				$( "#accordion6" ).accordion({heightStyle:'content', active:true});
				$( "#tabs" ).tabs();				
});

        </script> -->

    </head>
    <body >

            <div class="topo">
                      <div class="topo-fixo">
                          <div class="container">
                              <div class="pull-left">
                                  <!-- <a href="http://ufms;br/"><img alt="logo ufms" src="img/ufms-logo.png" /></a>-->
                              </div>
                              <!-- <div class="pull-right">
                                  <a href="http://facom.ufms.br/"><img alt="logo facom" src="img/facom-logo-xs.png" /></a>
                              </div> -->
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
                                       <small class="hidden-xs">Faculdade de Computação da</small>
                                       <small class="topo-principal-destaque">Universidade Federal de Mato Grosso do Sul</small>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-sm-6 col-md-6">
                                  <div class="topo-buscar">
                                          <input class="form-control buscar input-lg" type="text" name="q" placeholder="Buscar na FACOM"/>
                                          <button class="btn btn-lg buscar-botao" type="submit">
                                              <span class="glyphicon glyphicon-search"></span>
                                          </button>
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
                                              <li class="active"><a href="#">INÍCIO</a></li>
                                              <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">INSTITUCIONAL <b class="caret"></b></a>
                                                <ul class="dropdown-menu">
                                                  <li><a href="#">Cursos da FACOM</a></li>
                                                  <li><a href="#">Histórico</a></li>
                                                  <li><a href="#">Sala e Laboratórios</a></li>
                                                  <li><a href="#">Identidade Visual</a></li>
                                                  <li><a href="#">Sobre a FACOM</a></li>
                                                </ul>
                                              </li>
                                              <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">PESSOAS <b class="caret"></b></a>
                                                <ul class="dropdown-menu">
                                                  <li><a href="#">Alunos</a></li>
                                                  <li><a href="#">Funcionários</a></li>
                                                  <li><a href="#">Professores</a></li>
                                                </ul>
                                              </li>
                                              <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">ENSINO <b class="caret"></b></a>
                                                <ul class="dropdown-menu">
                                                  <li><a href="#">Análise de Sistemas</a></li>
                                                  <li><a href="#">Ciência da Computação</a></li>
                                                  <li><a href="#">Engenharia da Computação</a></li>
                                                  <li><a href="#">Mestrado em Ciência da Computação</a></li>
                                                  <li><a href="#">Mestrado Profissional</a></li>
                                                  <li><a href="#">TRC</a></li>
                                                  <li><a href="#">TADS</a></li>
                                                  <li><a href="#">Doutorado em Ciência da Computação</a></li>
                                                  <li><a href="#">Estágio</a></li>
                                                </ul>
                                              </li>
                                              <li><a href="#">EXTENSÃO</a></li>
                                              <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">PESQUISA <b class="caret"></b></a>
                                                <ul class="dropdown-menu">
                                                  <li><a href="#">Áreas de Pesquisa</a></li>
                                                  <li><a href="#">Projetos de Pesquisa</a></li>
                                                  <li><a href="#">Relatórios Técnicos</a></li>
                                                  <li><a href="#">Monografias</a></li>
                                                  <li><a href="#">Dissertações</a></li>
                                                </ul>
                                              </li>
                                              <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">CANAIS <b class="caret"></b></a>
                                                <ul class="dropdown-menu">
                                                  <li><a href="#">Agenda</a></li>
                                                  <li><a href="#">Mural</a></li>
                                                  <li><a href="#">Download</a></li>
                                                  <li><a href="#">Links</a></li>
                                                  <li><a href="#">Notícias</a></li>
                                                  <li><a href="#">Oprtunidades</a></li>
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
                                                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
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
		
        <!-- ####################################################################################################### -->

                    <div class="slides-home">
                      <div class="container">
                      <div class="col-12 col-sm-12 col-md-7 col-md-push-5 hidden-xs hidden-xs ">
                      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                               <!-- Indicators 
                               <ol class="carousel-indicators">
                                 <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                 <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                 <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                               </ol> -->

                               <!-- Wrapper for slides -->

                                <?
                                    try {
                                        $sth = $db->prepare("SELECT * FROM imagem LIMIT 5");

                                        $sth->execute();
                                    } catch (PDOException $e) {
                                        if ($_DEBUG)
                                            die($e->getMessage());
                                    }

                                    $i = 1;
                                    $title = array();
                                ?>
                                <?
                                while ($obj = $sth->fetch(PDO::FETCH_OBJ)) {
                                ?>
                                        <li><a target="_blank" href="<?= $obj->url; ?>"><img src="gestor/titan.php?target=viewThumb&amp;fileId=<?= $obj->logo; ?>'&width=600&height=300" alt="<?=$obj->titulo?>" /></a>  </li>
                                <?
                                    }
                                ?>


                               <div class="carousel-inner">
                                 <div class="item active">
                                    <?
                                        while ($obj = $sth->fetch(PDO::FETCH_OBJ)) {
                                    ?>
                                   <a target="_blank" href="<?= $obj->url; ?>"><img src="gestor/titan.php?target=viewThumb&amp;fileId=<?= $obj->logo; ?>'&width=680&height=350" alt="<?=$obj->titulo?>" /></a>
                                    <?
                                        }
                                    ?>
                                 <!--  <div class="carousel-caption">
                                        <h3>Percentage-based sizing</h3>
                                    </div> -->
                                 </div>
                                 
                               </div>

                               <!-- Controls -->

                               <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                 <span class="glyphicon glyphicon-chevron-left"></span>
                               </a>
                               <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                 <span class="glyphicon glyphicon-chevron-right"></span>
                               </a>
                         </div>
                     </div>

                      <div class="col-12 col-sm-12 col-md-5 col-md-pull-7 conteudo-noticias">
                          <!--Ultimas Notícias PET-->
                          <div class="noticias">
                              <h3>&Uacute;ltimas Not&iacute;cias</h3>
                                <?php include_once('Elements/news.php') ?>
                              
                              <div class="mais-noticias pull-right">
                                <small><a href="?section=news">mais not&iacute;cias</a></small>
                              </div>
                          </div>

                      </div>
                      
                  
                   </div>
                  </div>

        <!--
        <div class="wrapper">
            <div id="featured_slide" class="clear">

                <?
                /*try {
                    $sth = $db->prepare("SELECT * FROM imagem LIMIT 5");

                    $sth->execute();
                } catch (PDOException $e) {
                    if ($_DEBUG)
                        die($e->getMessage());
                } */
                ?>

                <div class="overlay_left"></div>
                <div id="featured_content" >				
                    <?
                    /*$i = 1;
                    $title = array();*/
					?>
						<div id="amazingslider-19" style="display:block;position:relative;margin:15px auto 30px;">
							<ul class="amazingslider-slides" style="display:none;">
								<?
								//while ($obj = $sth->fetch(PDO::FETCH_OBJ)) {
								?>
										<li><a target="_blank" href="<?= //$obj->url; ?>"><img src="gestor/titan.php?target=viewThumb&amp;fileId=<?= //$obj->logo; ?>'&width=600&height=300" alt="<?= //$obj->titulo?>" /></a>  </li>
								<?
									}
								?>
							</ul>
						</div>
				</div>
				<div id="featured_content2" class="clear">
					<div id="homepage">
						<div id="news">
							<h2>&Uacute;ltimas Not&iacute;cias</h2>
							<ul>
								<?php //include_once('Elements/news.php') ?>
							</ul>
								<p class="readmore"><a href="?section=news">Clique aqui para visualizar todas as notícias &raquo;</a></p>			
						</div>
							
								<br />
							</div>
				</div>	
				
			</div>
		</div>
	</div>
	
	
        <!-- ####################################################################################################### -->
        <div class="wrapper row3">
            <div class="rnd">
                <div id="container" class="clear">

                    <? include ( $section . ".php" ) ?>
                    <br/>
                    <!--<hr/>-->
                    <br/>

                    <!-- ####################################################################################################### -->
                    
                    <!-- ####################################################################################################### -->
                </div>
				
				<div id="academiclinks" class="clear">
					<h2><b>Encontre o que voc&ecirc; procura:</b></h2>
					<div class="linkbox">
						<ul>
							<li><a href="index.php?section=institucional&itemId=1#container">&raquo; Sobre a FACOM</a></li>
							<li><a href="index.php?section=institucional&itemId=5#container">&raquo; Cursos da FACOM</a></li>
							<li><a href="index.php?section=institucional&itemId=2#container">&raquo; Histórico</a></li>
							<li><a href="index.php?section=institucional&itemId=4#container">&raquo; Prêmios e Dissertações</a></li>
							<li><a href="index.php?section=education&course=estagio#container">&raquo; Oportunidades de Estágio</a></li>
						</ul>
					</div>
					
					<div class="linkbox">
						<ul>
							<li><a href="index.php?section=categories_projects#container">&raquo; Áreas de Pesquisa</a></li>
							<li><a href="index.php?section=research_projects#container">&raquo; Projetos de Pesquisa</a></li>
							<li><a href="index.php?section=monograph#container">&raquo; Monografias</a></li>
							<li><a href="index.php?section=dissertation#container">&raquo; Dissertações</a></li>
							<li><a href="index.php?section=thesis#container">&raquo; Teses</a></li>
						</ul>
					</div>
					
					<div class="linkbox">
						<ul>
							<li><a href="index.php?section=calendars#container">&raquo; Agenda</a></li>
							<li><a href="index.php?section=links#container">&raquo; Links</a></li>
							<li><a href="index.php?section=news#container">&raquo; Notícias</a></li>
							<li><a href="index.php?section=contact#container">&raquo; Contato</a></li>
						</ul>
					</div>
					
				</div>
            </div>
        </div>
		<!--</br> -->
        <!-- ####################################################################################################### -->

	
		<div class="wrapper row4">
            <div class="rnd">
			
                <div id="footer" class="clear">
				
                    <!-- ####################################################################################################### -->
					<div id="footer_logo_FACOM">
						<img src="interface/image/logo-ufms2.png"/>
					</div>
					<!-- ####################################################################################################### -->
					<div id="footer_maps">
					<img src="images/demo/worldmap.gif" alt="" />
                            <a target="_blank" href="https://maps.google.com.br/maps?q=R.+UFMS+-+UFMS,+Campo+Grande+-+MS&hl=pt-BR&ll=-20.502123,-54.614202&spn=0.002133,0.003484&sll=-20.875572,-54.261875&sspn=2.178666,3.56781&oq=RUA+UFMS&t=h&hnear=R.+UFMS+-+UFMS,+Campo+Grande+-+Mato+Grosso+do+Sul,+79072-000&z=19&layer=c&cbll=-20.502123,-54.614202&panoid=0wy3NUSu38tSxRnJ53_twA&cbp=12,87.01,,0,10.46">Encontre-nos com o Google Maps &raquo;</a>
					</div>
					<div id="address">
                            Faculdade de Computação - Facom<br />
                            Universidade Federal de Mato Grosso do Sul<br />
                            CEP: 79070-900 - Caixa Postal 549<br />
                            Campo Grande/MS - Brasil<br />
					</div>
					<!-- ####################################################################################################### -->
					<div id="footer_contato">
					<div id="twitter">
								<div>
                                    <a href="https://twitter.com/facom_ufms" target="_blank"><img src="images/twitter_logo.png"></a>
									   <? //include("twitter.php"); ?>
									
								    <a href="http://www.facebook.com.br/ufmsfacom" target="_blank"><img src="images/facebook.gif"></a>

                                    <a href="index.php?section=contact#container"><img src="images/telefone.gif" ></a>

								</div>
						
							</div>
					</div>
					<!-- ####################################################################################################### -->
				</div>
			</div>
			
		</div>
    </body>
</html>
