// JavaScript Document
function sha1 (formId)
{
	var form = document.getElementById (formId);
	
	form.password.value = hex_sha1(form.passwdDraft.value);
	
	form.passwdDraft.value = '';
	
	form.submit ();
}

start = function() 
{
	startList;
	twitter();
}

function twitter ()
{
	new Ajax.Updater ('timeline', 'twitter.php', { method: 'get' });
}

startList = function() 
{
	if (document.all && document.getElementById) 
	{
		navRoot = $("nav");
		
		formatMenu( navRoot );
	}
	
	// Nó com lista de Professores ou Fucionários
	raiz = $("usersList");	
	// Nó com a lista de Alunos
	alunosAS = $("stdtabAS");
	alunosCC = $("stdtabCC");
	alunosMSC = $("stdtabMSC");
	
	if ((raiz != null) && raiz.childNodes.length > 1)
		hotSite (raiz);
	
	if ((alunosAS != null) && (alunosAS.childNodes.length > 3))
		hotSite (alunosAS);
		
	if ((alunosCC != null) && (alunosCC.childNodes.length > 3))
		hotSite (alunosCC);

	if ((alunosMSC != null) && (alunosMSC.childNodes.length > 3))
		hotSite (alunosMST);
}

function formatMenu( nodeRoot )
{
	for (i=0; i<nodeRoot.childNodes.length; i++) 
	{
		node = nodeRoot.childNodes[i];
		
		if ( node.nodeName=="LI" ) 
		{
			addOverClass( node, "over" );
		}
	}
}

function hotSite()
{
	var root = $("mainTab");

	for(var i =0; i< (root.childNodes.length-3)/4; i++)
	{
		addOverClass($("divUser6"), "overDiv");	
	}
}

/* arruma bug do IE que não possui a pseudo-classe hover*/
function addOverClass( node, clazz )
{
	node.onmouseover=function() 
	{
		this.className += " "+ clazz;
	}
	node.onmouseout=function() 
	{
		this.className = this.className.replace(" "+ clazz, "");
	}	
}



function viewTab( id )
{
	var divs = $("tabAS", "tabCC", "tabMSC");
	
	for ( var i = 0; i < divs.length; i++ )
	{
		divs[i].className = "unselected";
	
		$( "std"+ divs[i].id ).style.display = "none";
		if(document.all)
		{
			divs[i].onmouseover=function() 
				{
					this.className += " over";
				};
			
			divs[i].onmouseout=function() 
				{
					this.className = this.className.replace(" over", "");
				}
		}
	}
	
	$( id ).className = "selected";
	$( "std"+id ).style.display = "";
}

function showUser( idUser )
{
	if( $( idUser ).style.display == "none")
		$( idUser ).style.display = "";
	else
		$( idUser ).style.display = "none";
}

function hotSite(root)
{
	var qtdChildNodes = (root.childNodes.length - 1)/4;
	
	for (i = 1; i <= qtdChildNodes; i++)
		addOverClass ($("user" + i), "bugIE6");
}

function novaJanela( url )
{
	window.open(url, 'novajanela', 'toolbar=yes,location=yes,directories=yes,status=yes,scrollbars=yes,menubar=yes,resizable=yes' );
}



window.onload = start;
