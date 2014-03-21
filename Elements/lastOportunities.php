<?php
$noticia = new Oportunity();
$noticias = $noticia->find(array('condition' => array('publicar' => 1), 'order' => array('data'), 'orderCondition' => 'DESC', 'limit' => 5));
foreach ($noticias as $noti):
?>
	<p><a href="?section=oportunidade&itemId=<?php echo $noti['oportunidade']['cod'] ?>"><b><?php echo date('d/m/y', strtotime($noti['oportunidade']['data'])); ?> - </b> <?php echo $noti['oportunidade']['titulo'] ?></p>
    <?php
endforeach;
?>
