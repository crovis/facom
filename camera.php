<?
require 'config.inc.php';

$camera = isset ($_GET['camera']) ? $_GET['camera'] : 'Camera1_Laboratorio1';

$camera = ereg_replace ('[^0-9a-zA-Z_]', '', $camera);

$conn_id = ftp_connect($_FTP ['server']);

ftp_login($conn_id, $_FTP ['user'], $_FTP ['passwd']);

ftp_pasv ($conn_id, TRUE);

putenv ('TMPDIR=/var/www/files/tmp');

$contents = ftp_nlist ($conn_id, $camera .'/snapshot-'. date ('Y') .'-'. date ('m') .'-'. date ('d') .'-'. date ('H') .'-'. date ('i') .'-*');

$local_file = $_CACHE . $camera .'.jpg';

if (is_array ($contents))
{
	$remote_file = array_pop ($contents);

	if (!is_null ($remote_file))
	{
		$handle = fopen ($local_file, 'w');
		
		ftp_fget ($conn_id, $handle, $remote_file, FTP_BINARY);
		
		if (!filesize ($local_file))
			copy ($local_file .'_bkp', $local_file);
		else
			copy ($local_file, $local_file .'_bkp');
		
		fclose($handle);
	}
}

ftp_close($conn_id);

header ('Content-Type: image/jpeg');
header ('Content-Disposition: inline; filename=snapshot-'. date ('Y') .'-'. date ('m') .'-'. date ('d') .'-'. date ('H') .'-'. date ('i') .'-'. date ('s'));

$binary	= fopen ($local_file, 'rb');

$buffer = fread ($binary, filesize ($local_file));

echo $buffer;
?>
