<?php
$noticia = new Post();

$noticias = $noticia->find(array('condition' => array('publicar' => '1'), 'order' => array('data'), 'orderCondition' => 'DESC', 'limit' => 3));
foreach ($noticias as $noti):
    ?>
        <div class="noticia-unica">
		      <h4 id="titulo-noticia"><a  id="titulo-noticia-link" href="index.php?section=new&amp;itemId=<?= $noti['noticia']['cod']  ?>"><?php echo $noti['noticia']['titulo'] ?></a></h4>
		      <p id="conteudo-noticia"><b id="data-noticia"><?php echo date('d/m/y', strtotime($noti['noticia']['data'])) ?> - </b><?php echo limitText($noti['noticia']['texto'], 100); ?></p>
		</div>

    <?php
endforeach;
?>
