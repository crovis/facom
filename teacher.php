<?
$cargos = array (	'_ASSISTENTE_I_' 	=> 'Professor Assistente I',
					'_ASSISTENTE_II_'	=> 'Professor Assistente II',
					'_ASSISTENTE_III_'	=> 'Professor Assistente III',
					'_ASSISTENTE_IV_'	=> 'Professor Assistente IV',
					'_ADJUNTO_I_'		=> 'Professor Adjunto I',
					'_ADJUNTO_II_'		=> 'Professor Adjunto II',
					'_ADJUNTO_III_'		=> 'Professor Adjunto III',					
					'_ADJUNTO_IV_'		=> 'Professor Adjunto IV',
					'_ASSOCIADO_I_'		=> 'Professor Associado I',
					'_ASSOCIADO_II_'	=> 'Professor Associado II',
					'_ASSOCIADO_III_'	=> 'Professor Associado III',
					'_ASSOCIADO_IV_'	=> 'Professor Associado IV',
					'_TITULAR_'			=> 'Professor Titular',
					'_VISITANTE_'		=> 'Professor Visitante',
					'_COLABORADOR_'		=> 'Professor Colaborador',
					'_SUBSTITUTO_'		=> 'Professor Substituto');

if (!isset ($_GET['userId']) || !is_numeric ($_GET['userId']) || !$_GET['userId'])
	include 'teachers.php';
else
{
	try
	{
		$sth = $db->prepare ("SELECT * FROM _user WHERE _deleted = '0' AND _type = 'professor' AND _login <> 'admin' AND _id = '". $_GET['userId'] ."'");
				
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
                          	<a href="index.php?section=students" class="moreModify">Voltar para professores</a>
                          </div>
                            
							<h3><?=$obj->_name ?> </h3>
							<div class="conteudo-geral conteudo-tags">
								<h2><?=$cargos [$obj->cargo] ?></h2>
								<b>E-mail:</b> <img src="text2img.php?text=<?= base64_encode ($obj->_email) ?>" alt="email" />
								<?= nl2br($obj->texto) ?>
							<h2>Informações adicionais</h2>
							<p><b>Currículo Lattes:</b> <a href="<?= $obj->lattes ?>">Clique aqui</a> para ver o curr&iacute;culo.</p>
							<b>Página Pessoal:</b> <a href="<?= $obj->url ?>" target="_blank"><?= $obj->url ?></a>

							<?
								if ($obj->educacao)
								{
									?>
									<h2>Educa&ccedil;&atilde;o</h2>
									<p><?= nl2br ($obj->educacao); ?></p>
									<?
								}
								?>
								<?
								if ($obj->publicacoes_relevantes)
								{
									?>
									<h2>Publica&ccedil;&otilde;es Relevantes</h2>
									<p><?= nl2br ($obj->publicacoes_relevantes); ?></p>
									<?
								}
								?>
								<?
								if ($obj->projetos_financiados)
								{
									?>
									<h2>Projetos de Pesquisa em Andamento</h2>
									<p><?= nl2br ($obj->projetos_financiados); ?></p>
									<?
								}
							?>
							<p><a href="index.php?section=teachers">&laquo; voltar</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>

</div>
	<?
}
?>
