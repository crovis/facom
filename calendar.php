<?
if (!isset ($_GET['itemId']) || !$_GET['itemId'])
	include 'news.php';
else
{
	try
	{
		$sth = $db->prepare ("SELECT *, to_char (data_inicial, 'DD-MM-YYYY') AS data_ini, to_char (data_final, 'DD-MM-YYYY') AS data_fim 
							  FROM agenda WHERE cod = '". $itemId ."'");
		
		$sth->execute ();
		
		$obj = $sth->fetch (PDO::FETCH_OBJ);
	}
	catch (PDOException $e)
	{
		if ($_DEBUG) die ($e->getMessage ());
	}
	?>

	<div id="conteudo" class="clearfix">
            <div class="container conteudo-principal">
            <!--<div class="barra-navegacao">
            	 </div>-->
		<div id="bloco-conteudo" class="row">
                     <div class="col-sm-12 col-md-9 col-lg-9">
                         <div id="conteudo-texto">
                          <div class="barra-navegacao">
                          	<a href="index.php?section=oportunidades" class="moreModify">Voltar para agenda</a>
                          </div>
                            
							<h3> <?= $obj->titulo ?> - <?= $obj->data_ini ?> a <?= $obj->data_fim ?></h3>
							<div class="conteudo-geral conteudo-tags"><?= ($obj->texto) ?></div>
							<p>
								Local: <?= $obj->local ?></p>
								<hr>
								<p><a href="index.php?section=calendars">&laquo; voltar</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?
}
?>


