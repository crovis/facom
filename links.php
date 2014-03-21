<?
    try {
            $SQL = 'SELECT * FROM link ORDER BY titulo';

        $sth = $db->prepare($SQL);

        $sth->execute();

        ?>
        <div id="conteudo" class="clearfix">
            <div class="container conteudo-principal">
            
                <div id="bloco-conteudo" class="row">
                     <div class="col-sm-10 col-md-10 col-lg-10">
                         <div class="conteudo-geral">
                            <h3 id="conteudo-titulo">Links</h3>
                            <?
                                while ($Obj = $sth->fetch(PDO::FETCH_OBJ)) {

                            ?>
           
                                 <div id="conteudo-texto" class="conteudo-geral conteudo-tags">
                                    <h2><a href="<?=$Obj->url?>"><?=$Obj->titulo?></a></h2>
                                    <p><?= $Obj->texto ?></p>
                                 </div>
            <?
        }
    } catch (PDOException $e) {
        if ($_DEBUG)
            die($e->getMessage());
    }
    ?>
    </div>
    </div>
</div>
</div>
</div>