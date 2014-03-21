<?
if (!isset ($_GET['userId']) || !is_numeric ($_GET['userId']) || !$_GET['userId'])
	include 'employees.php';
else
{
	try
	{
		$sth = $db->prepare ("SELECT * FROM _user WHERE _deleted = '0' AND _type = 'funcionario' AND _login <> 'admin' AND _id = '". $_GET['userId'] ."'");
				
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
                          	<a href="index.php?section=employees">Voltar para técnicos administrativos</a>
                          </div>
                            
							<h3> <?= $obj->_name ?></h3>
							<div class="conteudo-geral conteudo-tags">
								<h2> Email: <img src="text2img.php?text=<?= base64_encode ($obj->_email) ?>" border="0" style="vertical-align: middle;" alt="imagem" /></h2>
								<? if (trim ($obj->url) != '') 
						{ ?><b>Página Pessoal:</b> <a href="<?= $obj->url ?>" target="_blank"><?= $obj->url ?></a> <br /><? } ?>
								<h2>Informa&ccedil;&otilde;es adicionais</h2>
								<p><? if ($obj->hotsite)
									echo nl2br ($obj->hotsite);
								?> </p>
							</div>
								<hr>
								<p><a href="index.php?section=employees">&laquo; voltar</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>

	<?
}
?>
