<?php
$noticia = new Research();
$proj1 = $_CONFIGURE['_RESEARCH_PROJECT_1_'];
$proj2 = $_CONFIGURE['_RESEARCH_PROJECT_2_'];
$proj3 = $_CONFIGURE['_RESEARCH_PROJECT_3_'];

$noticias = $noticia->find(array('condition' => array('cod = '.$proj1.' OR cod = '.$proj2.' OR cod = '.$proj3.'' => null), 'order' => array('cod'), 'orderCondition' => 'DESC', 'limit' => 5));
foreach ($noticias as $noti):
    ?>
    <p><a href="?section=research_project&itemId=<?php echo $noti['projeto_pesquisa']['cod'] ?>"><?php echo limitText($noti['projeto_pesquisa']['titulo'], 55) ?></p>
    <?php
endforeach;
?>
