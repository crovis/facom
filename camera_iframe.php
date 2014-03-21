<?
require 'config.inc.php';

$camera = isset ($_GET['camera']) ? $_GET['camera'] : 'Camera1_Laboratorio1';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="pragma" content="no-cache" /> 
<meta http-equiv="expires" content="-1000" /> 
<meta http-equiv="refresh" content="5"/>
</head>
<body style="margin: 0px; padding: 0px;">
<img src="<?= $_URL ?>camera.php?camera=<?= $camera ?>" border="0" width="568" height="426" />
</body>
</html>
