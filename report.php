
<?
try
{
	$sql = "SELECT s.year, count(s.year) AS total FROM (SELECT to_char(data, 'YYYY') AS year FROM dct.relatorio) s GROUP BY s.year ORDER BY s.year DESC";

	$sth = $db->prepare ($sql);
	
	$sth->execute ();
	
	$years = array ();
	
	while ($obj = $sth->fetch (PDO::FETCH_OBJ))
		$years [$obj->year] = $obj->total;
	
	if (!sizeof ($years))
		$years [date ('Y')] = '0';
	
	$year = isset ($_GET['year']) && !empty ($_GET['year']) && is_numeric ($_GET['year']) && array_key_exists ($_GET ['year'], $years) ? $_GET['year'] : reset (array_keys ($years));
	
	$language = array ('_PT_' => 'Português', '_EN_' => 'Ingles', '_ES_' => 'Espanhol');
	
	$sql = "SELECT *, to_char(data, 'MM-YYYY') AS fdata FROM relatorio WHERE date_part('year',data) = '". $year ."'";
	
	$sth = $db->prepare ($sql);
	
	$sth->execute ();
}
catch (PDOException $e)
{
	if ($_DEBUG) die ($e->getMessage ());
}
?>


<? /*
<div id="main" class="sqMain">
	<div class="sqTitle" style="text-align: right; color: #000;">
		<label style="float: left; color: #900;">Dissertações de Mestrado</label>
		Ano:
		<select name="year" onchange="JavaScript: document.location='?section=<?= $section ?>&year=' + this.options[this.selectedIndex].value;">
			<? /*
			foreach ($years as $i => $t)
				echo '<option value="'. $i .'" '. ($i == $year ? 'selected="selected"' : '') .'>'. $i .': '. $t .' dissertação(ões)</option>';
			?>
		</select>
	</div>
	<div class="sqBody" id="divActive" style="font-family: Verdana, Geneva, sans-serif; font-size: 12px;">
		<? /*
		while ($obj = $sth->fetch (PDO::FETCH_OBJ))
		{
			$data = explode ('-', $obj->fdata);
			?>
			<div class="rTitle" onclick="JavaScript: showReport (<?= /*$obj->cod ?>, this);"><b><?= $obj->titulo ?></b><br /><?= $obj->autores ?></div>
			<div id="_REPORT_<?= $obj->cod ?>" class="rBody" style="display: none;">
				<? /*
				if (!is_null ($obj->dissertacao))
				
					?>
					<img style="float: right; cursor: pointer;" src="gestor/titan.php?target=loadFile&amp;file=interface/file/pdf.gif" onclick="JavaScript: document.location='gestor/titan.php?target=openFile&fileId=<?= $obj->dissertacao ?>';" />
					<?
				}
				?>
				<label>Idioma:</label> <?=// $language [$obj->idioma] ?> <br />
				<label>Número de Páginas:</label> <?= //$obj->paginas ?> <br />
				<label>Data:</label> <?= //month ($data [0]) ?> de <?= //$data [1] ?> <br />
				<?=// $obj->resumo ?>
			</div>
			<?
		}
		?>
	</div>
</div>
*/ ?>


<div id="conteudo" class="clearfix">
            <div class="container conteudo-principal">
            
                <div id="bloco-conteudo" class="row">
                     <div class="col-sm-10 col-md-10 col-lg-10">
                         <div class="conteudo-geral">
                            <h3 id="conteudo-titulo">Disserta&ccedil;&otilde;es de Mestrado</h3>
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

											<h2><a href="gestor/titan.php?target=openFile&fileId=<?= $obj->relatorio ?>"><?= $obj->titulo ?></a></h2>
											<div class="informacoes"><p>Em <?= $language [$obj->idioma] ?> com <?= $obj->paginas ?> p&aacute;ginas,  <?= month ($data [0]) ?> de <?= $data [1] ?> <a href="gestor/titan.php?target=openFile&fileId=<?= $obj->relatorio ?>">Download</a> </p></div>
											<div class="mostrar" id="<?= $obj->cod ?>" style="cursor: hand"}><b>Ver resumo</b> </div>
											<div  class="resumo" id="resumo<?= $obj->cod ?>"><small class="text-muted"><?= nl2br($obj->resumo) ?> </small></div>
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



<script>

	$('.mostrar').css('cursor', 'pointer');
	$(document).ready(function(){
        $(".resumo").hide();
	 
	    $('.mostrar').click(function(){
	    	var id_report = jQuery(this).attr("id");
			$("#resumo" + id_report).slideToggle();
	    });

	});
</script>