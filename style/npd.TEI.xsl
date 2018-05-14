<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">

    <xsl:param name="p" />
    

  <xsl:template match="TEI.2">

    <xsl:variable name="reel"><xsl:value-of select="substring(./@id, 5, 5)" /></xsl:variable>
    <xsl:variable name="document"><xsl:value-of select="substring(./@id, 11, 5)" /></xsl:variable>
    
    <xsl:variable name="p2"><xsl:if test="number($p)"><xsl:call-template name="pageToId"><xsl:with-param name="pageNo" select="$p"/></xsl:call-template></xsl:if></xsl:variable>
    
    <xsl:variable name="page">
      <xsl:choose>
        <xsl:when test=".//seg[@id=$p2]"><xsl:value-of select="$p2"/></xsl:when>
        <xsl:otherwise><xsl:value-of select="(.//seg)[1]/@id" /></xsl:otherwise>
      </xsl:choose>
    </xsl:variable>
    
    
    
    
    
    <div class="document_page_numbers">
      <form action="searchdoc" onsubmit="goToForm(); return false" method="get" class="searchform">
      
        <input type="hidden" name="fulltext" value="{$searchTerm}"/>
        <input type="hidden" name="doc_id" value="{$doc_id}" />
        <input type="hidden" name="sort" value="page_id" />
        <input type="hidden" name="pageLength" value="300" />
        Page <input id="pageIdBox" name="p" type="text" size="3">
          <xsl:attribute name="value"><xsl:call-template name="idToPage"><xsl:with-param name="pageId" select="$page"/></xsl:call-template></xsl:attribute>
        </input> 
        | <input type="submit" value="Go"></input>
      </form>
      
      </div>
    
    <div class="document_navigation">
    
      <xsl:variable name="currentPage" select="number(substring($page,2))" /><!--<xsl:value-of select=".//seg[@id=$page]" /></xsl:variable>-->
      
      <span id="previousLink">        
      <xsl:if test=".//seg[$currentPage -1]">
        <xsl:variable name="prevPno"><xsl:call-template name="idToPage"><xsl:with-param name="pageId" select="(.//seg[$currentPage -1])[1]/@id"/></xsl:call-template></xsl:variable>
        <a href="{$siteroot}searchdoc.php?fulltext={$searchTerm}&amp;doc_id={$doc_id}&amp;sort=page_id&amp;pageLength=300&amp;p={$prevPno}" onclick="previousPage(); return false">
          Prev</a>
      </xsl:if></span>
               | 
      <span id="nextLink">
        <xsl:if test=".//seg[$currentPage +1]">
          <xsl:variable name="nexPno"><xsl:call-template name="idToPage"><xsl:with-param name="pageId" select="(.//seg[$currentPage +1])[1]/@id"/></xsl:call-template></xsl:variable>
                <a href="{$siteroot}searchdoc.php?fulltext={$searchTerm}&amp;doc_id={$doc_id}&amp;sort=page_id&amp;pageLength=300&amp;p={$nexPno}" onclick="nextPage(); return false">
                  Next</a>
              </xsl:if>
    </span>
    </div>
    
    <br /><br />
    
    <img id="mainImage" alt="Page Image" src="{$imageroot}web/{$reel}.{$document}/{./@id}.{substring-after($page, 'p')}.jpg" />
    
          

  </xsl:template>

  <xsl:template name="pageToId">
    <xsl:param name="pageNo"></xsl:param>
    <xsl:value-of select="'p'"/><xsl:number value="$pageNo" format="001" />
  </xsl:template>
  
  <xsl:template name="idToPage">
    <xsl:param name="pageId"></xsl:param>
    <xsl:number value="substring-after($pageId, 'p')" format="1" />
  </xsl:template>
  

</xsl:stylesheet>

