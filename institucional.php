<?
if (!isset ($_GET['itemId']) || !$_GET['itemId'])
	include 'institucionals.php';
else
{	
	try
	{
		$sth = $db->prepare ("SELECT * FROM institucional WHERE cod = ". $itemId);
		
		$sth->execute ();
		
		$obj =  $sth->fetch (PDO::FETCH_OBJ);
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
                      	<a href="index.php?section=institucional" class="moreModify">Voltar para institucional</a>
                      </div>
                        
						<h3> <?= $obj->titulo ?></h3>
						<div class="conteudo-geral conteudo-tags"><?= ($obj->texto) ?></div>
							<p><a href="index.php?section=institucional">&laquo; voltar</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>

<?
}
?>