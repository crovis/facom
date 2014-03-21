<?
if (isset ($_GET['itemId']) && is_numeric ($_GET['itemId']))
	$itemId = $_GET['itemId'];
else
	$itemId = 0;

if (!$itemId)
	include 'oportunidades.php';
else
{
	try
	{
		$sth = $db->prepare ("SELECT *, to_char (data, 'DD-MM-YYYY') AS data FROM oportunidade WHERE cod = '". $itemId ."'");
		
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
                          	<a href="index.php?section=oportunidades" class="moreModify">Voltar para oportunidades</a>
                          </div>
                            
							<h3> <?= $obj->titulo ?> - <?= $obj->data ?></h3>
							<div class="conteudo-geral conteudo-tags"><?= nl2br($obj->texto) ?></div>
							<p>
								Contato: <?= $obj->contato ?></p>
								<p><a href="index.php?section=oportunidades">&laquo; voltar</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?
}
?>
