<?

try
{
	$sth = $db->prepare ("SELECT *, to_char (data_inicial, 'DD-MM-YYYY') AS data_ini,
						  to_char (data_final, 'DD-MM-YYYY') AS data_fim
						  FROM agenda ORDER BY data_inicial DESC LIMIT 3");
	
	$sth->execute ();
}
catch (PDOException $e)
{
	if ($_DEBUG) die ($e->getMessage ());
}

?>

<div id="agenda" class="square">
	<div class="brownHeader"><h4>Agenda</h4></div>
	<?
	while ($obj = $sth->fetch (PDO::FETCH_OBJ))
	{
		?>
	
		<div class="date"><?= $obj->data_ini?> a <?= $obj->data_fim?></div>
		<div class="linkSpecial"><a href="index.php?section=calendar&amp;itemId=<?= $obj->cod ?>"><?= limitText ($obj->titulo, 55); ?></a></div>
		<div class="littleText"><?= limitText (str_replace (array ('<p>', '</p>'), '', $obj->texto), 80) ?></div>
		<?
	}
	?>
	<a href="index.php?section=calendars" class="more">leia mais &raquo;</a>
</div>


