<?
try
{
	$sth = $db->prepare ("SELECT cod, titulo FROM area_pesquisa ORDER BY titulo");
	
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
                            <h3 id="conteudo-titulo">&Aacute;reas de pesquisa</h3>
							 <div id="conteudo-texto" class="conteudo-geral conteudo-tags">
							<? while ($obj = $sth->fetch (PDO::FETCH_OBJ))
							{ ?>
									<h2><a href="index.php?section=research_projects&amp;itemId=<?= $obj->cod ?>">&raquo; <?= $obj->titulo ?></a></h2>
                            		
                            		<?
								}
								?>

                            </div>
					</div>

</div>
</div>
</div>
</div>
