<?
try
{
	$sth = $db->prepare ("SELECT * FROM institucional ORDER BY _order");
	
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
                            <h3 id="conteudo-titulo">Institucional</h3>
							 <div id="conteudo-texto" class="conteudo-geral conteudo-tags">

								<? 
								while ( $obj = $sth->fetch (PDO::FETCH_OBJ) )
								{
									?>	
									<h2><a href="index.php?section=institucional&amp;itemId=<?= $obj->cod ?>"><?= $obj->titulo ?></a></h2>
									<?
								}
								?>
                            </div>
					</div>
				</div>
			</div>
		</div>
</div>