<?
try
{
	$sql = "SELECT *, to_char (data_inicial, 'DD/MM/YYYY') AS data_ini, to_char (data_final, 'DD/MM/YYYY') AS data_fim 
						  FROM agenda WHERE publicar = '1' ORDER BY data_inicial DESC LIMIT 6";
						  
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
                            <h3 id="conteudo-titulo">Agenda</h3>
							 <div id="conteudo-texto" class="conteudo-geral conteudo-tags">
							<? while ($obj = $sth->fetch (PDO::FETCH_OBJ))
							{ ?>
									<h2><a href="index.php?section=calendar&amp;itemId=<?= $obj->cod ?>"><?= $obj->titulo ?></a> - <?= $obj->data_ini ?> a <?= $obj->data_fim ?> </h2>
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

