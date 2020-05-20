<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

 <xsl:template match="collection"> 

<xsl:apply-templates select="tabl"/>

</xsl:template>



<xsl:template match="tabl"> 

<table width="100%">

<xsl:for-each select="//tre">

<tr><xsl:value-of select="tre"/>
<td><xsl:value-of select="nomer"/></td>
<td><xsl:value-of select="otkogo"/></td>
<td><xsl:value-of select="komu"/></td>
<td><xsl:value-of select="soobshenie"/></td>
<td><xsl:value-of select="data"/></td>
<td><xsl:value-of select="otmetka"/></td>
</tr>

</xsl:for-each>

</table>

</xsl:template>
















</xsl:stylesheet>


  
 

