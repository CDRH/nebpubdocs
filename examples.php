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
    printHeader("examples");
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
	
	  <h1>Example Searches </h1>
	  
	  <h2>Health</h2>
   <ul><li><a href="<?php print(BASE_HREF); ?>search.php?fulltext=influenza">Influenza</a></li>
	  </ul>
	  
	  <h2>Insurance Reports</h2>
   <ul><li><a href="<?php print(BASE_HREF); ?>search.php?fulltext=fire+insurance+reports">Fire Insurance Reports</a></li>
	  </ul>
	  
	  <h2>Places</h2>
   <ul><li><a href="<?php print(BASE_HREF); ?>search.php?fulltext=&quot;lancaster+county&quot;">Lancaster County</a></li>
	  </ul>
	  
	  <h2>Institutions</h2>
   <ul><li><a href="<?php print(BASE_HREF); ?>search.php?fulltext=&quot;insane+asylums&quot;">Insane Asylums</a></li>
	
	  </ul>
	  <h2>Transportation</h2>
	    <ul>
     <li><a href="<?php print(BASE_HREF); ?>search.php?fulltext=railroads">Railroads</a>
      </ul>
	  <h2>&nbsp;</h2>
    </div>
	  
    <!-- content-wrap ends here -->
  </div>
</div>

<?php require_once("footer.php"); ?>

</body>
</html>
