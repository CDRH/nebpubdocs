<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  xmlns:search="http://apache.org/cocoon/search/1.0" version="1.0">

  <xsl:output method="html" encoding="utf-8" indent="yes"/>

  <xsl:include href="config.xsl"/>

  <!-- Page that handles search queries -->
  <xsl:variable name="searchTerm"
    select="/response/lst[@name='responseHeader']/lst[@name='params']/str[@name='q']"/>
  <xsl:variable name="filterTerm">
    <xsl:for-each select="/response/lst[@name='responseHeader']/lst[@name='params']/arr[@name='fq']/str">
      <xsl:if test="not(contains(.,'type:'))">
        <xsl:value-of select="substring-before(.,':')"/>
        <xsl:text>=</xsl:text>
        <xsl:value-of select="substring-after(.,':')"/>
      </xsl:if>
    </xsl:for-each>
  </xsl:variable>
  <xsl:variable name="startIndex"
    select="number(/response/lst[@name='responseHeader']/lst[@name='params']/str[@name='start'])"/>
  <xsl:variable name="rows">
    <xsl:value-of
      select="number(/response/lst[@name='responseHeader']/lst[@name='params']/str[@name='rows'])"/>
  </xsl:variable>
  <xsl:variable name="numFound">
    <xsl:value-of select="number(/response/result/@numFound)"/>
  </xsl:variable>
  <xsl:variable name="endIndex">
    <xsl:choose>
      <xsl:when test="$startIndex + $rows &lt; $numFound - 1">
        <xsl:value-of select="$startIndex + $rows"/>
      </xsl:when>
      <xsl:otherwise>
        <xsl:value-of select="$numFound - 1"/>
      </xsl:otherwise>
    </xsl:choose>
  </xsl:variable>

  <xsl:variable name="pageNavigation">

    <div class="document_navigation">
      <xsl:choose>
        <xsl:when test="not($startIndex = 0)">
          <xsl:variable name="prevIndex">
            <xsl:choose>
              <xsl:when test="$startIndex - $rows &lt; 0">
                <xsl:text>0</xsl:text>
              </xsl:when>
              <xsl:when test="$startIndex - $rows &gt;= $numFound">
                <xsl:value-of select="$numFound - $rows"/>
              </xsl:when>
              <xsl:otherwise>
                <xsl:value-of select="$startIndex - $rows" />
              </xsl:otherwise>
            </xsl:choose>
          </xsl:variable>
          <a>
            <xsl:attribute name="href">
              <xsl:value-of select="$siteroot"/>
              <xsl:text>search.php?fulltext=</xsl:text>
              <xsl:value-of select="$searchTerm"/>
              <xsl:text>&amp;</xsl:text>
              <xsl:if test="$filterTerm != ''">
                <xsl:value-of select="$filterTerm"/>
                <xsl:text>&amp;</xsl:text>
              </xsl:if>
              <xsl:text>startIndex=</xsl:text>
              <xsl:value-of select="$prevIndex" />
            </xsl:attribute>
            <xsl:text>previous</xsl:text>
          </a>
        </xsl:when>
        <xsl:otherwise>
          <xsl:text>previous</xsl:text>
        </xsl:otherwise>
      </xsl:choose>
      
      <xsl:text> | </xsl:text>
      
      <xsl:choose>
        <xsl:when test="$startIndex + $rows &lt; $numFound">
          <xsl:variable name="nextIndex" select="$endIndex"/>
          <a>
            <xsl:attribute name="href">
              <xsl:value-of select="$siteroot"/>
              <xsl:text>search.php?fulltext=</xsl:text>
              <xsl:value-of select="$searchTerm"/>
              <xsl:text>&amp;</xsl:text>
              <xsl:if test="$filterTerm != ''">
                <xsl:value-of select="$filterTerm"/>
                <xsl:text>&amp;</xsl:text>
              </xsl:if>
              <xsl:text>startIndex=</xsl:text>
              <xsl:value-of select="$nextIndex" />
            </xsl:attribute>
            <xsl:text>next</xsl:text>
          </a>
        </xsl:when>
        <xsl:otherwise>
          <xsl:text>next</xsl:text>
        </xsl:otherwise>
      </xsl:choose>
    </div>
  </xsl:variable>




  <xsl:template match="/">

    <html lang="en">
      <head>
        <title>Nebraska Public Documents</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
        <link rel="stylesheet" href="{$siteroot}style/main.css" type="text/css"/>
      </head>
      <body>
        
        <!-- header starts here -->
        <div id="header">
          <div id="header-content">
              <a herf="${siteroot}"><h1 id="logo">Nebraska Public Documents</h1></a>
            <br/>
            <ul>
              <li>
                <a href="{$siteroot}index.php">Home</a>
              </li>
              <li>
                <a href="{$siteroot}search.php?fulltext=*:*">Browse</a>
              </li>
              <li>
                <a href="{$siteroot}search.php">Search</a>
              </li>
              <li>
                <a href="{$siteroot}examples.php">Examples</a>
              </li>
              <li>
                <a href="{$siteroot}about.php">About</a>
              </li>
            </ul>
          </div>
        </div>
        <!-- content-wrap starts here -->
        <div id="content-wrap">
          <div id="content">

            <div id="sidebar">
              <h1>Search Documents</h1>
              <form action="search.php" method="get" class="searchform">
                <p>
                  <input name="fulltext" class="textbox" type="text" value="{$searchTerm}"/>
                  <input name="search" class="button" value="Search" type="submit"/>
                </p>
              </form>

            </div>

            <div id="main">
              <p>
                <xsl:copy-of select="$pageNavigation"/>
              </p>
              <h1>Search Results</h1>
              <h2><xsl:value-of select="$numFound"/> Matches</h2>
              <h5>Keyword: <xsl:value-of select="$searchTerm"/>
              </h5>
              <br/>

              <h3>
                <xsl:value-of select="$startIndex + 1"/>&#8211;<xsl:value-of
                  select="$startIndex + $rows"/> of <xsl:value-of select="$numFound"/> entries </h3>

              <xsl:for-each select="/response/result[@name='response']/doc">
                <xsl:variable name="id" select="./str[@name='id']/text()"/>

                <div class="searchresults">
                  <div class="search_img">
                    <img
                      src="{$imageroot}thumbs/{substring-after($id, 'npd.')}/{$id}.001.jpg"
                      alt="" width="80" height="125"/>
                  </div>
                  <div class="searchitem">
                    <h2>
                      <a
                        href="{$siteroot}searchdoc.php?fulltext={$searchTerm}&amp;doc_id={$id}&amp;sort=page_id&amp;pageLength=300">
                        <xsl:value-of select="./str[@name='title']"/>
                      </a>
                    </h2>

                    <p><xsl:call-template name="extractDate">
                        <xsl:with-param name="date" select="./str[@name='date']/text()"/>
                      </xsl:call-template><br/>
                      <xsl:value-of select="number(./int[@name='totalPages'])"/> Pages</p>
                  </div>
                </div>

                <br class="clear"/>

              </xsl:for-each>

              <p>
                <xsl:copy-of select="$pageNavigation"/>
              </p>



              <br/>
            </div>

            <!-- content-wrap ends here -->
          </div>
        </div>
        <!-- footer starts here -->
        <div id="footer">
          <div id="footer-content">
            <div class="col float-left space-sep">
              <h2>Site Partners</h2>
              <div class="columns">
                <p align="center">
                  <img src="{$siteroot}images/UNL_logo.gif"
                    alt="University of Nebraska-Lincoln" width="150" height="65"/>
                </p>
                <p align="center">
                  <img src="{$siteroot}images/NSHS_logo.gif"
                    alt="Nebraska State Historical Society" width="100" height="92"/>
                </p>
              </div>
            </div>
            <div class="col float-left">
              <h2>&#160;</h2>
              <div class="columns">
                <p align="center">
                  <img src="{$siteroot}images/UNO_logo.gif"
                    alt="University of Nebraska-Omaha" width="150" height="71"/>
                </p>
                <p align="center">
                  <img src="{$siteroot}images/NLC_logo.gif"
                    alt="Nebraska Library Commission"/>
                </p>
              </div>
            </div>
            <div class="col2 float-right">
              <p> &#169; copyright 2007 <strong>University of Nebraska&#8211;Lincoln </strong><br/>
                Design by: <a href="index.php">styleshout</a> &#160; &#160; Valid <a
                  href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> | <a
                  href="http://validator.w3.org/check/referer">XHTML</a>
              </p>
              <ul>
                <li>
                  <a href="index.php">Home</a>
                </li>

              </ul>
            </div>
            <br class="clear"/>
          </div>
        </div>
        <!-- footer ends here -->
      </body>
    </html>
  </xsl:template>


  <xsl:template name="extractDate">
    <xsl:param name="date"/>
    <!--This template converts a date from format YYYY-MM-DD to mm D, YYYY (MM, MM-DD, optional)-->


    <xsl:variable name="YYYY" select="substring($date,1,4)"/>
    <xsl:variable name="MM" select="substring($date,6,2)"/>
    <xsl:variable name="DD" select="substring($date,9,2)"/>
    <!--
    (Y:"<xsl:value-of select="$YYYY" />" M:"<xsl:value-of select="$MM" />" D:"<xsl:value-of select="$DD" />")
    -->
    <xsl:choose>
      <xsl:when test="($DD != '') and ($MM != '') and ($DD != '')">
        <xsl:call-template name="lookUpMonth">
          <xsl:with-param name="numValue" select="$MM"/>
        </xsl:call-template>&#160; <xsl:number format="1" value="$DD"/>, <xsl:value-of
          select="$YYYY"/>
      </xsl:when>
      <xsl:when test="($DD != '') and ($MM != '')">
        <xsl:call-template name="lookUpMonth">
          <xsl:with-param name="numValue" select="$MM"/>
        </xsl:call-template>, <xsl:value-of select="$YYYY"/>
      </xsl:when>
      <xsl:when test="($YYYY != '')">
        <xsl:value-of select="$YYYY"/>
      </xsl:when>
      <xsl:otherwise> N.D. </xsl:otherwise>
    </xsl:choose>

  </xsl:template>

  <xsl:template name="lookUpMonth">
    <xsl:param name="numValue"/>
    <xsl:choose>
      <xsl:when test="$numValue = '01'">January</xsl:when>
      <xsl:when test="$numValue = '02'">February</xsl:when>
      <xsl:when test="$numValue = '03'">March</xsl:when>
      <xsl:when test="$numValue = '04'">April</xsl:when>
      <xsl:when test="$numValue = '05'">May</xsl:when>
      <xsl:when test="$numValue = '06'">June</xsl:when>
      <xsl:when test="$numValue = '07'">July</xsl:when>
      <xsl:when test="$numValue = '08'">August</xsl:when>
      <xsl:when test="$numValue = '09'">September</xsl:when>
      <xsl:when test="$numValue = '10'">October</xsl:when>
      <xsl:when test="$numValue = '11'">November</xsl:when>
      <xsl:when test="$numValue = '12'">December</xsl:when>
      <xsl:otherwise/>
    </xsl:choose>
  </xsl:template>



</xsl:stylesheet>
