<?php                                                                              
    require_once("config/config.php");                                             
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Nebraska Public Documents</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="style/main.css" type="text/css" />
</head>
<body>

<?php
    require_once("header.php");
    printHeader("about");
?>

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
	<h1>About</h1>
	Nebraska Public Documents is a collaborative effort between 
	  
	  the Nebraska Library Commission,
	  the Nebraska State Historical Society,
	  the University of Nebraska-Lincoln,
	  and the University of Nebraska-Omaha.
	  
	  <h2>Sponsors</h2>
	  <p>Nebraska Library Commission<br />
	  Nebraska State Records Board<br />
	  University of Nebraska-Lincoln<br />
	  University of Nebraska-Omaha</p>
	  <h2>Description</h2>
	  <p><em>Nebraska</em><em> Public Documents is </em>a publication  comparable to the federal U.S. Serial Set but for the State of Nebraska.&nbsp; Until now, the publication was not widely  available, often in fragile condition, and not indexed.&nbsp; Digitization of these documents was first  proposed by James Shaw, government documents librarian at the University of Nebraska  at Omaha.&nbsp; Based on Jim&rsquo;s original idea, the following  institutions wholeheartedly jumped on board:&nbsp;  the Center for Digital Research in the Humanities at the University of  Nebraska-Lincoln, the Nebraska Library Commission, and the Nebraska State  Historical Society.&nbsp; All of these  partners have contributed funding and staff time to the project.&nbsp;&nbsp; </p>
        <p>In the first phase of the project, Nebraska  documents in the collections at the New York Public Library, microfilmed in the  1990s with funds from the National Endowment for the Humanities, have been  digitized through a University of Nebraska-Lincoln contract with the OCLC Preservation  Service Center  in Bethlehem, Pennsylvania.&nbsp; Using raw data supplied by OCLC, a template  for enhancements and search applications was created by the Center for Digital  Research in the Humanities at the University of Nebraska-Lincoln.</p>
        <p>In the future, the project partners anticipate that reports  missing from the microfilm will be digitized using paper copies found in the  collections at the Nebraska Library Commission, the Nebraska State Historical  Society, and the University of Nebraska at Omaha.&nbsp; Users will notice that digitized reports  prior to 1891 are very scattered, and so we encourage you to use this site as a  means of winnowing data.&nbsp; </p>
        <h2>Project Team </h2>
		
		<p>Beth Goble, <em>Nebraska Library Commission</em><br />
		Lori Sailors, <em>Nebraska Library Commission</em><br />
		Jennifer Wrampe, <em>Nebraska Library Commission</em><br />
		Evelyn Kubert, <em>Nebraska Library Commission</em><br />
		Shannon White, <em>Nebraska Library Commission</em><br />
		Andrea Faling, <em>Nebraska State Historical Society</em><br />
		Cindy Drake, <em>Nebraska State Historical Society</em><br />
		James Shaw, University of Nebraska&#8211;Omaha<br />
		Katherine Walter, <em>University of Nebraska&#8211;Lincoln </em><br /> 
		Laura Weakly, <em>University of Nebraska&#8211;Lincoln </em><br />
		Brian Pytlik Zillig, <em>University of Nebraska&#8211;Lincoln </em><br /> 
		Charles D. Bernholz, <em>University of Nebraska&#8211;Lincoln </em><br /> 
	  Zach Bajaber, <em>University of Nebraska&#8211;Lincoln </em></p>
		<h2>Student Assistants</h2>
		<p>Paul Fajman<br />
		  Katie Heupel<br />
		  Adam Kiser</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p style="font-size:10px">Style adapted from a design by <a href="http://www.styleshout.com/">styleshout</a>.<br />
		  
		  
	      <br />
      </p>
    </div>

    <!-- content-wrap ends here -->
  </div>
</div>

<?php require_once("footer.php") ?>

</body>
</html>
