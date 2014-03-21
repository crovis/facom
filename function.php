<?
function swf ($endereco, $largura, $altura)
{
	?>
	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="<?= $largura ?>" height="<?= $altura ?>" id="body" align="middle">
	<param name="movie" value="<?= $endereco ?>" />
	<param name="wmode" value="transparent" />
	<param name="quality" value="high" />
	<param name="allowScriptAccess" value="sameDomain" />
	<embed wmode="transparent" src="<?= $endereco ?>" quality="high" width="<?=$largura?>" height="<?=$altura?>" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
	</object>
	<?
}

function limitText ($texto, $max_car)
{
	if($max_car <= 3 || strlen ($texto) < $max_car)
		return $texto;
	
	$texto = substr (strip_tags ($texto), 0, $max_car - 2);
	
	$pos1 = strrpos ($texto, " ");
	$pos2 = strrpos ($texto, ",");
	$pos3 = strrpos ($texto, ".");
	
	$pos = max ($pos1, $pos2, $pos3);
	
	$texto = substr ($texto, 0, $pos);
	
	$texto .= "...";
	
	return $texto;
}

function textValidate ($valor)
{
	$padrao = "((text|font)-?)?(family|face|size)[ ]*[:=][ ]*(('[^'>]*')|(\"[^\">]*\")|([^ >]*)|([^;>\"']*;))";
	
	$valor = eregi_replace ($padrao,'', $valor);
	
	$padrao = "class[ ]*[:=][ ]*(('[^'>]*')|(\"[^\">]*\")|([^ >]*))";
	
	$valor = eregi_replace ($padrao,'class="font"', $valor);	
	
	$valor = eregi_replace ('<[ ]*font[ ]*>','<font class="font">', $valor);	

	$valor = eregi_replace ('<[ ]*H[0-9]+', '<span class="font"', $valor);
	$valor = eregi_replace ('<[ ]*/[ ]*H[0-9]+', '</span', $valor);
	$valor = stripslashes ($valor);

	return $valor;
}

function month($mes = NULL)
{
	if ($mes == NULL)
		$mes = date ("m");
	
	switch ($mes)
	{
		case 1:
			return "Janeiro";
			
		case 2:
			return "Fevereiro";
			
		case 3:
			return "Mar&ccedil;o";
			
		case 4:
			return "Abril";
			
		case 5:
			return "Maio";
			
		case 6:
			return "Junho";
			
		case 7:
			return "Julho";
			
		case 8:
			return "Agosto";
			
		case 9:
			return "Setembro";
			
		case 10:
			return "Outubro";
			
		case 11:
			return "Novembro";
			
		case 12:
			return "Dezembro";
	}
	return false;
}

function colors ($key = FALSE)
{
	$colors = array ('FFD088', 'FF9E9C', 'DEAEDE', '9CC7DE', 'C6AE9C', '891234', '567891', '9CC79C', '234567', 'D6E7D6');
	
	if ($key === FALSE)
		return array_rand ($colors);
	
	return $colors [$key % sizeof ($colors)];
}

function randomHash ($size = 32)
{
	$hash = '';
	while (strlen ($hash) < $size)
		$hash .= substr('0123456789abcdef', rand(0,15), 1);
	
	return $hash;
}

function pageMenu ($table, $page, $actual)
{
	global $db, $section;
	
	try
	{
		$sql = "SELECT COUNT(*) AS total FROM ". $table;
		
		$sth = $db->prepare ($sql);
		
		$sth->execute ();
		
		$obj = $sth->fetch (PDO::FETCH_OBJ);
	}
	catch (PDOException $e)
	{
		if ($_DEBUG) die ($e->getMessage ());
	}
	
	if (!$obj)
		return '<li class="disabled"><a>&laquo; Anterior</a></li><li>1</li><li><a>Próximo &raquo;</a></li>';
	
	$total = $obj->total;
	
	if (!$total)
		return '<li class="disabled"><a>&laquo; Anterior</a></li><li><a>1</a></li><li><a>Próximo &raquo;</a></li>';
	
	$numberOfPages = ceil ($total / $page);
	
	$pageIniti = $actual - 6;
	$pageFinal = $actual + 6;
	
	if ($pageIniti < 1)
		$pageFinal -= $pageIniti;
	
	if ($pageFinal > $numberOfPages)
	{
		$pageIniti -= ($pageFinal - $numberOfPages);
		$pageFinal = $numberOfPages;
	}
	
	if ($pageIniti < 1)
		$pageIniti = 1;
	
	$str = '';
	for ($i = $pageIniti ; $i <= $pageFinal ; $i++)
		if ($i == $actual)
			$str .= '<li><a>'. $i .'</a></li>';
		else
			$str .= '<li onclick="JavaScript: document.location=\'index.php?section='. $section .'&amp;page='. $i .'\';"><a>'. $i .'</a></li>';
	
	if ($actual == 1)
		$previous = '<li class="disabled"><a>&laquo; Anterior</a></li>';
	else
		$previous = '<li onclick="JavaScript: document.location=\'index.php?section='. $section .'&amp;page='. ($actual - 1) .'\';"><a>&laquo; Anterior</a></li>';
	
	if ($actual == $i - 1)
		$next = '<li class="disabled"><a>Próximo &raquo;</a></li>';
	else
		$next = '<li onclick="JavaScript: document.location=\'index.php?section='. $section .'&amp;page='. ($actual + 1) .'\';"><a>Próximo &raquo;</a></li>';
	
	if ($actual == 1)
		$first = '<li class="disabled"><a>Primeira</a></li>';
	else
		$first = '<li onclick="JavaScript: document.location=\'index.php?section='. $section .'&amp;page=1\';"><a>Primeira</a></li>';
		
	if ($actual == $numberOfPages)
		$last = '<li class="disabled"><a>Última</a></li>';
	else
		$last = '<li onclick="JavaScript: document.location=\'index.php?section='. $section .'&amp;page='. $numberOfPages .'\';"><a>Última</a></li>';
	
	return $previous . $first . $str . $last . $next;
}
?>
