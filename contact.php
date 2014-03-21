<script type="text/javascript">
<!--
function validar()
{
	// valida campo Nome
	if (document.getElementById ('actor_name').value.length < 1)
	{          
		 alert ("O campo nome não pode ser vazio!");
		 document.getElementById ('actor_name').focus ();
		 return false;
	}
	
	//validacao Email com expressao regular... http://www.mhavila.com.br/topicos/web/valform.html
	var reTipo = /^[\w-]+(\.[\w-]+)*@(([A-Za-z\d][A-Za-z\d-]{0,61}[A-Za-z\d]\.)+[A-Za-z]{2,6}|\[\d{1,3}(\.\d{1,3}){3}\])$/;
	
	if (!reTipo.test (document.getElementById ('actor_email').value))
	{
		 alert ("O campo email não está preenchido corretamente!");
		 document.getElementById ('actor_email').focus ();
		 return false;
	}
	
	// valida campo Assunto
	if (document.getElementById ('actor_subject').value.length < 1)
	{          
		 alert ("O campo assunto não pode ser vazio!");
		 document.getElementById ('actor_subject').focus ();
		 return false;
	}
	
	// valida campo Mensagem
	if (document.getElementById ('actor_message').value.length < 1)
	{          
		 alert ("O campo mensagem não pode ser vazio!");
		 document.getElementById ('actor_message').focus ();
		 return false;
	}

	if (document.getElementById ('actor_spam').value.length < 1)
	{          
		 alert ("O campo de confirmação de imagem não pode ser vazio!");
		 document.getElementById ('actor_spam').focus ();
		 return false;
	}

	return true; //sucesso na validacao
}
// -->
</script>
<?
	if(isset ($_POST['vetor']))
	{
		$vetor = $_POST['vetor'];
		
		$aux = array (	'_actor_name' 		=> 'Seu Nome',
						'_actor_email' 		=> 'Seu E-mail',
						'_actor_subject' 	=> 'Assunto',
						'_actor_message' 	=> 'Mensagem');
		
		$avisos = array ();
		foreach ($aux as $key => $value)
			if (!array_key_exists ($key, $vetor) || trim ($vetor [$key]) == '')
				$avisos [] = '<font color="#990000">Preencha corretamente o campo "'. $value .'"</font>';
				
		if (!chk_crypt($_POST['actor_spam']))
	     	$avisos [] = '<font color="#990000">Texto da imagem não confere! </font>';
		
		if (!sizeof ($avisos))
		{
			/**
			* Envia uma cópia do email para o Profº Ronaldo Ferreira (que está no XML titan.xml)
			*/
			
			// captura o email do XML			
			$file = 'gestor/configure/titan.xml';
			
			if (!file_exists ($file))
				die ('Arquivo de configuração <b>[gestor/configure/titan.xml]</b> não encontrado.');
			
			$xml = file_get_contents ($file);
			
			$pattern = '/<e-mail>(.*?)<\/e-mail>/s';
			
			preg_match_all ($pattern, $xml, $out);
			
			if (!isset ($out [1][0]))
			{
				$pattern = '/e-mail="(.*?)"/s';
				
				preg_match_all ($pattern, $xml, $out);
				
				if (!isset ($out [1][0]))
					die ('A diretiva <b>&lt;e-mail&gt;&lt;/e-mail&gt;</b> deve estar devidamente definida no arquivo de configuração <b>[gestor/configure/titan.xml]</b>.');
			}
						
			/* Destinatário */
			$para = $out [1][0];
			
			/* Assunto */
			$assunto = "[Contato DCT] - " . $vetor['_actor_subject'];
			
			/* Mensagem */
			$mensagem = $vetor['_actor_message'];
			
			/* Cabecalho. Para email em HTML, define o header Content-type. */
			$cabecalho = "From: ". $vetor['_actor_name'] ." <". $vetor['_actor_email'] .">\n";
			$cabecalho .= "MIME-Version: 1.0\n";
			$cabecalho .= "Content-type: text/html; charset=iso-8859-1\n";
			
			/* Enviar o email */
			$enviou = mail($para, $assunto, $mensagem, $cabecalho);

			$sql = "INSERT INTO _contact (". implode (', ', array_keys ($aux)) .") VALUES ('". implode ("', '", $vetor) ."')";
			
			$sth = $db->prepare($sql);
			
			$sth->execute();
			
			if ($sth->rowCount() > 0)
				$avisos [] = '<font color="#009900">Mensagem enviada com sucesso! Em breve, entraremos em contato.</font>';
			else
				$avisos [] = '<font color="#990000">A mensagem n&atilde;o p&ocirc;de ser enviada! Tente novamente mais tarde.</font>';
		}
	}

$_SESSION['code'] = rand(1000,999999);

?>
<div class="sqMain" style="display:;">
	<div class="sqTitle">
		<label style="float: left;">Contato</label>
	</div>
	<div class="sqBody" style="display:;">
		<div class="alignForm">
			<form name="formulario" action="<?= $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'] ?>" method="post" onsubmit="return validar(this);">
			<?
			if (isset ($avisos) && sizeof ($avisos))
			{
				?>
				<div class="row">&nbsp;</div>
				<div class="row">
					<div class="left" style="width:540px; text-align:left;"><? foreach ($avisos as $aviso) echo $aviso .'<br />'; ?></div>
				</div>
				<?
			}
			?>
			<div class="row">&nbsp;</div>
			<div class="row">
				<div class="left">Seu Nome:</div>
				<div class="right">
					<input type="text" id="actor_name" name="vetor[_actor_name]" class="field" value="<?= isset ($vetor ['_actor_name']) ? $vetor ['_actor_name'] : '' ?>" />
				</div>
			</div>
			<div class="row">
				<div class="left">Seu E-mail:</div>
				<div class="right">
					<input type="text" id="actor_email" name="vetor[_actor_email]" class="field" value="<?= isset ($vetor ['_actor_email']) ? $vetor ['_actor_email'] : '' ?>" />
				</div>
			</div>
			<div class="row">
				<div class="left">Assunto:</div>
				<div class="right">
					<input type="text" id="actor_subject" name="vetor[_actor_subject]" class="field" value="<?= isset ($vetor ['_actor_subject']) ? $vetor ['_actor_subject'] : '' ?>" />
				</div>
			</div>
			<div class="row" style="height:198px;">
				<div class="left">Mensagem:</div>
				<div class="right">
					<textarea id="actor_message" name="vetor[_actor_message]" class="field" rows="12" cols="50" style="height:200px;"><?= isset ($vetor ['_actor_message']) ? $vetor ['_actor_message'] : '' ?></textarea>
				</div>
			</div>
			<div class="row" style="height:19px;">
				<div class="left">&nbsp;</div>
				<div class="right" style="magin:0;">
					<?php htmlspecialchars(dsp_crypt(0,1)); ?>
				</div>
			</div>
			<div class="row" style="height:19px; margin-top:20px">
				<div class="left">Texto acima:</div>
				<div class="right">					
					<input type="text" id="actor_spam" name="actor_spam" class="miniField" value="<?= isset ($vetor ['_actor_spam']) ? $vetor ['_actor_spam'] : '' ?>" />
				</div>
			</div>
			<div class="row">
				<div class="right"><input type="submit" class="botao" name="submit" value="Enviar" style="color:#006699;" /></div>
			</div>
			</form>
		</div>
	</div>
	</br>
	<!--##################################### Informações de Contatos ####################################################################-->
	<div>
		<h4>Contatos:</h4>
		<ul class="contato">
			<li>Secretaria Administrativa: +55(67)3345-7455 (facom@facom.ufms.br) </li>
			<li>Secretaria dos Cursos de Graduação: +55(67)3345-7910 (academica@facom.ufms.br)</li>
			<li>Secretaria dos Cursos de Pós-Graduação: +55(67)3345-7910 Fax:+55(67)3345-7897 (academica@facom.ufms.br)</li>
			<li>Equipe de Suporte da FACOM: +55(67)3345-7899 (suporte@facom.ufms.br)</li>

		</ul>

	</div>
</div>
