<?
try
{
	$db = new PDO ('pgsql:host='. $_DATABASE ['host'] .' port=5432 dbname='. $_DATABASE ['name'] .' user='. $_DATABASE ['user'] .' password='. $_DATABASE ['password'], $_DATABASE ['user'], $_DATABASE ['password']);
	
	$db->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$db->exec ('SET datestyle TO ISO, DMY');
	
	$db->exec ('SET search_path = '. $_DATABASE ['schema']);
}
catch (PDOException $e)
{
	die ($e->getMessage ());
}
?>
