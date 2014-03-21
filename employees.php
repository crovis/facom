<?
					 
try
{
	$sth = $db->prepare ("SELECT * FROM _user WHERE _deleted = '0' AND _type = 'funcionario' AND _login <> 'admin' ORDER BY _name");
	
	$sth->execute ();
}
catch (PDOException $e)
{
	if ($_DEBUG) die ($e->getMessage ());
}

$count = 0;
?>

<script>

(function ($) {
  jQuery.expr[':'].Contains = function(a,i,m){
      return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase())>=0;
  };


  function listFilter(topo_filtro, lista_pessoas) {
    var form = $("#id_filtro"), input = $("#input_filtro");

    $(input)
      .change( function () {
        var filter = $(this).val();
        if(filter) {
          $(lista_pessoas).find("a:not(:Contains(" + filter + "))").parent().hide();
          $(lista_pessoas).find("a:Contains(" + filter + ")").parent().show();
        } else {
          $(lista_pessoas).find("h2").show();
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



<div id="conteudo" class="clearfix">
            <div class="container conteudo-principal">
            
                <div id="bloco-conteudo" class="row">
                     <div class="col-sm-10 col-md-10 col-lg-10">
                         <div class="conteudo-geral">
                            <h3 id="conteudo-titulo">Técnicos administrativos</h3>
                          	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-8">
                              <div id="topo_filtro" class="form-group filterform filtro-buscar">
                                <form id="id_filtro" class="filterform" action="#filter_search"><input id="input_filtro" class="filterinput form-control" type="text" placeholder="Filtrar nomes"></form>
                              </div>
                            </div>
               <div class="clearfix"></div>
							 <div id="conteudo-texto" class="conteudo-geral conteudo-tags">
							 <div id="filter_search">
							<? while ($obj = $sth->fetch (PDO::FETCH_OBJ))
								{
							?>
									<h2 id="<?=$obj->_id?>"><a href="index.php?section=employee&amp;userId=<?= $obj->_id ?>"><?=$obj->_name ?></a></h2>
                            		
                            	<?
									}
								?>
								</div>
					</div>
				</div>
			</div>
	</div>
</div>
</div>