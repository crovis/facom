<?
try
{
	$sth = $db->prepare ("SELECT * FROM projeto ORDER BY titulo LIMIT 10 OFFSET ". (10 * ($page - 1)));
	
	$sth->execute ();
}
catch (PDOException $e)
{
	if ($_DEBUG) die ($e->getMessage ());
}
?>


<div id="conteudo" class="clearfix">
            <div class="container conteudo-principal">
            
                <div id="bloco-conteudo" class="row">
                     <div class="col-sm-10 col-md-10 col-lg-10">
                         <div class="conteudo-geral">
                            <h3 id="conteudo-titulo">Extens&atilde;o</h3>
							 <div id="conteudo-texto" class="conteudo-geral conteudo-tags">
							<? while ($obj = $sth->fetch (PDO::FETCH_OBJ))
								{
							?>
									<h2><?= limitText ($obj->titulo, 50) ?></h2>
									<p><?= limitText (str_replace (array ('<p>', '</p>'), '', $obj->descricao), 150) ?></p>
                            		<hr>
                            		
                            	<?
									}
								?>

								<ul class="pagination">
								  <?= pageMenu ('projeto', 10, $page) ?>
								</ul>
                            </div>
					</div>
				</div>
			</div>
	</div>
</div>