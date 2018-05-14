<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="2.0">

  <xsl:output method="xml" encoding="UTF-8" indent="yes"/>

  <xsl:variable name="writeLocation">../xml/solr/</xsl:variable>

  <xsl:variable name="parentTitle" select="/TEI.2/teiHeader/fileDesc/sourceDesc/bibl/title"/>
  <xsl:variable name="parentID" select="/TEI.2/@id"/>
  <xsl:variable name="date" select="/TEI.2/teiHeader//sourceDesc//date[1]"/>
  <xsl:variable name="totalPages" select="number(substring(/TEI.2/text/body/p/seg[last()]/@id,2))"/>

  <xsl:template match="/">
    <index>
      <xsl:result-document href="{$writeLocation}{$parentID}.xml">
        <add>
          <doc>
            <field name="id">
              <xsl:value-of select="$parentID"/>
            </field>

            <field name="title">
              <xsl:value-of select="$parentTitle"/>
            </field>

            <field name="type">
              <xsl:text>Document</xsl:text>
            </field>

            <field name="date">
              <xsl:value-of select="$date"/>
            </field>

            <field name="totalPages">
              <xsl:value-of select="$totalPages"/>
            </field>

            <field name="text">
              <xsl:value-of select="//text"/>
            </field>
          </doc>
        </add>
      </xsl:result-document>

      <unchunked>
        <xsl:value-of select="$parentID"/>
      </unchunked>
      <xsl:apply-templates select=".//seg"/>
    </index>
  </xsl:template>

  <xsl:template match="seg">
    <xsl:variable name="pageID" select="./@id"/>
    <xsl:variable name="page">
      <xsl:value-of select="number(substring($pageID, 2))"/>
    </xsl:variable>


    <xsl:result-document href="{$writeLocation}{$parentID}.{$pageID}.xml">
      <add>
        <doc>
          <field name="id">
            <xsl:value-of select="$parentID"/>
            <xsl:text>.</xsl:text>
            <xsl:value-of select="$pageID"/>
          </field>

          <field name="title">
            <xsl:value-of select="$parentTitle"/>
          </field>

          <field name="type">
            <xsl:text>Page</xsl:text>
          </field>

          <field name="date">
            <xsl:value-of select="$date"/>
          </field>

          <field name="totalPages">
            <xsl:value-of select="$totalPages"/>
          </field>

          <field name="currentPage">
            <xsl:value-of select="$page"/>
          </field>

          <field name="text">
            <xsl:value-of select="./text()"/>
          </field>
        </doc>
      </add>
    </xsl:result-document>

    <chunked>
      <xsl:value-of select="$parentID"/>
      <xsl:text>.</xsl:text>
      <xsl:value-of select="$pageID"/>
    </chunked>

  </xsl:template>
</xsl:stylesheet>
