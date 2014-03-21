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
                                <?
                                try {
                                    $sth = $db->prepare("SELECT * FROM imagem LIMIT 5");

                                    $sth->execute();
                                } catch (PDOException $e) {
                                    if ($_DEBUG)
                                        die($e->getMessage());
                                }
                                ?>
                               <!-- Wrapper for slides -->
                               <div class="carousel-inner">
                                 <? 
                                 $i = 0;
                                 while ($obj = $sth->fetch(PDO::FETCH_OBJ)) {

                                    if($i==0) {
                                  ?>
                                    <div class="item active">
                                      <a target="_blank" href="<?= $obj->url; ?>"><img src="http://facom.ufms.br/gestor/titan.php?target=viewThumb&amp;fileId=<?= $obj->logo; ?>'&width=680&height=350" alt="<?=$obj->titulo?>" /></a>
                                    </div>
                                    <? }
                                        else { 
                                    ?>

                                      <div class="item">
                                          <a target="_blank" href="<?= $obj->url; ?>"><img src="http://facom.ufms.br/gestor/titan.php?target=viewThumb&amp;fileId=<?= $obj->logo; ?>'&width=680&height=350" alt="<?=$obj->titulo?>" /></a>
                                      </div>

                                    <? 
                                        }
                                          $i++;
                                      }
                                    ?>

                                 
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
                              <h3>&Uacute;ltimas not&iacute;cias</h3>
                                <?
                                  include_once('Elements/news.php');
                                ?>
                              <div class="mais-noticias pull-right">
                                <small><a href="index.php?section=news">mais not&iacute;cias</a></small>
                              </div>
                          </div>

                      </div>
                      
                  
                   </div>
                  </div>

      <div id="conteudo" class="clearfix">
          <div class="container conteudo-principal">

              <div id="bloco-conteudo" class="row">

          <div class="clearfix"></div>

          <div class="col-sm-6 col-md-6 hidden-xs hidden-xs ">
                  <h3 id="conteudo-titulo">Ensino</h3>
                 <div class="col-sm-6 col-md-6">
                      <div class="conteudo-geral conteudo-tags">
                          
                          <div id="conteudo-texto">
                                  <h2><a href="#">An&aacute;lise de Sistemas</a></h2>
                                  <h2><a href="#">Ci&ecirc;ncia da Computa&ccedil;&atilde;o</a></h2>
                                  <h2><a href="#">Engenharia da Computa&ccedil;&atilde;o</a></h2>
                                  <h2><a href="#">Tecnologia em An&aacute;lise e Desenvolvimento de Sistemas</a></h2>
                                  <h2><a href="#">Tecnologia em Redes de Computadores</a></h2>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6 col-md-6">
                      <div class="conteudo-geral conteudo-tags">
                              <div id="conteudo-texto">
                                      <h2><a href="#">Mestrado Profissional</a></h2>
                                      <h2><a href="#">Mestrado em Ci&ecirc;ncia da Computa&cedil;&atilde;o</a></h2>
                                      <h2><a href="#">Doutorado em Ci&ecirc;ncia da Computa&cedil;&atilde;o</a></h2>
                                      <h2><a href="#">Est&aacute;gio</a></h2>
                              </div>
                          </div>
                   </div>
                   <div class="clearfix"></div>
               <h3 id="conteudo-titulo">Pesquisa</h3>
                 <div class="col-sm-6 col-md-6">
                      <div class="conteudo-geral conteudo-tags">
                          <div id="conteudo-texto">
                                  <h2><a href="#">&Aacute;reas de Pesquisa</a></h2>
                                  <h2><a href="#">Projetos de Pesquisa</a></h2>
                                  <h2><a href="#">Relat&oacute;rios T&eacute;cnicos</a></h2>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6 col-md-6">
                      <div class="conteudo-geral conteudo-tags">
                          <div id="conteudo-texto">
                                  <h2><a href="#">Monografias</a></h2>
                                  <h2><a href="#">Disserta&ccedil;&oacute;es</a></h2>
                          </div>
                      </div>
                  </div>

                  <div class="clearfix"></div>
                  
                  <h3 id="conteudo-titulo">Pessoas</h3>
                 <div class="col-sm-6 col-md-6">
                      <div class="conteudo-geral conteudo-tags">
                          <div id="conteudo-texto">
                                  <h2><a href="index.php?section=students">Alunos</a></h2>
                                  <h2><a href="index.php?section=employees">Funcion&aacute;rios</a></h2>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6 col-md-6">
                      <div class="conteudo-geral conteudo-tags">
                          <div id="conteudo-texto">
                                  <h2><a href="index.php?section=teachers">Professores</a></h2>
                          </div>
                      </div>
                  </div>

                  <div class="clearfix"></div>
               <h3 id="conteudo-titulo">Institucional</h3>
                 <div class="col-sm-6 col-md-6">
                      <div class="conteudo-geral conteudo-tags">
                          <div id="conteudo-texto">
                                  <h2><a href="index.php?section=institucional&amp;itemId=5#container">Cursos da FACOM</a></h2>
                                  <h2><a href="index.php?section=institucional&amp;itemId=2#container">Histórico</a></h2>
                                  <h2><a href="index.php?section=institucional&amp;itemId=4#container">Prêmios e Dissertações</a></h2>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6 col-md-6">
                      <div class="conteudo-geral conteudo-tags">
                          <div id="conteudo-texto">
                                  <h2><a href="index.php?section=institucional&amp;itemId=3#container">Salas e Laboratórios</a></h2>
                                  <h2><a href="index.php?section=institucional&amp;itemId=6#container">Identidade Visual</a></h2>
                                  <h2><a href="index.php?section=institucional&amp;itemId=1#container">Sobre a FACOM</a></h2>
                          </div>
                      </div>
                  </div>

                  <div class="clearfix"></div>
                  <h3 id="conteudo-titulo">Canais</h3>
                 <div class="col-sm-6 col-md-6">
                      <div class="conteudo-geral conteudo-tags">
                          <div id="conteudo-texto">
                                  <h2><a href="#">Agenda</a></h2>
                                  <h2><a href="#">Downloads</a></h2>
                                  <h2><a href="#">Links</a></h2>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6 col-md-6">
                      <div class="conteudo-geral conteudo-tags">
                          <div id="conteudo-texto">
                                  <h2><a href="#">Mural</a></h2>
                                  <h2><a href="#">Not&iacute;cias</a></h2>
                                  <h2><a href="#">Oportunidades</a></h2>
                          </div>
                      </div>
                  </div>



          </div>

          <div class="col-sm-6 col-md-6">
          <!-- Agenda FACOM -->

              <div class="agenda">
                  <h3>Agenda</h3>
                  <div class="elemento-agenda">
                      <?php  include_once('Elements/lastEvents.php') ?>
                      <div class="mais-agenda pull-right">
                          <small><a href="?section=calendars">mais</a></small>
                      </div>
                  </div>
              </div>

               <div class="clearfix"></div>

              <div class="oportunidades">
                  <h3>Oportunidades</h3>
                  <div class="elemento-oportunidade">
                      <?php  include_once('Elements/lastOportunities.php'); ?>
                      <div class="mais-oprtunidade pull-right">
                          <small><a href="?section=oportunidade">mais</a></small>
                      </div>
                  </div>
              </div>

              <div class="clearfix"></div>

              <div class="oportunidades">
                  <h3>Pesquisas</h3>
                  <div class="elemento-oportunidade">
                      <?php  include_once('Elements/lastResearchs.php'); ?>
                      <div class="mais-oprtunidade pull-right">
                          <small><a href="?section=research_projects">mais</a></small>
                      </div>
                  </div>
              </div>

          </div>

      </div>
  </div>
  </div>

	
	
</div>


    <!-- ###### -->
    <!-- ###### -->
    
    <!---<div class="clear"></div>
    <br /> 
    <div id="lastestusers">
        <div class="holder">
            <h2>25 anos de computa&ccedil;&atilde;o UFMS</h2>
            <iframe width="430" height="242" src="http://www.youtube.com/embed/FS1IV7YW75s" frameborder="0" allowfullscreen></iframe>
        </div>

    </div>--->
    
    <!---<div class="clear"></div>
    <br />--->
    
    
	
    
	
    <!---<div class="clear"></div>
    <br />--->


    
    <!---<div class="clear"></div>
    <br />
     ######
    <div id="right_column">
      <div class="holder">
        <h2>25 anos de computa&ccedil;&atilde;o UFMS</h2>
            <iframe width="230" height="150" src="http://www.youtube.com/embed/FS1IV7YW75s" frameborder="0" allowfullscreen></iframe>
        </div>
      <div class="holder">
        <h2>Acesso R&aacute;pido</h2>
        <div class="apply"><a href="#"><img src="images/demo/100x100.gif" alt="" /> <strong>Make An Application</strong></a></div>
        <div class="apply"><a href="#"><img src="images/demo/100x100.gif" alt="" /> <strong>Order A Prospectus</strong></a></div>
      </div>
    </div>
    <!-- ###### -->

<!-- ####################################################################################################### -->



<!-- Início do quadro de informações-->
<!--div id="information">
        
<?
/*

  try
  {
  $sth = $db->prepare ("SELECT *, to_char (data, 'DD-MM-YYYY') AS data_format FROM noticia WHERE publicar='1' AND (data_expiracao > CURRENT_TIMESTAMP) ORDER BY data DESC LIMIT 3");

  $sth->execute ();
  }
  catch (PDOException $e)
  {
  if ($_DEBUG) die ($e->getMessage ());
  }

 */
?>
<!-- Início do quadro de notícias -->
<!--div id="news" class="square">
        <div class="brownHeader"><h4>Not&iacute;cias</h4></div>
<?
/* while ($obj = $sth->fetch (PDO::FETCH_OBJ))
  {
  ?>

  <div class="date"><?= $obj->data_format ?></div>
  <div class="linkSpecial"><a href="index.php?section=new&amp;itemId=<?= $obj->cod ?>"><?= limitText ($obj->titulo, 55); ?></a></div>
  <div class="littleText"><?= limitText (str_replace (array ('<p>', '</p>'), '', $obj->texto), 80) ?></div>

  <?
  }
 */
?>
        <a href="index.php?section=news" class="more">leia mais &raquo;</a>
</div>
<!-- Fim do quadro de notícias -->

<!-- Início do quadro de agenda -->
<?
//require ( "agenda.php" );
?>	
<!-- Fim do quadro de agenda -->

<?
/*
  try
  {
  $proj_1 = $_CONFIGURE ['_RESEARCH_PROJECT_1_'];
  $proj_2 = $_CONFIGURE ['_RESEARCH_PROJECT_2_'];
  $proj_3 = $_CONFIGURE ['_RESEARCH_PROJECT_3_'];

  $sql = "SELECT cod, titulo, texto FROM projeto_pesquisa WHERE cod = '". $proj_1 ."' OR cod = '". $proj_2 ."' OR cod = '". $proj_3 ."'";

  $sth = $db->prepare ($sql);

  $sth->execute ();
  }
  catch (PDOException $e)
  {
  if ($_DEBUG) die ($e->getMessage ());
  }
 */
?>
<!-- Início do quadro de Pesquisa -->
<!--div id="research" class="square">
        <div class="brownHeader"><h4>Pesquisa</h4></div>
<?
/* while ($obj = $sth->fetch (PDO::FETCH_OBJ))
  {
  ?>
  <div class="linkSpecial"><a href="index.php?section=research_project&amp;itemId=<?= $obj->cod ?>"><?= limitText (trim($obj->titulo), 55); ?></a></div>
  <div class="littleText"><?= limitText (str_replace (array ('<p>', '</p>'), '', trim($obj->texto)), 80) ?></div>
  <?
  } */
?>
        <br />
        <a href="index.php?section=research_projects" class="more">leia mais &raquo;</a>
</div>
<!-- Fim do quadro de pesquisa -->	
<!--/div-->
<!-- Fim do quadro de informações-->