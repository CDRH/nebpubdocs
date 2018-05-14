<?php
  require_once("../config/config.php");

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
        $date = "*";
    }

    $searchField = strtolower( $searchField );

    $xsl_file = "../style/npd.searchResultsDocument.xsl";

    //print( getSearchResults($searchField, $date, $start, $rows) );
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
    $start = urlencode($start);
    $rows = urlencode($rows);
    $date = urlencode($date);

    $URL = SOLR_HREF . 
      "indent=on&" . 
      "version=2.2&" .
      "echoParams=all&" .
      (isset($searchField) && $searchField != '' ? ("q=" . $searchField . "&") : ("q=*:*&")) .
      (isset($date) ? ("fq=date:*" . $date . "*&") : '') .
      "fq=type:Document&" .
      "start=" . $start . "&" .
      "rows=" . $rows . "&" .
      "fl=id,score,*&" .
      "qt=standard&" .
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

<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns:ino="http://namespaces.softwareag.com/tamino/response2" xmlns:xql="http://metalab.unc.edu/xql/">
<head><title>Journals of the Lewis and Clark Expedition Online&nbsp;
&nbsp;
</title>

<meta name="generator" content="NoteTab Light 4.91"/>
<meta name="author" content=""/>
<meta name="description" content="The Journals of the Lewis and Clark Expedition Online makes available the text of the celebrated Nebraska edition of the Lewis and Clark journals, edited by Gary E. Moulton. Moulton's edition, the most accurate and inclusive edition ever published, is one of the major scholarly achievements of the late twentieth century. This website will eventually feature the full text of the Journals: almost five thousand pages including the entire journals of Lewis, Clark, Floyd, Gass, Ordway, and Whitehouse. Also included is a gallery of images as well as audio files of acclaimed poet William Kloefkorn reading selected passages. With a focus on full text searchability and ease of navigation, the Journals of the Lewis and Clark Expedition Online is intended to be both a useful tool for scholars and an engaging website for the general public." />
  <meta name="keywords" content="journals of the Lewis and Clark expedition, Lewis, Clark, Meriwether Lewis, William Clark, journals, Lewis and Clark expedition, Gary Moulton, Nebraska edition, " />
<style>
h1, h2, h3 {FONT-FAMILY: "Arial", "Arial Unicode MS", "sans-serif"}
a {text-decoration: none;}
a:link {color: #003366; FONT-FAMILY: "Arial", "Arial Unicode MS", "sans-serif"}
a:visited {color: #003366; FONT-FAMILY: "Arial", "Arial Unicode MS", "sans-serif"}
a:hover {color: #999999; FONT-FAMILY: "Arial", "Arial Unicode MS", "sans-serif"}
body {margin-top: 0.0em; margin-bottom: 0.0em; FONT-FAMILY: "Arial", "Arial Unicode MS", "sans-serif" font-size: 12px; text-align: justify;}
p {margin-top: 0.0em; margin-bottom: 0.0em; text-align: left; FONT-FAMILY: "Arial", "Arial Unicode MS", "sans-serif"}
td {text-align: left; FONT-FAMILY: "Arial", "Arial Unicode MS", "sans-serif"; }
td#menu {text-align: justify; FONT-FAMILY: "Arial", "Arial Unicode MS", "sans-serif"; vertical-align: top;}
td#breadcrumbs {text-align: left; FONT-FAMILY: "Arial", "Arial Unicode MS", "sans-serif"; vertical-align: top;}
hr {color: 9da58e; margin-top: 1em; margin-bottom: 1em; margin-left: 1px;}
hr#milestone {height: 1px; color: black; width: 250px;}
table#data td {letter-spacing: 0px; padding: 0.2em; line-height: 4.4;}
.verticaltextDescending { writing-mode: tb-rl; filter: flipv fliph; }
.verticaltextAscending { writing-mode: tb-rl; filter: flipv flipv; }
img { vertical-align: text-bottom; margin: 0px; padding: 0px; }
</style>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
</head>

<BODY leftmargin="0" topmargin="0" marginheight="0" marginwidth="0" bgcolor="#FFFFFF" text="#000000" link="#003366" vlink="#003366" alink="#999999" background="http://lewisandclarkjournals.unl.edu/images/navbg.gif"><div id="DMBRI" style="position: absolute; visibility: hidden;">
<img src="http://lewisandclarkjournals.unl.edu/images/dmb_i.gif" name="DMBImgFiles" />
<img src="http://lewisandclarkjournals.unl.edu/menus/dmb_m.gif" name="DMBJSCode" />
</div>
<script language="JavaScript" type="text/javascript">
  var rimPath = null;
  var rjsPath = null;
  var rPath2Root = null;
  function InitRelCode() {
    var iImg;
    var jImg;
    var tObj;
    if(!document.layers) {
      iImg = document.images['DMBImgFiles'];
      jImg = document.images['DMBJSCode'];
      tObj = jImg;
    } else {
      tObj = document.layers['DMBRI'];
      if(tObj) {
        iImg = tObj.document.images['DMBImgFiles'];
        jImg = tObj.document.images['DMBJSCode'];
      }
    }
    if(!tObj) {
      window.setTimeout("InitRelCode()", 1500);
      return false;
    }
    rimPath = _gp(iImg.src);
    rjsPath = _gp(jImg.src);
    rPath2Root = rjsPath + "../";
    return true;
  }
  function _purl(u) {
    return xrep(xrep(u, "%%REP%%", rPath2Root), "\\", "/");
  }
  function _fip(img) {
    if(img.src.indexOf("%%REL%%")!=-1)
      img.src = rimPath + img.src.split("%%REL%%")[1];
    return img.src;
  }
  function _gp(p) {
    return p.substr(0,p.lastIndexOf("/")+1);
  }
  function FixImages() {
    var h = null;
    if(typeof(hStyle)!="undefined") h = hStyle;
    if(typeof(hS)!="undefined") h = hS;
    if(h)
      for(var i=0; i<h.length; i++)
        h[i] = xrep(h[i], "%%REL%%", rimPath);
  }
  function xrep(s, f, n) {
    return s.split(f).join(n);
  }
  InitRelCode();

</script><script language="JavaScript" type="text/javascript">
function LoadMenus() {if(!rjsPath){window.setTimeout("LoadMenus()", 10);return false;}document.write('<' + 'script language="JavaScript" type="text/javascript" src="' + rjsPath + 'menu.js"><\/script>');}LoadMenus();</script>
<!-- DHTML Menu Builder Loader Code END --><table align="left" valign="top" border="0" cellspacing="0" cellpadding="0"><tr align="left" valign="top"><td id="menu" width="190" rowspan="2"><img src="http://lewisandclarkjournals.unl.edu/images/leftnavtop.jpg" /><br /><br /><br /><br /><br /><br />


<form method="get" name="myquery" action="http://lewisandclarkjournals.unl.edu/search.php">
<table border="0">
<tr>
<td>
<input type="text" name="keyword" value=""><input type="submit" value="Go">
</td>
</tr>
</table>
</form>



<img src="http://lewisandclarkjournals.unl.edu/images/leftnavbottom.jpg" /></td><td rowspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td align="left" valign="top" width="550"><table cellpadding="0" cellspacing="0"><tr><td id="breadcrumbs"><font face="Arial, Helvetica, Sans Serif" size="-1" style="text-align: left;"><p style="padding-top: 0.25cm"></p></font></td></tr></table><p></p><br /><br /><br /><font face="Arial, Helvetica, Sans Serif" size="-1">

<h3>Search</h3>



<?
//$searchField = $_REQUEST["searchField"];
if (empty($_REQUEST['searchField'])){
   print <<<HERE
   <form>
   Enter a search term:
   <input type = "text"
           name = "searchField"><br>
   <input type = "submit">
   </form>
HERE;
} else {
   print 
"<a href=\"http://libxml1a.unl.edu:8080/solr_lewisandclark/select?indent=on&version=2.2&q=";
   print $searchField;
   print "&start=0&rows=10&fl=id,score,title&qt=standard&wt=xslt&tr=LCsearch_test2.xsl&explainOther=&hl=on&hl.fl=text\">Click Here</a>";
} //end
?>





<br /><br />
<FONT FACE="Arial, Helvetica, Sans Serif" SIZE="+1">

<B>Search Help</B></FONT>
<br /><br />
<p>
<B>Basic search</B><br /><br />
Simply enter the word you wish to find and the search engine will search for every instance of the word in the journals. For example: <b>Fight</b>. All instances of the use of the word <em>fight</em> will show up on the results page.
<br /><br />
<B>Wildcard search</B><br /><br />
Using an asterisk (*) will increase the odds of finding the results you are seeking. For example: Fight*. The search results will display every instance of <em>fight</em>, <em>fights</em>, <em>fighting</em>, etc. More than one wildcard may be used. For example: <b>*ricar*</b>. This search will return most references to the Aricara tribe, including <em>Ricara, Ricares, Aricaris, Ricaries, Ricaree, Ricareis</em>, and <em>Ricarra</em>. Using a question mark (?) instead of an asterisk (*) will allow you to search for a single character. For example, r?n will find all instances of ran and run, but will not find rain or ruin. 

<br /><br />
<B>Capitalization</B><br /><br />
Searches are not case sensitive. For example: <b>george</b> will come up with the same results as <b>George</b>.
<br /><br />
<B>Phrase search</B><br /><br />
Searching for a specific phrase may help narrow down the results. Rather long phrases are no problem. For example: <b>"This white pudding we all esteem"</b>.
<br /><br />
<B>Subsequent searches</B><br /><br />
Because of the creative spellings used by the journalists, it may be necessary to try your search multiple times. For example: <strong>P?ro*</strong>. This search brings up numerous variant spellings of the French word <em>pirogue</em>, "a large dugout canoe or open boat." Searching for <strong>P?*r*og?*</strong> will bring up other variant spellings. Searching for <strong>canoe</strong> or <strong>boat</strong> also may be helpful.

<!--Because of the creative spellings used by the journalists, it may be necessary to try your search multiple times. For example: <b>P*ro*</b>. This search brings up numerous variant spellings of the French word <i>pirogue</i>, "a large dugout canoe or open boat." Searching for <b>P*r*gue</b> will bring up other variant spellings.  Searching for <b>canoe</b> or <b>boat</b> also may be helpful.-->
</p>


</font></td></tr><tr width="550"><td><br /><br /><br /><p></p><br /><font face="Arial, Helvetica, Sans Serif" size="-2" color="#003366"><p><FONT FACE="Arial, Helvetica, Sans Serif" SIZE="-2" COLOR="#003366"><p>
<A HREF="http://lewisandclarkjournals.unl.edu/index.html" style="text-decoration: none;">Home</A> &#160;|&#160;
<A HREF="http://lewisandclarkjournals.unl.edu/search.php" style="text-decoration: none;">Search</A> &#160;|&#160;
<A HREF="http://lewisandclarkjournals.unl.edu/php/xslt.php?&amp;_xmlsrc=http://lewisandclarkjournals.unl.edu/files/xml/lc.toc.xml&amp;_xslsrc=http://lewisandclarkjournals.unl.edu/LCstyles.xsl" style="text-decoration: none;">Read the Journals</A> &#160;|&#160;
<A HREF="http://lewisandclarkjournals.unl.edu/php/xslt.php?&amp;_xmlsrc=http://lewisandclarkjournals.unl.edu/files/xml/lc.texts.xml&amp;_xslsrc=http://lewisandclarkjournals.unl.edu/LCstyles.xsl" style="text-decoration: none;">Additional Texts</A> &#160;|&#160; 

<A HREF="http://lewisandclarkjournals.unl.edu/php/xslt.php?&amp;_xmlsrc=http://lewisandclarkjournals.unl.edu/files/xml/lc.img.corpus.01.xml&amp;_xslsrc=http://lewisandclarkjournals.unl.edu/LCstyles.xsl" style="text-decoration: none;">Images</A> &#160;|&#160; 
<A HREF="http://lewisandclarkjournals.unl.edu/php/xslt.php?&amp;_xmlsrc=http://lewisandclarkjournals.unl.edu/files/xml/lc.img.corpus.02.xml&amp;_xslsrc=http://lewisandclarkjournals.unl.edu/LCstyles.xsl" style="text-decoration: none;">Maps</A> &#160;|&#160; 
<A HREF="http://lewisandclarkjournals.unl.edu/php/xslt.php?&amp;_xmlsrc=http://lewisandclarkjournals.unl.edu/files/xml/lc.multimedia.xml&amp;_xslsrc=http://lewisandclarkjournals.unl.edu/LCstyles.xsl" style="text-decoration: none;">Multimedia</A> <br/>
<A HREF="http://lewisandclarkjournals.unl.edu/php/xslt.php?&amp;_xmlsrc=http://lewisandclarkjournals.unl.edu/files/xml/lc.aboutproject.xml&amp;_xslsrc=http://lewisandclarkjournals.unl.edu/LCstyles.xsl" style="text-decoration: none;">About This Project</A>&#160;|&#160; 
<A HREF="http://lewisandclarkjournals.unl.edu/php/xslt.php?&amp;_xmlsrc=http://lewisandclarkjournals.unl.edu/files/xml/lc.faq.xml&amp;_xslsrc=http://lewisandclarkjournals.unl.edu/LCstyles.xsl" style="text-decoration: none;">FAQ</A> &#160;|&#160; 

<A HREF="http://lewisandclarkjournals.unl.edu/php/xslt.php?&amp;_xmlsrc=http://lewisandclarkjournals.unl.edu/files/xml/lc.links.xml&amp;_xslsrc=http://lewisandclarkjournals.unl.edu/LCstyles.xsl" style="text-decoration: none;">Links</A> &#160;|&#160; 
<A HREF="http://www.nebraskapress.unl.edu/Catalog/ProductSearch.aspx?filter=&search=&cid=0&sort=Name&itemsperpage=10&view=List&currentpage=&pf=&sf=&sj=283" target="_blank" style="text-decoration: none;">Print Editions</A> &#160;|&#160; 
<A HREF="http://lewisandclarkjournals.unl.edu/php/xslt.php?&amp;_xmlsrc=http://lewisandclarkjournals.unl.edu/files/xml/lc.privacy.xml&amp;_xslsrc=http://lewisandclarkjournals.unl.edu/LCstyles.xsl" style="text-decoration: none;">Copyright</A> &#160;|&#160;
<A HREF="mailto:jfaust2@unl.edu?subject=Journals of Lewis and Clark Online" style="text-decoration: none;">Contact Us</A> &#160;|&#160;
<A HREF="http://lewisandclarkjournals.unl.edu/php/xslt.php?&amp;_xmlsrc=http://lewisandclarkjournals.unl.edu/files/xml/lc.toc.xml&amp;_xslsrc=http://lewisandclarkjournals.unl.edu/LCstyles.xsl" style="text-decoration: none;">Site Map</A>

</p><br /></font><table><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>

<script type="text/javascript">
var page_name='_TRGT1';
var invisible = '';
var framed = 'no';
function sE(){return true;}window.onError=sE;var base=document;
if(framed=='yes'){base=top.document;}var rn=Math.random();
var ui='lcjournals';var al='Web-Stat hit counters';
var qry=ui+':1::'+escape(base.referrer)+'::'+screen.width
+'x'+screen.height+'::'+screen.colorDepth+'::'+escape(page_name)
+'::'+invisible+'::'+rn+"::"+escape(base.URL);
document.write('<a href="http://www.web-stat.com/stats.shtml?');
document.write(ui+'" target="new"><img name="ct" border="0" ');
document.write('src="http://server3.web-stat.com/count.pl?');
document.write(qry+'" alt="'+al+'" /><\/a>');
//
</script><noscript>
<a href="http://www.web-stat.com/stats.shtml?lcjournals" target="new">
<img src="http://server3.web-stat.com/count.pl?lcjournals:1::NoJavaScript" alt="web-stat hit counter" border="0" />
</a></noscript>

</BODY></HTML>






