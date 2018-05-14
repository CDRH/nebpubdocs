<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="2.0">

    <xsl:param name="p" />
    
    <xsl:variable name="page">
      <xsl:choose>
        <xsl:when test="//seg[@id=$p]"><xsl:value-of select="$p" /></xsl:when>
        <xsl:otherwise><xsl:value-of select="(//seg)[1]/@id" /></xsl:otherwise>
      </xsl:choose>
    </xsl:variable>
    
    <xsl:variable name="reel"><xsl:value-of select="substring(/TEI.2/@id, 5, 5)" /></xsl:variable>
    <xsl:variable name="document"><xsl:value-of select="substring(/TEI.2/@id, 11, 5)" /></xsl:variable>


  <xsl:template match="/">

    <html>
    <head>
      <title>Nebraska Public Documents</title>
      </head>
      <body>
          
          <div class="head">
          <h1><xsl:value-of select="//sourceDesc/bibl/title" />, <xsl:value-of select="//sourceDesc/bibl/date" /></h1>
          </div>
          
          <div class="image">
            <img src="../../web/{$reel}.{$document}/{/TEI.2/@id}.{substring-after($page, 'p')}.jpg" />
          </div>
          
          <div class="pages">
            
            <xsl:for-each select=".//seg">
            <xsl:variable name="thumb">../../thumbs/<xsl:value-of select="$reel"/>.<xsl:value-of select="$document"/>/<xsl:value-of select="/TEI.2/@id"/>.<xsl:value-of select="substring-after(./@id, 'p')" />.jpg</xsl:variable>
              <xsl:if test="position() != 1"><span class="pageSep">, <br/></span></xsl:if>
              <xsl:choose>
              <xsl:when test="./@id=$page">
                <strong class="currentPage"><xsl:value-of select="./@id" /></strong>
              </xsl:when>
              <xsl:otherwise>
              <a href="{./@id}"><img src="{$thumb}"><xsl:attribute name="alt"><xsl:value-of select="./@id" /></xsl:attribute></img></a>
            </xsl:otherwise>
            </xsl:choose>
            </xsl:for-each>
            
            
          </div>
        
      </body>
    </html>
    
  </xsl:template>
</xsl:stylesheet>
