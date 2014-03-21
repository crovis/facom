<?
if (!isset ($_GET['userId']) || !is_numeric ($_GET['userId']) || !$_GET['userId'])
	include 'students.php';
else
{
	try
	{
		$sth = $db->prepare ("SELECT * FROM _user WHERE _active = '1' AND _deleted = '0' AND _type = 'aluno' AND _login <> 'admin' AND _id = '". $_GET['userId'] ."'");
				
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
                          	<a href="index.php?section=students" class="moreModify">Voltar para alunos</a>
                          </div>
                            
							<h3> <?= $obj->_name ?></h3>
							<div class="conteudo-geral conteudo-tags">
								<b>E-mail:</b> <img src="text2img.php?text=<?= base64_encode ($obj->_email) ?>" alt="email" /> <br />
							<?= nl2br($obj->texto) ?></div>
							<p><b>Ano Conclus&atilde;o:</b> <?= $obj->ano_conclusao ?></p>
							<h2>Informações adicionais</h2>
							<p><b>Currículo Lattes:</b> <a href="<?= $obj->lattes ?>">Clique aqui</a> para ver o curr&iacute;culo.<br /><? } ?></p>
							<b>Página Pessoal:</b> <a href="<?= $obj->url ?>" target="_blank"><?= $obj->url ?></a>
							<p><a href="index.php?section=students">&laquo; voltar</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
