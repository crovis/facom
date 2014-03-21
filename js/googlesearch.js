//<![CDATA[

var searchControl;
var gSearchForm;
var dctSearch;

function OnLoad() {

	// create a tabbed mode search control
	searchControl = new GSearchControl();

	// create a draw options object so that we
	// can position the search form root
	var options = new GdrawOptions();
	options.setSearchFormRoot($("searchForm"));

	// populate with searchers
	dctSearch = new GwebSearch();
	dctSearch.setUserDefinedLabel("FACOM");
	dctSearch.setSiteRestriction("http://www.dct.ufms.br/");
	
	searchControl.addSearcher(dctSearch);
	searchControl.addSearcher(new GwebSearch());
	searchControl.addSearcher(new GvideoSearch());
	searchControl.addSearcher(new GbookSearch());
	searchControl.addSearcher(new GnewsSearch());
	
	// set the default text for an empty result
	searchControl.setNoResultsString("Nenhum resultado!");
	
	// large result set
	searchControl.setResultSetSize(GSearch.LARGE_RESULTSET);
	
	// draw results in tabbed layout mode
	options.setDrawMode(GSearchControl.DRAW_MODE_TABBED);
	searchControl.draw($("searchResults"), options);
	
	gSearchForm = new GSearchForm(false, $("searchForm"));
	gSearchForm.setOnSubmitCallback(null, CaptureForm);
	gSearchForm.input.focus();
	
}

GSearch.setOnLoadCallback(OnLoad);

// Cancel the form submission, executing an AJAX Search API search.
function CaptureForm(searchForm)
{
	// desappear site's main content
	$("#conteudo").style.display = 'none';
	// appear results screm
	$("results").style.display = '';
	// executes google ajax search instead of form post search
	searchControl.execute(searchForm.input.value);
	return false;
}

//]]>
