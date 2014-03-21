<?
try
{
	$sql = "SELECT *, to_char (data, 'DD/MM/YYYY') AS data_format FROM oportunidade WHERE publicar='1' ORDER BY data DESC LIMIT 20";
	
	$sth = $db->prepare ($sql);
	
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
                            <h3 id="conteudo-titulo">Oportunidades</h3>
							 <div id="conteudo-texto" class="conteudo-geral conteudo-tags">
							<? while ($obj = $sth->fetch (PDO::FETCH_OBJ))
								{
							?>
									<h2><a href="index.php?section=oportunidade&amp;itemId=<?= $obj->cod ?>"><?= $obj->titulo ?></a> - <?= $obj->data_format ?></h2>
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