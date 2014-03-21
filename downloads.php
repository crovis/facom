<?
try
{
	$sth = $db->prepare ("SELECT * FROM download ORDER BY titulo");
	
	$sth->execute ();
	
	
}
catch ( PDOException $e )
{
	if ( $_DEBUG ) die ( $e->getMessage () );
}
?>
