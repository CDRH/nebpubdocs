<?php require_once("config/config.php"); ?>
<?php

  if( isset( $_GET['fulltext'] ) ) {
    redirectAndSearch( $_GET['fulltext'] );
  }
  if( isset( $_GET['keyword'] ) ) {
    redirectAndSearch( $_GET['keyword'] );
  }

  function redirectAndSearch( $searchField ) {

    if( isset( $_GET['startIndex'] ) ) {
      $start = $_GET['startIndex'];
    } else {
      $start = 0;
    }
    if( isset( $_GET['rows'] ) ) {
      $rows = $_GET['rows'];
    } else {
      $rows = 10;
    }
    if( isset( $_GET['date'] ) ) {
        $date = $_GET['date'];
    } else {
        $date = "";
    }

    $searchField = strtolower( $searchField );
    if( $searchField == "*" ) {
        $searchField = "*:*";
    }

    $xsl_file = "style/npd.searchResultsDocument.xsl";

    $xml = new DOMDocument();
    $xml->loadXML(getSearchResults($searchField, $date, $start, $rows));
    $xsl = new DOMDocument();
    $xsl->load($xsl_file);

    $proc = new XSLTProcessor();
    $proc->importStylesheet($xsl);
    print( $proc->transformToXML( $xml ) );
    die();
  }

  function getSearchResults( $searchField, $date, $start, $rows ) {

    $searchField = urlencode($searchField);

    $start = intval($start);
    if( $start < 0 )
        $start = 0;

    $rows = intval($rows);
    if( $rows < 0 )
        $rows = 10;

    $date = trim($date, "*");
    $date = preg_replace("/[^0-9*]/", "", $date );
    $date = urlencode($date);

    $URL = SOLR_HREF . 
      "indent=on&" . 
      "version=2.2&" .
      "echoParams=all&" .
      (isset($searchField) && $searchField != '' ? ("q=" . $searchField . "&") : ("q=*:*&")) .
      ((isset($date) && $date) != '' ? ("fq=date:*" . $date . "*&") : '') .
      "fq=type:Document&" .
      "start=" . $start . "&" .
      "rows=" . $rows . "&" .
      "fl=id,score,*&" .
      "hl=on&" .
      "hl.fl=text&" .
      "hl.usePhraseHighlighter=true&" .
      "hl.highlightMultiTerm=true&" .
      "hl.simple.pre=%3Cem%20class=%22highlight%22%3E&" .
      "hl.simple.post=%3C/em%3E&" .
      "hl.snippets=4";

    $ch = curl_init();

    curl_setopt( $ch, CURLOPT_URL, $URL );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );

    $results = curl_exec( $ch );

    curl_close( $ch );

    return $results;
  }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Nebraska Public Documents</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="style/main.css" type="text/css" />
</head>
<body>

<?php
    require_once("header.php");
    printHeader("search");
?>

<!-- content-wrap starts here -->
<div id="content-wrap">
  <div id="content">
   
	   <div id="sidebar">
      <h1>Search Documents </h1>
      <form action="<?php print(BASE_HREF); ?>search.php" method="get" class="searchform">
        <p>
          <input name="fulltext" class="textbox" type="text" />
          <input name="search" class="button" value="Search" type="submit" />
        </p>
      </form>
    </div>
	
	
	<div id="main">
	<h1>Search</h1>
	  
 <form action="<?php print(BASE_HREF); ?>search.php" method="get">
      
          <label>Enter key words here:</label>
          <input name="fulltext" type="text" size="55" />
   
		         <label>Enter year here:</label>
          <input name="date" type="text" size="5" /><input name="submit" type="submit" value="Search" style="margin-left:22em" />
	  </form>
       <!-- <a href="searchresults.php">See Sample Search Results</a><br />
		<a href="display.php">See Sample Document Display</a><br /> --><h3>Search Instructions</h3>
        
		
		<p> <strong>Results ranking</strong><br />
Results are ranked using relevancy ranking. The more times a search term appears in the document, the more relevant the document may be. </p>
		<p><strong>Basic search</strong> <br />
		  Simply enter the word you wish to find and the search engine will  search for every instance of the word on the <em>Nebraska Public Documents</em> website. For  example: nebraska. All instances of the use of the word nebraska will  show up on the results page. </p>
		<p> <strong>Wildcard search</strong> <br />
		  Using a wildcard (*) will increase the odds of finding the results  you are seeking. For example: nebrask* will display every instance of  nebraska, nebraskan, etc. </p>
		<p> <strong>Capitalization</strong> <br />
	  Searches are not case sensitive. For example: governor will come up with the same results as Governor or GOVERNOR. </p>
		<p> <strong>Phrase search</strong> <br />
		  Searching for a specific phrase may help narrow the results.  Use quotation marks to search for an exact phrase. &quot;mental health &quot; in quote marks will return only those results with both words  in the proper order.</p>
		<p> <strong>Boolean operators</strong> <br />
	  The Boolean operators AND, OR, and NOT may help narrow or increase  your search results. For example: Mental AND Health will result  in all items with the words mental and health; Mental OR  Health will return all the results with either the word mental or  the word health; Mental NOT Health will call up all the results  that mention mental but not health.
      
          <br />
    </p>
	</div>
 
    <!-- content-wrap ends here -->
  </div>
</div>

<?php require_once("footer.php"); ?>

</body>
</html>
