<?php
function printHeader($hlField='') {
    print("<!-- header starts here -->");
    print("<div id='header'>");
    print("<div id='header-content'>");
    print("<a href='index.php'><h1 id='logo'>Nebraska Public Documents</h1></a>");
    print("<br />");
    print("<ul>");
    print("<li><a href='" . BASE_HREF . "index.php' " . ($hlField == "home" ? "id=current" : "") . " >Home</a></li>");
    print("<li><a href='" . BASE_HREF . "browse.php' " . ($hlField == "browse" ? "id=current" : "") . " >Browse</a></li>");
    print("<li><a href='" . BASE_HREF . "search.php' " . ($hlField == "search" ? "id=current" : "") . " >Search</a></li>");
    print("<li><a href='" . BASE_HREF . "examples.php' " . ($hlField == "examples" ? "id=current" : "") . " >Examples</a></li>");
    print("<li><a href='" . BASE_HREF . "about.php' " . ($hlField == "about" ? "id=current" : "") . " >About</a></li>");
    print("</ul>");
    print("</div>");
    print("</div>");
}
?>
