<?php
$noticia = new Agenda();
$noticias = $noticia->find(array('order' => array('data_inicial'), 'orderCondition' => 'DESC', 'limit' => 5));
foreach ($noticias as $noti):
    ?>

    <p><b><?php echo date('d/m/y', strtotime($noti['agenda']['data_inicial'])); ?> &agrave  <?php echo date('d/m/y', strtotime($noti['agenda']['data_final'])); ?> </b><a href="?section=calendar&itemId=<?php echo $noti['agenda']['cod'] ?>"> <?php echo $noti['agenda']['titulo'] ?></a></p>
    <?php
endforeach;
?>


