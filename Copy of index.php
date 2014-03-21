<?
require 'config.inc.php';
require 'connection.php';
require 'function.php';

session_name ($_SESSION_NAME);

session_start ();

$cryptinstall = './extra/crypt/cryptographp.fct.php';

include_once $cryptinstall;  

$sections = array ('home', 'news', 'new', 'calendar', 'calendars', 'contact', 'func', 'students', 'student',
					'teachers', 'teacher', 'employees', 'employee', 'links', 'education', 'item.course', 'register',
					'categories_projects', 'research_projects', 'research_project', 'ext_projects', 'ext_project',
					'institucional', 'downloads', 'mural', 'oportunidades', 'oportunidade', 'report', 'monograph', 
					'dissertation', 'thesis','cameras');

if (!isset ($_GET['section']) || !in_array ($_GET['section'], $sections))
	$section = 'home';
else
	$section = $_GET['section'];

$page = isset ($_GET['page']) && is_numeric ($_GET['page']) && $_GET['page'] ? $_GET['page'] : 1;

if (isset ($_GET['itemId']) && is_numeric ($_GET['itemId']))
	$itemId = $_GET['itemId'];
else
	$itemId = 0;

try
{
	$sth = $db->prepare ("SELECT _content FROM _simple WHERE _id = '_CONFIGURADOR_'");
	
	$sth->execute ();
	
	$obj = $sth->fetch (PDO::FETCH_OBJ);
	
	$_CONFIGURE = unserialize (base64_decode ($obj->_content));
}
catch (PDOException $e)
{
	if ($_DEBUG) die ($e->getMessage ());
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-BR">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Facom - Faculdade de Computa&ccedil;&atilde;o </title>
	<link href="interface/css/gsearch.css" type="text/css" rel="stylesheet" />
	<link rel="alternate" type="application/rss+xml" title="RSS - Agendas DCT/UFMS" href="<?= $_URL ?>rss/calendar.php" />
	<link rel="alternate" type="application/rss+xml" title="RSS - Downloads DCT/UFMS" href="<?= $_URL ?>rss/downloads.php" />
	<link rel="alternate" type="application/rss+xml" title="RSS - Links DCT/UFMS" href="<?= $_URL ?>rss/links.php" />
	<link rel="alternate" type="application/rss+xml" title="RSS - Mural DCT/UFMS" href="<?= $_URL ?>rss/mural.php" />
	<link rel="alternate" type="application/rss+xml" title="RSS - Notícias DCT/UFMS" href="<?= $_URL ?>rss/news.php" />
	<link rel="alternate" type="application/rss+xml" title="RSS - Oportunidades DCT/UFMS" href="<?= $_URL ?>rss/oportunidades.php" />
	
	<style type="text/css">
		@import url("interface/css/main.css");
	</style>
	<script src="http://www.google.com/uds/api?file=uds.js&amp;v=1.0&amp;key=ABQIAAAAKvFZsRm-4Gs-yp64SE1gXRSQmMmAhM_n0122sy512XLESGUhnhTbqpf7RUiVHhOJ7QVl8U8E18j2pw" type="text/javascript"></script>
	<script type="text/javascript" src="gestor/titan.php?target=loadFile&amp;file=js/sha1.js"></script>
	<script type="text/javascript" src="js/prototype.js"></script>
	<script type="text/javascript" src="js/js.js"></script>
	<script type="text/javascript" src="js/googlesearch.js"></script>
</head>
<body onload="JavaScript: start ();">

<div id="master" class="master">
	<div id="yellowBar">
		<span>Universidade Federal de Mato Grosso do Sul</span>
		<select class="select" onchange="javascript:novaJanela(this.value)">
			  <option value="http://www.ufms.br">Site da UFMS</option>
			  <option value="http://www.ledes.net/sien/">Cursos</option>
			  <option value="http://www.ufms.br/index.php?id=31&amp;modo=cd&amp;direct=true">Departamentos</option>
			  <option value="http://www.ufms.br/index.php?id=31&amp;modo=prei">Pr&oacute;-Reitorias</option>
			  <option value="http://www.ufms.br/index.php?id=31&amp;modo=os">&Oacute;rg&atilde;os Suplementares</option>
			  <option value="http://www.copeve.ufms.br/">Vestibular</option>
			  <option value="http://www.ufms.br/index.php?id=11&amp;modo=sca&amp;categoria_id=4">Servi&ccedil;os &agrave; Comunidade</option>
			  <option value="http://mail.nin.ufms.br/webmail/">WebMail da UFMS</option>
			  <option value="http://www.ufms.br/web/boletim/index2.php">Boletim de Servi&ccedil;o</option>
			  <option value="http://www.ufms.br/ouvidoria/index.php">Ouvidoria</option>
			  <option value="http://www.ufms.br/index.php?id=11&amp;categoria_id=11">Concursos</option>
		</select>
	</div>

		<div id="middleLeft">
			<img src="interface/image/logo-facom.png" alt="Laboratório de Ensino" name="logo" width="595" height="90" border="0" usemap="#logoMap" id="logo" title="Laboratório de Ensino" />
			
			<map name="logoMap" id="logoMap">
				<area shape="rect" coords="3,4,517,88" href="index.php" alt="dct" />
				<area shape="rect" coords="524,8,581,84" href="http://www.ufms.br" alt="ufms" />
			</map>
			
			<div id="menu">
				<ul id="nav">
				
				<li id="first" style="width:100px" class="menuLi">
					<div class="_nav" style="border-left-width: 0px;"><a href="#">Institucional</a></div>
					<ul class="ulFat">
						<? require ( "institucionals.php" )?>
					</ul>
				</li>
				
				<li style="width:80px" class="menuLi">
					<div><a href="#">Pessoas</a></div>
					<ul>
						<li class="menuLi"><a href="index.php?section=students">Alunos</a></li>
						<li class="menuLi"><a href="index.php?section=employees">Funcionários</a></li>
						<li class="menuLi"><a href="index.php?section=teachers">Professores</a></li>
					</ul>
				</li>
				
				<li style="width:80px" class="menuLi">
					<div><a href="#">Ensino</a></div>
					<ul>
						<li class="menuLi liFat"><a href="index.php?section=education&amp;course=analise">Análise de Sistemas</a></li>
						<li class="menuLi liFat"><a href="index.php?section=education&amp;course=computacao">Ciência da Computação</a></li>
						<li class="menuLi liFat"><a href="index.php?section=education&amp;course=engenharia">Engenharia de Computação</a></li>
						<li class="menuLi liFat"><a href="index.php?section=education&amp;course=tecnologia_sistemas">Tec. Desenvolv. de Sistemas</a></li>
						<li class="menuLi liFat"><a href="index.php?section=education&amp;course=tecnologia_redes">Tec. Redes de Computadores</a></li>
						<li class="menuLi liFat"><a href="index.php?section=education&amp;course=mestrado">Mestrado C. da Computação</a></li>
						<li class="menuLi liFat"><a href="index.php?section=education&amp;course=doutorado">Doutorado C. da Computação</a></li>
						<li class="menuLi liFat"><a href="index.php?section=education&amp;course=estagio">Estágio</a></li>
					</ul>
				</li>
				
				<li class="menuLi">
					<div><a href="index.php?section=ext_projects">Extens&atilde;o</a></div>
				</li>

				<li id="last" style="width:80px" class="menuLi">
					<div><a href="#">Pesquisa</a></div>
					<ul class="ulFatRight">
						<li class="menuLi liFatRight"><a href="index.php?section=categories_projects">Áreas de pesquisa</a></li>
						<li class="menuLi liFatRight"><a href="index.php?section=research_projects">Projetos de pesquisa</a></li>
						<li class="menuLi liFatRight"><a href="index.php?section=report">Relatórios Técnicos</a></li>
						<li class="menuLi liFatRight"><a href="index.php?section=monograph">Monografias</a></li>
						<li class="menuLi liFatRight"><a href="index.php?section=dissertation">Dissertações</a></li>
						<li class="menuLi liFatRight"><a href="index.php?section=thesis">Teses</a></li>
					</ul>
				</li>
				
				<li style="width:80px" class="menuLi">
					<div><a href="#">Canais</a></div>
					<ul>
						<li class="menuLi"><a href="index.php?section=calendars">Agenda</a></li>
						<li class="menuLi"><a href="index.php?section=downloads">Downloads</a></li>
						<li class="menuLi"><a href="index.php?section=links">Links</a></li>
						<li class="menuLi"><a href="index.php?section=mural">Mural</a></li>
						<li class="menuLi"><a href="index.php?section=news">Notícias</a></li>
						<li class="menuLi"><a href="index.php?section=oportunidades">Oportunidades</a></li>
					</ul>
				</li>
				
				<li style="width:80px" class="menuLi">
					<div><a href="index.php?section=contact">Contato</a></div>
				</li>				
				</ul>
			</div>
			<div class="sqMain" id="results" style="display: none">
				<div class="sqTitle">
					<label style="float: left;">Resultados</label>
				</div>
				<div class="sqBody" id="searchResults">
				Carregando...
				</div>
			</div>
			
			<div id="content">
				<!-- Seção de informações do site-->
				<? include ( $section .".php" ) ?>
			</div>
  		</div>
		
		<div id="right">
			<div id="searchGoogle">
				<fieldset id="google">
					<div class="busca">Busca</div>
					<div id="searchForm"></div>
				</fieldset>
			</div>
			<input type="text" value="Achar no Site..." onfocus="this.value=(this.value=='Achar no Site...')? '' : this.value ;" />
			<input type="image" src="images/search2.png" id="search" alt="Search" />
			
			<div id="twitter" onclick="JavaScript: document.location='https://twitter.com/<?= $_TWITTER ['login'] ?>';">
				<div class="follow">
					<img src="interface/image/twitter.png" border="0" align="absmiddle" alt="" />
					Siga-nos no Twitter...
				</div>
				<div class="timeline" id="timeline">
				</div>
			</div>
			
			<div class="nav">
				<label>Área Restrita</label>
			</div>
			
			<fieldset id="login">
				<form id="formLogin" name="formLogin" action="gestor/titan.php?target=login" method="post" onsubmit="JavaScript: sha1 ('formLogin'); return false;">
					<div>Login</div>
					<input type="text" name="login" />
					<div>Senha</div>
					<input type="password" name="passwdDraft" /> <input type="hidden" name="password" value="" />
					<input type="submit" name="logar" value="OK &raquo;" class="botao" />
				</form>					
			</fieldset>
			
			<div id="lostPassword">
				<a href="gestor/titan.php?target=login">&raquo; Esqueci minha senha</a><br />
				<a href="index.php?section=register">&raquo; N&atilde;o sou cadastrado</a>
			</div>
			
			<div class="nav">
				<label>Enquete</label>
			</div>
			
			<div id="enquete">
				<?
				try
				{
					$sql = "SELECT * FROM enquete WHERE cod = '". $_CONFIGURE ['_POLLER_'] ."'";
					
					$sth = $db->prepare ($sql);
					
					$sth->execute ();
				
					$objQuestion = $sth->fetch (PDO::FETCH_OBJ);
					
					$itemId = $objQuestion->cod;
				}
				catch (PDOException $e)
				{
					if ($_DEBUG) die ($e->getMessage ());
				}
				?>
				
				<p><?= $objQuestion->pergunta ?></p>
				
				<?
				if (!isset ($_SESSION['hasVoted']) && isset ($_POST['vote']) && is_numeric ($_POST['vote']) && $_POST['vote'])
				{
					try
					{
						$sth = $db->prepare ("UPDATE enquete_answer SET _votes = _votes + 1 WHERE _order = '". $_POST['vote'] ."' AND _poller = '". $itemId ."'");
					
						$sth->execute ();
					
						$_SESSION['hasVoted'] = 1;
					} 
					catch (PDOException $e)
					{
						if ($_DEBUG) die ($e->getMessage ());
					}
				}
				?>
				<fieldset id="enqueteOpts">
				<?
				if (!isset ($_SESSION['hasVoted']) && !isset ($_GET['viewResult']))
				{
					?>
					<form action="index.php" method="post">					
					<?
					try
					{
						$sth = $db->prepare ("SELECT * FROM enquete_answer WHERE _poller = '". $itemId ."' ORDER BY _order");
						
						$sth->execute ();
					}
					catch (PDOException $e)
					{
						if ($_DEBUG) die ($e->getMessage ());
					}
					
					while ($objAnswer = $sth->fetch (PDO::FETCH_OBJ))
					{
						?>
						<div class="opcao"><input type="radio" name="vote" class="enqResp"  value="<?= $objAnswer->_order ?>" /><?= $objAnswer->_label ?></div>
						<?
					}
					?>
					<div id="voto">
						<a href="index.php?viewResult=1" class="seeResult">Ver resultado</a>
						<input type="submit" name="votar" value="Votar" class="botao" />
					</div>
					</form>
					<?
				}
				else
				{
					?>
					<table cellpadding="0" cellspacing="0" align="center" style="width:100%; margin:0 auto;">
						<? include 'poller.php'; ?>
					</table>
					<?
					if (!isset ($_SESSION['hasVoted']))
					{
						?>
						<div id="voto">
							<input type="submit" name="votar" value="Votar" class="botao" onclick="JavaScript: document.location='index.php';" />
						</div>
						<?
					}
				}
				?>
				</fieldset>
			</div>
			<!-- fim Enquete -->
			
			<div id="camera" onclick="JavaScript: document.location='?section=cameras';">
				<img src="interface/image/camera.png" border="0" align="absmiddle" alt="" />
				<b>Câmeras Públicas</b><br />
			</div>
			
		</div>		
		<!-- FIM RIGHT-->

	<div id="footer">
		<div id="footertext">
			Universidade Federal de Mato Grosso do Sul - UFMS <br />
			Faculdade de Computação - Facom ¤ Cidade Universitária ¤ Caixa Postal 549 ¤ CEP 79070-900<br />
			Campo Grande - MS - Brasil ¤ Tel: 67 3345-7455 ¤ Fax: 67 3345-7518 ¤ E-mail: secretaria@facom.ufms.br<br />
		</div>
		<div id="footerImage">
		<a href="http://www.nin.ufms.br/" target="_blank"><img src="interface/image/nin.gif" alt="Núcleo de Informática" id="imageNin" class="imageBase"/></a>
		<a href="http://www.ledes.net/" target="_blank"><img src="interface/image/ledes_base.gif" alt="Laboratório de Engenharia do Software" id="imageLedes" class="imageBase" /></a>
		</div>
	</div>

</div>


</body>
</html>
