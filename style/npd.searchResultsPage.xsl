<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  xmlns:search="http://apache.org/cocoon/search/1.0" version="1.0">

  <xsl:output method="html" encoding="utf-8" indent="yes"/>

  <xsl:include href="config.xsl"/>

  <xsl:param name='sent_id' />

  <xsl:variable name="doc_id">
    <xsl:value-of select="substring(/response/result[@name='response']/doc[1]/str[@name='id'],1,15)"/>
  </xsl:variable>


  <xsl:variable name="xmlFile">
      <xsl:choose>
          <xsl:when test="$doc_id != ''">
              <xsl:text>../xml/</xsl:text>
              <xsl:value-of select="$doc_id"/>
              <xsl:text>-METS.xml</xsl:text>
          </xsl:when>
          <xsl:otherwise>
              <xsl:text>../xml/</xsl:text>
              <xsl:value-of select="$sent_id"/>
              <xsl:text>-METS.xml</xsl:text>
          </xsl:otherwise>
      </xsl:choose>
  </xsl:variable>
  <xsl:variable name="teiDoc" select="document($xmlFile)"/>

  <!-- Page that handles search queries -->
  <xsl:variable name="searchTerm"
    select="/response/lst[@name='responseHeader']/lst[@name='params']/str[@name='q']"/>
  <xsl:variable name="startIndex" select="number(/response/lst[@name='responseHeader']/lst[@name='params']/str[@name='start'])" />
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
  
  <xsl:include href="npd.TEI.xsl"/>

  <xsl:template match="/">
    <html lang="en">
      <head>
        <title>Nebraska Public Documents</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
        <link rel="stylesheet" href="{$siteroot}style/main.css" type="text/css"/>

        <script language="javascript" type="text/javascript" src="{$siteroot}js/page.js">
      </script>

      </head>
      <body onLoad="setup()">


        <!-- header starts here -->
        <div id="header">
          <div id="header-content">
              <a href="{$siteroot}"><h1 id="logo">Nebraska Public Documents</h1></a>
            <br/>
            <ul>
              <li>
                <a href="{$siteroot}index.php">Home</a>
              </li>
              <li>
                <a href="{$siteroot}browse.php">Browse</a>
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
              <h1>
                <xsl:apply-templates select="$teiDoc//teiHeader/fileDesc/sourceDesc//bibl/title"/>
              </h1>
              <h3>
                <xsl:call-template name="extractDate">
                  <xsl:with-param name="date"
                    select="$teiDoc//teiHeader/fileDesc/sourceDesc//bibl/date"/>
                </xsl:call-template>
              </h3>
              <h3><span id="countPages"><xsl:attribute name="title"><xsl:call-template
                      name="idToPage"><xsl:with-param name="pageId"><xsl:value-of
                          select="($teiDoc//seg)[1]/@id"
                    /></xsl:with-param></xsl:call-template></xsl:attribute><xsl:value-of
                    select="count($teiDoc//seg)"/></span> Pages</h3>
              <br/>
              <br/>

              <h3>Search within this document</h3>
              <form action="{$siteroot}searchdoc.php" method="get" class="searchform">
                <input type="text" name="fulltext" value="{$searchTerm}"/>
                <input type="hidden" name="doc_id" value="{$doc_id}"/>
                <input type="hidden" name="sort" value="page_id"/>
                <input type="hidden" name="p" value="{$p}"/>
                <input type="hidden" name="pageLength" value="300"/>
                <input type="submit" value="Search"/>
              </form>

              <xsl:choose>
                  <xsl:when test="$doc_id = ''">
                      <h4>
                          0 pages matching <em><xsl:value-of select="$searchTerm" /></em>
                      </h4>
                  </xsl:when>
                  <xsl:otherwise>
                      <h4>
                          <xsl:value-of select="$numFound"/> pages matching
                          <em><xsl:value-of select="$searchTerm"/></em>
                      </h4>

                      <xsl:for-each select="//doc">
                          <xsl:if test="position() != 1">, </xsl:if>
                          <xsl:variable name="pageN" select="number(./int[@name='currentPage'])" />
                          <a href="{$siteroot}searchdoc.php?fulltext={$searchTerm}&amp;doc_id={$doc_id}&amp;sort=page_id&amp;pageLength=300&amp;p={$pageN}" onclick="goToPage({$pageN}); return false">Page
                              <xsl:value-of select="$pageN"/></a>
                      </xsl:for-each>
                  </xsl:otherwise>
              </xsl:choose>

              <p>&#160;</p>

            </div>
            <div id="main">
              <xsl:apply-templates select="$teiDoc//TEI.2"/>
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
        <xsl:call-template name="lookUpMonth"><xsl:with-param name="numValue" select="$MM"
          /></xsl:call-template>&#160; <xsl:number format="1" value="$DD"/>, <xsl:value-of
          select="$YYYY"/>
      </xsl:when>
      <xsl:when test="($DD != '') and ($MM != '')">
        <xsl:call-template name="lookUpMonth"><xsl:with-param name="numValue" select="$MM"
          /></xsl:call-template>, <xsl:value-of select="$YYYY"/>
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
