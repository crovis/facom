

<?
$cargos = array (	'_ASSISTENTE_I_' 	=> 'Professor Assistente I',
					'_ASSISTENTE_II_'	=> 'Professor Assistente II',
					'_ASSISTENTE_III_'	=> 'Professor Assistente III',
					'_ASSISTENTE_IV_'	=> 'Professor Assistente IV',
					'_ADJUNTO_I_'		=> 'Professor Adjunto I',
					'_ADJUNTO_II_'		=> 'Professor Adjunto II',
					'_ADJUNTO_III_'		=> 'Professor Adjunto III',					
					'_ADJUNTO_IV_'		=> 'Professor Adjunto IV',
					'_ASSOCIADO_I_'		=> 'Professor Associado I',
					'_ASSOCIADO_II_'	=> 'Professor Associado II',
					'_ASSOCIADO_III_'	=> 'Professor Associado III',
					'_ASSOCIADO_IV_'	=> 'Professor Associado IV',
					'_TITULAR_'			=> 'Professor Titular',
					'_VISITANTE_'		=> 'Professor Visitante',
					'_COLABORADOR_'		=> 'Professor Colaborador',
					'_SUBSTITUTO_'		=> 'Professor Substituto');

try
{
	$sth = $db->prepare ("SELECT * FROM _user
						WHERE _deleted = '0'
						AND _type = 'professor'
						AND cargo NOT IN ('_COLABORADOR_', '_SUBSTITUTO_', '_VISITANTE_')
						ORDER BY _name");
	
	$sth->execute ();
}
catch (PDOException $e)
{
	if ($_DEBUG) die ($e->getMessage ());
}

?>

<div id="conteudo" class="clearfix">
            <div class="container conteudo-principal">
            
                <div id="bloco-conteudo" class="row">
                     <div class="col-sm-10 col-md-10 col-lg-10">
                         <div class="conteudo-geral">
                            <h3 id="conteudo-titulo">Professores e colaboradores</h3>
                            <div class="col-md-4 col-lg-4 col-xs-12 col-sm-8">
	                          	<div id="topo_filtro" class="form-group filterform filtro-buscar">
	                              <form id="id_filtro" class="filterform" action="#filter_search"><input id="input_filtro" class="filterinput form-control" type="text" placeholder="Filtrar nomes"></form>
                            	</div>
                            </div>
               <div class="clearfix"></div>
               <hr>
							 <div id="conteudo-texto" class="conteudo-geral conteudo-tags">
							 <div id="filter_search">
							 <h3>Professor</h3>
							<? while ($obj = $sth->fetch (PDO::FETCH_OBJ))
								{
							?>
									<h2 id="<?=$obj->_id?>"><a href="index.php?section=teacher&amp;userId=<?= $obj->_id ?>"><?=$obj->_name ?></a></h2>
                            		
                            		<?
								}
							/* Busca professores colaboradores */
							try
							{
								$sth = $db->prepare ("SELECT * FROM _user
													WHERE _deleted = '0'
													AND _type = 'professor'
													AND cargo = '_COLABORADOR_'
													ORDER BY _name");
								
								$sth->execute ();
							}
							catch (PDOException $e)
							{
								if ($_DEBUG) die ($e->getMessage ());
							}
    
								?>

							<h3>Colaborador</h3>
							<? while ($obj = $sth->fetch (PDO::FETCH_OBJ))
								{
							?>
									<h2 id="<?=$obj->_id?>"><a href="index.php?section=teacher&amp;userId=<?= $obj->_id ?>"><?=$obj->_name ?></a></h2>
                            		
                            	<?
									}
									try
										{
											$sth = $db->prepare ("SELECT * FROM _user
																WHERE _deleted = '0'
																AND _type = 'professor'
																AND cargo = '_COLABORADOR_'
																ORDER BY _name");
											
											$sth->execute ();
										}
										catch (PDOException $e)
										{
											if ($_DEBUG) die ($e->getMessage ());
										}


									    ?>									
								

									<h3>Substituto</h3>
									<? while ($obj = $sth->fetch (PDO::FETCH_OBJ))
										{
									?>
											<h2 id="<?=$obj->_id?>"><a href="index.php?section=teacher&amp;userId=<?= $obj->_id ?>"><?=$obj->_name ?></a></h2>
		                            		
		                        	<?
										}
										try
										{
											$sth = $db->prepare ("SELECT * FROM _user
																WHERE _deleted = '0'
																AND _type = 'professor'
																AND cargo = '_VISITANTE_'
																ORDER BY _name");
											
											$sth->execute ();
										}
										catch (PDOException $e)
										{
											if ($_DEBUG) die ($e->getMessage ());
										}
									    
									    
									?>

											<h3>Visitante</h3>
											<? while ($obj = $sth->fetch (PDO::FETCH_OBJ))
												{
											?>
													<h2 id="<?=$obj->_id?>"><a href="index.php?section=teacher&amp;userId=<?= $obj->_id ?>"><?=$obj->_name ?></a></h2>
				                            		
				                        	<?
												} ?>
							</div>
					</div>
				</div>
			</div>
	</div>
</div>
</div>

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