<?xml version="1.0" encoding="UTF-8" standalone="yes"?>

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns="http://www.w3.org/1999/xhtml" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:mets="http://www.loc.gov/METS/"
    xmlns:xlink="http://www.w3.org/TR/xlink" version="1.0" xmlns:MODS="http://www.loc.gov/mods/v3"
    exclude-result-prefixes="mets xsi dc xlink MODS">

    <xsl:output encoding="UTF-8" indent="yes" method="xml" standalone="yes" version="1.0"/>

    <xsl:template match="/">
        <TEI.2>

            <teiHeader>
                <fileDesc>
                    <titleStmt>
                        <title>Nebraska Public Documents Project</title>
                        <author/>
                    </titleStmt>
                    <publicationStmt>
                        <publisher>University of Nebraska Center for Digital Research in the
                            Humanities</publisher>
                        <pubPlace>Lincoln, NE</pubPlace>
                        <idno>
                            <xsl:value-of select="//MODS:identifier"/>
                        </idno>
                        <availability>
                            <p>
                                <xsl:text> </xsl:text>
                            </p>
                        </availability>
                        <date>2007</date>
                    </publicationStmt>
                    <sourceDesc>
                        <bibl>
                            <title>
                                <xsl:text> </xsl:text>
                            </title>
                            <date value="">
                                <xsl:text> </xsl:text>
                            </date>
                        </bibl>
                    </sourceDesc>
                </fileDesc>
                <revisionDesc>
                    <change>
                        <date>2006-11-28-05:00</date>
                        <respStmt>
                            <name>OCLC Online Computer Library Center Inc.</name>
                        </respStmt>
                        <item>Initial Creation</item>
                    </change>
                </revisionDesc>
            </teiHeader>

            <xsl:for-each select="descendant::mets:fileGrp[@ID='ALTOGRP']">

                <xsl:for-each select="descendant::mets:FLocat">teru <xsl:variable name="imageNumber">
                        <xsl:value-of select="format-number(position(),'000')"/>
                    </xsl:variable>
                    <xsl:variable name="file">
                        <xsl:value-of select="substring-after(@xlink:href,'file://')"/>
                    </xsl:variable>
                    <seg>
                        <xsl:attribute name="id">
                            <xsl:text>p</xsl:text>
                            <xsl:value-of select="$imageNumber"/>
                        </xsl:attribute>
                        <xsl:for-each select="document($file)">
                            <xsl:for-each select="descendant::*/attribute::CONTENT">
                                <xsl:value-of select="."/>
                                <xsl:text> </xsl:text>
                            </xsl:for-each>
                        </xsl:for-each>
                    </seg>
                </xsl:for-each>
            </xsl:for-each>
        </TEI.2>
    </xsl:template>

    <xsl:template match="mets:mets">
        <xsl:apply-templates select="mets:structMap"/>
        <xsl:apply-templates select="mets:metsHdr"/>
    </xsl:template>
</xsl:stylesheet>
