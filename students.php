<?


$cursos = array (	'_COMPUTACAO_' 	=> 'Bacharelado em Ciência da Computação',
					'_ANALISE_'		=> 'Bacharelado em Análise de Sistemas',
					'_MESTRADO_'	=> 'Mestrado em Ciência da Computação');

define ('_COMPUTACAO_', 1);
define ('_ANALISE_',	2);
define ('_MESTRADO_', 	3);
define ('_MESTRADO_', 	4);
define ('_MESTRADO_', 	3);
define ('_MESTRADO_', 	3);


$resultados = array (_COMPUTACAO_ 	=> array(),
					 _ANALISE_ 		=> array(),
					 _MESTRADO_		=> array());
					 
try
{
	$sth = $db->prepare ("SELECT * FROM _user WHERE _active = '1' AND _deleted = '0' AND _type = 'aluno' ORDER BY _name");
	
	$sth->execute ();
}
catch (PDOException $e)
{
	if ($_DEBUG) die ($e->getMessage ());
}


while ( $obj = $sth->fetch (PDO::FETCH_OBJ) )
{
	if ( $obj->curso == '_COMPUTACAO_')
		$resultados [_COMPUTACAO_] []	= $obj;
	else if( $obj->curso == '_ANALISE_' )
		$resultados [_ANALISE_] []	= $obj;
	else
		$resultados [_MESTRADO_] []	= $obj;
} 

$count = 0;

?>


<div id="conteudo" class="clearfix">
            <div class="container conteudo-principal">
            
                <div id="bloco-conteudo" class="row">
                     <div class="col-sm-10 col-md-10 col-lg-10">
                         <div class="conteudo-geral">
                            <h3 id="conteudo-titulo">Estudantes</h3>
                          	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-8">
	                          	<div id="topo_filtro" class="form-group filterform filtro-buscar">
	                              <form id="id_filtro" class="filterform" action="#filter_search"><input id="input_filtro" class="filterinput form-control" type="text" placeholder="Buscar nomes"></form>
                            	</div>
                            </div>
               				<div class="clearfix"></div>
							 <div id="conteudo-texto" class="conteudo-geral conteudo-tags">
							 <div id="filter_search">
							 <div class="col-sm-10 col-md-5 col-lg-5">
							 <h3>Análise de Sistemas</h3>
							<? foreach ( $resultados [_ANALISE_] as $obj)
								{
									if ($obj->ano != 5)
									{
								?>
									<h2 id="<?=$obj->_id?>"><a href="index.php?section=student&amp;userId=<?= $obj->_id ?>"><?=$obj->_name ?></a></h2>
                            		
                            	<?
									} 
								}
								?>

								</div>
								<div class="col-sm-10 col-md-5 col-lg-5">
								<h3>Ciência da Computação</h3>
							<? foreach ( $resultados [_COMPUTACAO_] as $obj)
								{
									if ($obj->ano != 5)
									{
								?>
									<h2 id="<?=$obj->_id?>"><a href="index.php?section=student&amp;userId=<?= $obj->_id ?>"><?=$obj->_name ?></a></h2>
                            		
                            	<?
									}
								}
								?>
								</div>
								<div class="col-sm-10 col-md-5 col-lg-5">
								<h3>Mestrado</h3>
								<? foreach ( $resultados [_MESTRADO_] as $obj)
									{
										if ($obj->ano != 5)
										{
									?>

									<h2 id="<?=$obj->_id?>"><a href="index.php?section=student&amp;userId=<?= $obj->_id ?>"><?=$obj->_name ?></a></h2>
                            		
                            	<?
									}
								}
								?>
								</div>
								</div>
					</div>
				</div>
			</div>
	</div>
</div>
</div>

<?php
function convertem($term, $tp) { 
    if ($tp == "1") $palavra = strtr(strtoupper($term),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"); 
    elseif ($tp == "0") $palavra = strtr(strtolower($term),"ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß","àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ"); 
    return $palavra; 
}
?>


<script>

(function ($) {
  jQuery.expr[':'].Contains = function(a,i,m){
      return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase())>=0;
  };

  var buscas = $("#filter_search");

  buscas.find("h3").hide();
  buscas.find("h2").hide();




  function listFilter(topo_filtro, lista_pessoas) {
    var form = $("#id_filtro"), input = $("#input_filtro");

    $(input)
      .change( function () {
      	$(lista_pessoas).find("h3").show();
        var filter = $(this).val();
        if(filter) {
          $(lista_pessoas).find("a:not(:Contains(" + filter + "))").parent().hide();
          $(lista_pessoas).find("a:Contains(" + filter + ")").parent().show();
        } else {
          $(lista_pessoas).find("h2").hide();
          $(lista_pessoas).find("h3").hide();
        }
        return false;
      })
    .keyup( function () {
        $(this).change();
    });
  }

  $(function () {
    listFilter($("#topo_filtro"), $("#filter_search"));
  });
}(jQuery));

  </script>