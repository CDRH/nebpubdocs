<?php
require_once("config/config.php");

$searchField = $_GET['fulltext'];

if( isset( $_GET['doc_id'] ) && $_GET['doc_id'] != '' ) {
    $id = $_GET['doc_id'];
}

if( isset( $_GET['startIndex'] ) ) {
    $start = $_GET['startIndex'];
} else {
    $start = 0;
}
if( isset( $_GET['pageLength'] ) ) {
    $rows = $_GET['pageLength'];
} else {
    $rows = 300;
}

if( isset($id) ) {
    $searchField = strtolower( $searchField );

    $xsl_file = "style/npd.searchResultsPage.xsl";

    $xml = new DOMDocument();
    $xml->loadXML(getSearchResults($searchField, $id, $start, $rows));
    $xsl = new DOMDocument();
    $xsl->load($xsl_file);

    $proc = new XSLTProcessor();
    $proc->importStylesheet($xsl);
    $proc->setParameter('', 'sent_id', $id);
    print( $proc->transformToXML( $xml ) );
    die();
}

function getSearchResults( $searchField, $id, $start, $rows ) {

    $searchField = urlencode($searchField);
    if( $searchField == "" || $searchField == "*" ) {
        $searchField = "*:*";
    }

    $id = urlencode($id);

    if( $id == "" ) {
        $id = "*";
    }

    $start = urlencode($start);
    $rows = urlencode($rows);

    $URL = SOLR_HREF . 
        "indent=on&" . 
        "version=2.2&" .
        "echoParams=all&" .
        "q=" . $searchField . "&" .
        "fq=type:Page&" .
        "fq=id:" . $id . "*&" .
        "start=" . $start . "&" .
        "rows=" . $rows . "&" .
        "fl=id,score,*&" .
        "sort=currentPage+asc&" .
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
