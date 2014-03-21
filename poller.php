<?
try
{
	$sth = $db->prepare ("SELECT * FROM enquete_answer WHERE _poller = '". $itemId ."' ORDER BY _order");

	$sth->execute ();
}
catch (PDOException $e)
{
	if ($_DEBUG) die ($e->getMessage ());
}


$answer = array ();
$total = 0;
while ($obj = $sth->fetch (PDO::FETCH_OBJ))
{
	$answer [$obj->_order]['_LABEL_'] = $obj->_label;
	$answer [$obj->_order]['_VOTES_'] = $obj->_votes;
	
	$total += (int) $obj->_votes;
}

switch ($objQuestion->_graphic)
{
	case '_HORIZONTAL_':
		define ('WIDTH', 150);
		define ('HEIGHT', 10);
		
		foreach ($answer as $key => $array)
		{
			$percentage = $total ? ($array ['_VOTES_'] / $total) * 100 : 0;
			?>
			<tr>
				<td style="font-weight: bold; color: #<?= colors ($key) ?>" nowrap="nowrap">
					<?= $array ['_LABEL_'] ?>
				</td>
				<td>&nbsp;</td>
				<td style="font-weight: bold; color: #<?= colors ($key) ?>" align="right">
					<?= number_format ($percentage, 2, ',', '.') ?>%
				</td>
				<td>&nbsp;</td>
				<td style="font-weight: bold; color: #<?= colors ($key) ?>" align="right">
					<?= $array ['_VOTES_'] ?>
				</td>
			</tr>
			<tr>
				<td colspan="5">
					<img src="gestor/titan.php?target=script&amp;toSection=enquete&amp;file=graphicPoint&amp;cor=<?= colors ($key) ?>" height="<?= HEIGHT ?>" width="<?= round (WIDTH * ($percentage / 100) + 2.0) ?>" alt="Porcentagem" />
				</td>
			</tr>
			<?
		}
		?>
		<tr style="height:3px;"><td></td></tr>
		<tr>
			<td colspan="7" style="color: #333333; text-align: right;">
				Total de <b><?= $total ?></b> votos
			</td>
		</tr>
		<?
		break;
		
	case '_VERTICAL_':
		define ('WIDTH', 15);
		define ('HEIGHT', 150);
		$flag = FALSE;
		
		foreach ($answer as $key => $array)
		{
			$percentage = $total ? ($array ['_VOTES_'] / $total) * 100 : 0;			
			?>
			<tr>
				<td style="font-weight: bold; color: #<?= colors ($key) ?>" nowrap="nowrap">
					<?= $array ['_LABEL_'] ?>
				</td>
				<td>&nbsp;</td>
				<td style="font-weight: bold; color: #<?= colors ($key) ?>" align="right">
					<?= number_format ($percentage, 2, ',', '.') ?>%
				</td>
				<td>&nbsp;</td>
				<td style="font-weight: bold; color: #<?= colors ($key) ?>" align="right">
					<?= $array ['_VOTES_'] ?>
				</td>
			</tr>
			<?
		}
		$contAnswer = sizeof ($answer);
		?>
		<tr style="height:3px;"><td></td></tr>
		<tr>
			<td colspan="5" style="color: #333333; text-align: right;">
				Total de <b><?= $total ?></b> votos
			</td>
		</tr>
		<tr>
			<td colspan="5">
				<table align="center" border="0" style="width:1%;">
					<tr valign="bottom" style="height:100%; width:100%;">
						<?
						for ($i = 1 ; $i <= $contAnswer ; $i++)
						{
							$percentage = $total ? ($answer [$i]['_VOTES_'] / $total) * 100 : 0;
							echo '<td align="center"><img src="gestor/titan.php?target=script&toSection=enquete&file=graphicPoint&cor='. colors ($i) .'" height="'. round (HEIGHT * ($percentage / 100) + 2.0) .'" width="'. WIDTH .'"></td>';
						}
						?>
					</tr>
				</table>
			</td>
		</tr>
		<?
		break;
		
	case '_PERCENTAGE_':
		foreach ($answer as $key => $array)
		{
			$percentage = $total ? ($array ['_VOTES_'] / $total) * 100 : 0;
			?>
			<tr>
				<td style="font-weight: bold; color: #<?= colors ($key) ?>" nowrap="nowrap">
					<?= $array ['_LABEL_'] ?>
				</td>
				<td>&nbsp;</td>
				<td style="font-weight: bold; color: #<?= colors ($key) ?>" align="right">
					<?= number_format ($percentage, 2, ',', '.') ?>%
				</td>
				<td>&nbsp;</td>
				<td style="font-weight: bold; color: #<?= colors ($key) ?>" align="right">
					<?= $array ['_VOTES_'] ?>
				</td>
			</tr>
			<?
		}
		?>
		<tr style="height:3px;"><td></td></tr>
		<tr>
			<td colspan="7" style="color: #333333; text-align: right;">
				Total de <b><?= $total ?></b> votos
			</td>
		</tr>
		<?
		break;
	
	case '_PIZZA_':
		define ('WIDTH', 10);
		define ('HEIGHT', 200);
		$flag = FALSE;
		
		foreach ($answer as $key => $array)
		{
			$percentage = $total ? ($array ['_VOTES_'] / $total) * 100 : 0;
			?>
			<tr>
				<td style="font-weight: bold; color: #<?= colors ($key) ?>" nowrap="nowrap">
					<?= $array ['_LABEL_'] ?>
				</td>
				<td>&nbsp;</td>
				<td style="font-weight: bold; color: #<?= colors ($key) ?>" align="right">
					<?= number_format ($percentage, 2, ',', '.') ?>%
				</td>
				<td>&nbsp;</td>
				<td style="font-weight: bold; color: #<?= colors ($key) ?>" align="right">
					<?= $array ['_VOTES_'] ?>
				</td>
			</tr>
			<?
		}
		$contAnswer = sizeof ($answer);
		?>
		<tr style="height:3px;"><td></td></tr>
		<tr>
			<td colspan="5" style="color: #333333; text-align: right;">
				Total de <b><?= $total ?></b> votos
			</td>
		</tr>
		<tr>
			<td colspan="5" style="text-align: center;">
				<?
				$pedacos = '';
				for ($i = 1 ; $i <= $contAnswer ; $i++)
					$pedacos .= '&partes['. $i .']=' . ($total ? ($answer [$i]['_VOTES_'] / $total) * 100 : 0);
				?>
				<img src="gestor/titan.php?target=script&toSection=enquete&file=graphicPizza&largura=200&altura=200<?= $pedacos ?>" border="0" align="middle" alt="Porcentagem" />
			</td>
		</tr>
		<?
		break;
}
?>