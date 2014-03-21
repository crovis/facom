<?
try
{
	$sth = $db->prepare ("SELECT *, to_char (_update, 'DD-MM-YYYY HH24:MI:SS') AS data_hour_format FROM mural ORDER BY _update DESC LIMIT 10 OFFSET ". (10 * ($page - 1)));
	
	$sth->execute ();
}
catch ( PDOException $e )
{
	if ( $_DEBUG ) die ( $e->getMessage () );
}
?>




<div id="conteudo" class="clearfix">
            <div class="container conteudo-principal">
            
                <div id="bloco-conteudo" class="row">
                     <div class="col-sm-10 col-md-10 col-lg-10">
                         <div class="conteudo-geral">
                            <h3 id="conteudo-titulo">Mural</h3>
							 <div id="conteudo-texto" class="conteudo-geral conteudo-tags">
							<? while ($obj = $sth->fetch (PDO::FETCH_OBJ))
								{
							?>
									<h2><a href="index.php?section=research_projects&amp;itemId=<?= $obj->cod ?>"><?= $obj->data_hour_format ?></a></h2>
									<p><?= limitText (str_replace (array ('<p>', '</p>'), '', strip_tags ($obj->texto)), 200) ?></p>
                            		<hr>
                            		
                            	<?
									}
								?>

								<ul class="pagination">
								  <?= pageMenu ('mural', 10, $page) ?>
								</ul>
                            </div>
					</div>
				</div>
			</div>
	</div>
</div>