<?
try
{
	$sql = "SELECT s.year, count(s.year) AS total FROM (SELECT to_char(data, 'YYYY') AS year FROM dct.monografia) s GROUP BY s.year ORDER BY s.year DESC";

	$sth = $db->prepare ($sql);
	
	$sth->execute ();
	
	$years = array ();
	
	while ($obj = $sth->fetch (PDO::FETCH_OBJ))
		$years [$obj->year] = $obj->total;
	
	if (!sizeof ($years))
		$years [date ('Y')] = '0';
	
	$year = isset ($_GET['year']) && !empty ($_GET['year']) && is_numeric ($_GET['year']) && array_key_exists ($_GET ['year'], $years) ? $_GET['year'] : reset (array_keys ($years));
	
	$language = array ('_PT_' => 'Português', '_EN_' => 'Ingles', '_ES_' => 'Espanhol');
	
	$sql = "SELECT *, to_char(data, 'MM-YYYY') AS fdata FROM monografia WHERE date_part('year',data) = '". $year ."'";
	
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
                            <h3 id="conteudo-titulo">Monografias de Gradua&ccedil;&atilde;o</h3>
							 <div id="conteudo-texto" class="conteudo-geral conteudo-tags">
							 	<div class="col-md-6 filtro-buscar">
									<select class="filterform" name="year" onchange="JavaScript: document.location='?section=<?= $section ?>&year=' + this.options[this.selectedIndex].value;">
										<?
										foreach ($years as $i => $t)
											echo '<option value="'. $i .'" '. ($i == $year ? 'selected="selected"' : '') .'>'. $i .': '. $t .' disserta&ccedil;&atilde;o(&atilde;es)</option>';
										?>
									</select>
								</div>
								<div class="clearfix"></div>

								<?
									while ($obj = $sth->fetch (PDO::FETCH_OBJ))
									{
										$data = explode ('-', $obj->fdata);
											?>

											<h2><a href="gestor/titan.php?target=openFile&fileId=<?= $obj->monografia ?>"><?= $obj->titulo ?></a></h2>
											<div class="informacoes"><p>Em <?= $language [$obj->idioma] ?> com <?= $obj->paginas ?> p&aacute;ginas,  <?= month ($data [0]) ?> de <?= $data [1] ?> <a href="gestor/titan.php?target=openFile&fileId=<?= $obj->monografia ?>">Download</a> </p></div>
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
</div>
