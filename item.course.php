<?
$courses = array (	'computacao' 			=> 'Ciência da Computação', 
					'engenharia'			=> 'Engenharia da Computação',
					'analise' 				=> 'Análise de Sistemas', 
					'tecnologia_redes'		=> 'Tecnologia em Redes de Computadores',
					'tecnologia_sistemas'	=> 'Tecnologia em Análise e Desenvolvimento de Sistemas',
					'mestrado' 				=> 'Mestrado em Ciência da Computação',
					'doutorado'				=> 'Doutorado em Ciência da Computação',
					'estagio'				=> 'Estágio',
					'mestradop'				=> 'Mestrado Profissional');

if(isset ($_GET['course']) && array_key_exists ($_GET['course'], $courses))
	$course =  $_GET['course'];
else
	$course = 'computacao';
	
if (!isset ($_GET['itemId']) || !$_GET['itemId'])
	include 'education.php';
else
{
	if (isset ($_GET['fatherId']))
		$fatherId = $_GET['fatherId'];
	else
		$fatherId = 0;
	
	if ($fatherId)
	{
		// seleciona o Nome do Pai
		try
		{
			$sth = $db->prepare ("SELECT * FROM ". $course ." WHERE cod = ". $fatherId);
			
			$sth->execute ();
			
			$obj = $sth->fetch (PDO::FETCH_OBJ);
		}
		catch (PDOException $e)
		{
			if ($_DEBUG) die ($e->getMessage ());
		}
		
		$fatherName = $obj->titulo;
	}

	try
	{
		$sth = $db->prepare ("SELECT c.*, m.texto AS padrao FROM ". $course ." c
							  LEFT JOIN modelo m ON m.cod = c.modelo
							  WHERE c.cod = ". $itemId);
		
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
                          <?
								if ($fatherId == 0)
								{
									$path = "education&course=" . $course;
									$title = "";
								}	
								else
								{
									$path = "item.course&amp;course=". $course ."&amp;itemId=". $fatherId;
									$title = $fatherName ." &raquo ";
								}
								?>
                          	<a href="index.php?section=<?= $path ?>" class="moreModify">Voltar para <?=$course?></a>
                          </div>
                            
							<h3><?=$courses [$course] ?></h3>
							<h2><?=$obj->titulo ?></h2>
							<div class="conteudo-geral conteudo-tags">
								<?= !is_null ($obj->padrao) ? $obj->padrao : $obj->texto ?>

								<?
									try
									{
										$sth = $db->prepare ("SELECT * FROM ". $course ." WHERE pai IS NOT NULL AND pai = ". $itemId ." ORDER BY _order");
										
										$sth->execute ();
									}
									catch (PDOException $e)
									{
										if ($_DEBUG) die ($e->getMessage ());
									}
									
									while ($obj = $sth->fetch (PDO::FETCH_OBJ))
									{
										if ($obj->file) 
											$href = "gestor/titan.php?target=openFile&fileId=". $obj->file;
										elseif ($obj->url && (trim ($obj->url) != "http://"))
											$href = $obj->url;
										else
											$href = "index.php?section=item.course&amp;course=". $course ."&amp;fatherId=". $itemId ."&amp;itemId=". $obj->cod;
										?>
										<div class="title">
											<a href=<?= $href ?>>&raquo; <?= $obj->titulo ?></a>
										</div>
										<?
									}
									?>
							</div>
							<hr>
								<p><a href="index.php?section=education">&laquo; voltar</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
<?
}
?>
