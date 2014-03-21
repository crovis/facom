<?

if( !empty($_GET["itemId"]) )
	$where = " WHERE categoria = ".$_GET["itemId"];
else
	$where = "";
	
try
{
	$sth = $db->prepare ("SELECT * FROM projeto_pesquisa ".$where." ORDER BY titulo LIMIT 10 OFFSET ". (10 * ($page - 1)));
	
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
                            <h3 id="conteudo-titulo">Projetos de pesquisa</h3>
							 <div id="conteudo-texto" class="conteudo-geral conteudo-tags">
							<? while ($obj = $sth->fetch (PDO::FETCH_OBJ))
								{
							?>
									<h2><a href="index.php?section=research_projects&amp;itemId=<?= $obj->cod ?>"><?= $obj->titulo ?></a></h2>
									<p><?= limitText (str_replace (array ('<p>', '</p>'), '', strip_tags ($obj->texto)), 200) ?></p>
                            		<hr>
                            		
                            	<?
									}
								?>

								<ul class="pagination">
								  <?= pageMenu ('projeto_pesquisa', 10, $page) ?>
								</ul>
                            </div>
					</div>
				</div>
			</div>
	</div>
</div>