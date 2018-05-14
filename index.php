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
    printHeader("home");
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
    </div><div id="main">
	
	  <h3>Nebraska Public Documents is a collaborative effort between 
	  
	  the Nebraska Library Commission,
	  the Nebraska State Historical Society,
	  the University of Nebraska-Lincoln,
	  and the University of Nebraska-Omaha.</h3>
	  <img src="images/nebraska-image.gif" width="300" height="160" alt="firefox-gray"  class="float-right" />
      
        <p>Welcome to <em>Nebraska</em><em> Public Documents!</em> This project provides  free public access to digitized historic annual reports of state agencies in Nebraska for the use of  students, &nbsp;scholars, and the general  public.&nbsp; Through this digitization  project, we provide keyword searching options never before available.&nbsp; Eventually, the intent of the project is to  provide access to state government agency reports from 1891 through 1956, with  metadata enhancements as funds become available.&nbsp; Earlier reports will be provided as they are  located and digitized. This site is made possible through the funding and  support of the Nebraska Library Commission, the Nebraska State Historical  Society, the Nebraska State Records Board, the University  of Nebraska at Omaha,  and the Center for Digital Research in the Humanities at the University of Nebraska-Lincoln.</p>
        <br />
    </div>
    
    <!-- content-wrap ends here -->
  </div>
</div>

<?php require_once("footer.php"); ?>

</body>
</html>
