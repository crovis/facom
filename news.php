<?
try
{
	$sth = $db->prepare ("SELECT *, to_char (data, 'DD-MM-YYYY') AS data_format FROM noticia WHERE publicar='1' ORDER BY data DESC LIMIT 20");
	
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
                            <h3 id="conteudo-titulo">Notícias</h3>
							 <div id="conteudo-texto" class="conteudo-geral conteudo-tags">
							<? while ($obj = $sth->fetch (PDO::FETCH_OBJ))
								{
							?>
									<h2><a href="index.php?section=new&amp;itemId=<?= $obj->cod ?>"><?= $obj->titulo ?></a></h2>
									<p><?= limitText (str_replace (array ('<p>', '</p>'), '', strip_tags ($obj->texto)), 200) ?></p>
                            		<hr>
                            		
                            	<?
									}
								?>

                            </div>
					</div>

				</div>
			</div>
		</div>
	</div>

