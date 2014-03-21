<?
$courses = array (	'computacao' 			=> 'Ciência da Computação', 
					'engenharia'			=> 'Engenharia de Computação',
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
	
try
{
	$sql = "SELECT * FROM ". $course ." WHERE pai IS NULL ORDER BY _order";
		
	$sth = $db->prepare ($sql);
	
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
                            <h3 id="conteudo-titulo"><?= $courses [$course] ?></h3>
							 <div id="conteudo-texto" class="conteudo-geral conteudo-tags">
							<? while ($obj = $sth->fetch (PDO::FETCH_OBJ))
							{ ?>
									<?
									if ($obj->file)
										$href = "gestor/titan.php?target=openFile&fileId=". $obj->file;
									elseif ($obj->url && (trim ($obj->url) != "http://"))
										$href = $obj->url;
									else
										$href = "index.php?section=item.course&amp;course=". $course ."&amp;fatherId=0&amp;itemId=". $obj->cod;
									?>
									<h2><a href=<?= $href ?>>&raquo; <?= $obj->titulo ?></a></h2>
                            		<?
								}
								?>

                            </div>
					</div>

</div>
</div>
</div>
</div>
