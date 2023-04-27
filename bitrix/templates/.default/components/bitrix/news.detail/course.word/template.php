<?
header( 'Pragma: public' );
header( 'Content-Type: application/msword' );
$the_filename = $arResult['PROPERTIES']['course_code']['VALUE'];
$the_filename = str_replace(" ","_",$the_filename);
header( 'Content-Disposition: attachment; filename="' . $the_filename . '.doc"' );


?>
<html xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:w="urn:schemas-microsoft-com:office:word"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1251">
<meta name=Generator content="Microsoft Word 12 (filtered)">
<title>Карточка курса</title>

<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:Wingdings;
	panose-1:5 0 0 0 0 0 0 0 0 0;}
@font-face
	{font-family:"Cambria Math";
	panose-1:2 4 5 3 5 4 6 3 2 4;}
@font-face
	{font-family:Tahoma;
	panose-1:2 11 6 4 3 5 4 4 2 4;}
@font-face
	{font-family:Chicago;}
@font-face
	{font-family:"Arial Narrow";
	panose-1:2 11 6 6 2 2 2 3 2 4;}
@font-face
	{font-family:Geneva;
	panose-1:0 0 0 0 0 0 0 0 0 0;}
@font-face
	{font-family:HelvCondenced;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:53.85pt;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
h1
	{margin-top:11.0pt;
	margin-right:0cm;
	margin-bottom:3.0pt;
	margin-left:0cm;
	text-indent:0cm;
	line-height:16.0pt;
	page-break-after:avoid;
	font-size:12.0pt;
	font-family:"Arial","sans-serif";
	font-weight:bold;}
h2
	{margin-top:11.0pt;
	margin-right:0cm;
	margin-bottom:3.0pt;
	margin-left:0cm;
	text-indent:0cm;
	line-height:16.0pt;
	page-break-after:avoid;
	font-size:11.0pt;
	font-family:"Arial","sans-serif";
	font-weight:bold;}
h3
	{margin-top:11.0pt;
	margin-right:0cm;
	margin-bottom:3.0pt;
	margin-left:53.85pt;
	text-indent:0cm;
	line-height:16.0pt;
	page-break-after:avoid;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	font-weight:bold;}
h4
	{margin-top:11.0pt;
	margin-right:0cm;
	margin-bottom:3.0pt;
	margin-left:53.85pt;
	text-indent:0cm;
	line-height:16.0pt;
	page-break-after:avoid;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	font-weight:bold;}
h5
	{margin-top:11.0pt;
	margin-right:0cm;
	margin-bottom:3.0pt;
	margin-left:53.85pt;
	text-indent:0cm;
	line-height:16.0pt;
	page-break-after:avoid;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	font-weight:bold;
	font-style:italic;}
h6
	{margin-top:11.0pt;
	margin-right:0cm;
	margin-bottom:3.0pt;
	margin-left:0cm;
	text-indent:0cm;
	line-height:16.0pt;
	page-break-after:avoid;
	border:none;
	padding:0cm;
	font-size:9.0pt;
	font-family:"Arial","sans-serif";
	font-weight:bold;
	font-style:italic;}
p.MsoHeading7, li.MsoHeading7, div.MsoHeading7
	{margin-top:11.0pt;
	margin-right:0cm;
	margin-bottom:3.0pt;
	margin-left:0cm;
	text-indent:0cm;
	line-height:16.0pt;
	page-break-after:avoid;
	border:none;
	padding:0cm;
	font-size:9.0pt;
	font-family:"Arial","sans-serif";
	font-weight:bold;}
p.MsoHeading8, li.MsoHeading8, div.MsoHeading8
	{margin-top:11.0pt;
	margin-right:0cm;
	margin-bottom:3.0pt;
	margin-left:0cm;
	text-indent:0cm;
	line-height:16.0pt;
	page-break-after:avoid;
	border:none;
	padding:0cm;
	font-size:9.0pt;
	font-family:"Arial","sans-serif";
	font-weight:bold;
	font-style:italic;}
p.MsoHeading9, li.MsoHeading9, div.MsoHeading9
	{margin-top:11.0pt;
	margin-right:0cm;
	margin-bottom:3.0pt;
	margin-left:0cm;
	text-indent:0cm;
	line-height:16.0pt;
	page-break-after:avoid;
	border:none;
	padding:0cm;
	font-size:9.0pt;
	font-family:"Arial","sans-serif";
	font-weight:bold;}
p.MsoIndex1, li.MsoIndex1, div.MsoIndex1
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:18.0pt;
	text-indent:-18.0pt;
	line-height:12.0pt;
	font-size:9.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoIndex2, li.MsoIndex2, div.MsoIndex2
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:36.0pt;
	text-indent:-18.0pt;
	font-size:9.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoIndex3, li.MsoIndex3, div.MsoIndex3
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:54.0pt;
	text-indent:-18.0pt;
	font-size:9.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoIndex4, li.MsoIndex4, div.MsoIndex4
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:72.0pt;
	text-indent:-18.0pt;
	font-size:9.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoIndex5, li.MsoIndex5, div.MsoIndex5
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:90.0pt;
	text-indent:-18.0pt;
	font-size:9.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoIndex6, li.MsoIndex6, div.MsoIndex6
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:48.0pt;
	text-indent:-8.0pt;
	line-height:12.0pt;
	font-size:7.5pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoIndex7, li.MsoIndex7, div.MsoIndex7
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:56.0pt;
	text-indent:-8.0pt;
	line-height:12.0pt;
	font-size:7.5pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoIndex8, li.MsoIndex8, div.MsoIndex8
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:64.0pt;
	text-indent:-8.0pt;
	line-height:12.0pt;
	font-size:8.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoIndex9, li.MsoIndex9, div.MsoIndex9
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:144.0pt;
	text-indent:-36.0pt;
	font-size:9.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoToc1, li.MsoToc1, div.MsoToc1
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:0cm;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.2pt;}
p.MsoToc2, li.MsoToc2, div.MsoToc2
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:5.65pt;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoToc3, li.MsoToc3, div.MsoToc3
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:11.35pt;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoToc4, li.MsoToc4, div.MsoToc4
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:17.0pt;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoToc5, li.MsoToc5, div.MsoToc5
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:17.85pt;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoToc6, li.MsoToc6, div.MsoToc6
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:17.85pt;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoToc7, li.MsoToc7, div.MsoToc7
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:17.85pt;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoToc8, li.MsoToc8, div.MsoToc8
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:17.85pt;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoToc9, li.MsoToc9, div.MsoToc9
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:17.85pt;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoNormalIndent, li.MsoNormalIndent, div.MsoNormalIndent
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:72.0pt;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoFootnoteText, li.MsoFootnoteText, div.MsoFootnoteText
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:54.0pt;
	line-height:10.0pt;
	font-size:8.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoCommentText, li.MsoCommentText, div.MsoCommentText
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:0cm;
	margin-left:54.0pt;
	margin-bottom:.0001pt;
	line-height:10.0pt;
	font-size:8.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoHeader, li.MsoHeader, div.MsoHeader
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:53.85pt;
	text-align:right;
	line-height:12.0pt;
	font-size:7.5pt;
	font-family:"Arial","sans-serif";
	font-variant:small-caps;}
p.MsoFooter, li.MsoFooter, div.MsoFooter
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:0cm;
	line-height:9.5pt;
	border:none;
	padding:0cm;
	font-size:7.5pt;
	font-family:"Arial","sans-serif";
	text-transform:uppercase;}
p.MsoIndexHeading, li.MsoIndexHeading, div.MsoIndexHeading
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:0cm;
	line-height:24.0pt;
	page-break-after:avoid;
	font-size:12.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;
	font-weight:bold;}
p.MsoCaption, li.MsoCaption, div.MsoCaption
	{margin-top:3.0pt;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:96.0pt;
	text-indent:-6.0pt;
	line-height:11.0pt;
	page-break-after:avoid;
	font-size:8.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoTof, li.MsoTof, div.MsoTof
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:72.0pt;
	text-indent:-18.0pt;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
span.MsoFootnoteReference
	{vertical-align:super;}
span.MsoCommentReference
	{font-family:"Arial","sans-serif";}
span.MsoPageNumber
	{font-family:"Arial","sans-serif";
	letter-spacing:-.5pt;
	font-weight:bold;}
span.MsoEndnoteReference
	{vertical-align:super;}
p.MsoEndnoteText, li.MsoEndnoteText, div.MsoEndnoteText
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:0cm;
	margin-left:54.0pt;
	margin-bottom:.0001pt;
	line-height:10.0pt;
	font-size:8.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoToa, li.MsoToa, div.MsoToa
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:72.0pt;
	text-indent:-18.0pt;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoMacroText, li.MsoMacroText, div.MsoMacroText
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:54.0pt;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Courier New";
	letter-spacing:-.25pt;}
p.MsoToaHeading, li.MsoToaHeading, div.MsoToaHeading
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:53.85pt;
	line-height:24.0pt;
	page-break-after:avoid;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.5pt;
	font-weight:bold;}
p.MsoList, li.MsoList, div.MsoList
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:72.0pt;
	text-indent:-18.0pt;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoListBullet, li.MsoListBullet, div.MsoListBullet
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:72.0pt;
	text-indent:-18.0pt;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoListNumber, li.MsoListNumber, div.MsoListNumber
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:71.7pt;
	text-indent:-17.85pt;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoList2, li.MsoList2, div.MsoList2
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:90.0pt;
	text-indent:-18.0pt;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoList3, li.MsoList3, div.MsoList3
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:108.0pt;
	text-indent:-18.0pt;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoList4, li.MsoList4, div.MsoList4
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:126.0pt;
	text-indent:-18.0pt;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoList5, li.MsoList5, div.MsoList5
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:144.0pt;
	text-indent:-18.0pt;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoListBullet2, li.MsoListBullet2, div.MsoListBullet2
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:108.0pt;
	text-indent:-18.0pt;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoListBullet3, li.MsoListBullet3, div.MsoListBullet3
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:126.0pt;
	text-indent:-18.0pt;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoListBullet4, li.MsoListBullet4, div.MsoListBullet4
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:144.0pt;
	text-indent:-18.0pt;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoListBullet5, li.MsoListBullet5, div.MsoListBullet5
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:162.0pt;
	text-indent:-18.0pt;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoListNumber2, li.MsoListNumber2, div.MsoListNumber2
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:107.7pt;
	text-indent:-17.85pt;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoListNumber3, li.MsoListNumber3, div.MsoListNumber3
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:125.85pt;
	text-indent:-17.85pt;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoListNumber4, li.MsoListNumber4, div.MsoListNumber4
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:144.0pt;
	text-indent:-17.85pt;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoListNumber5, li.MsoListNumber5, div.MsoListNumber5
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:161.85pt;
	text-indent:-17.85pt;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoTitle, li.MsoTitle, div.MsoTitle
	{margin-top:11.0pt;
	margin-right:0cm;
	margin-bottom:3.0pt;
	margin-left:0cm;
	page-break-after:avoid;
	border:none;
	padding:0cm;
	font-size:20.0pt;
	font-family:"Arial","sans-serif";
	font-weight:bold;}
p.MsoBodyTextIndent, li.MsoBodyTextIndent, div.MsoBodyTextIndent
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:72.0pt;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoListContinue, li.MsoListContinue, div.MsoListContinue
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:72.0pt;
	text-indent:0cm;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoListContinue2, li.MsoListContinue2, div.MsoListContinue2
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:108.0pt;
	text-indent:0cm;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoListContinue3, li.MsoListContinue3, div.MsoListContinue3
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:126.0pt;
	text-indent:0cm;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoListContinue4, li.MsoListContinue4, div.MsoListContinue4
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:144.0pt;
	text-indent:0cm;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoListContinue5, li.MsoListContinue5, div.MsoListContinue5
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:162.0pt;
	text-indent:0cm;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.MsoSubtitle, li.MsoSubtitle, div.MsoSubtitle
	{margin-top:3.0pt;
	margin-right:0cm;
	margin-bottom:6.0pt;
	margin-left:0cm;
	line-height:17.0pt;
	page-break-after:avoid;
	border:none;
	padding:0cm;
	font-size:16.0pt;
	font-family:"Arial","sans-serif";
	text-transform:uppercase;
	letter-spacing:-.8pt;
	font-weight:bold;}
p.MsoDate, li.MsoDate, div.MsoDate
	{margin:0cm;
	margin-bottom:.0001pt;
	font-size:14.0pt;
	font-family:"Arial","sans-serif";}
a:link, span.MsoHyperlink
	{color:blue;
	text-decoration:underline;}
a:visited, span.MsoHyperlinkFollowed
	{color:purple;
	text-decoration:underline;}
em
	{letter-spacing:0pt;}
p.MsoDocumentMap, li.MsoDocumentMap, div.MsoDocumentMap
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:53.85pt;
	line-height:12.0pt;
	background:navy;
	font-size:10.0pt;
	font-family:"Tahoma","sans-serif";
	letter-spacing:-.25pt;}
p
	{margin-right:0cm;
	margin-left:0cm;
	font-size:12.0pt;
	font-family:"Times New Roman","serif";}
p.MsoAcetate, li.MsoAcetate, div.MsoAcetate
	{mso-style-link:"Balloon Text Char";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:0cm;
	margin-left:53.85pt;
	margin-bottom:.0001pt;
	font-size:8.0pt;
	font-family:"Tahoma","sans-serif";
	letter-spacing:-.25pt;}
p.NormalWeb10, li.NormalWeb10, div.NormalWeb10
	{mso-style-name:"Normal \(Web\)10";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:53.85pt;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.HeadingBase, li.HeadingBase, div.HeadingBase
	{mso-style-name:"Heading Base";
	margin-top:7.0pt;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:54.0pt;
	line-height:11.0pt;
	page-break-after:avoid;
	font-size:11.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-1.0pt;
	font-weight:bold;}
p.ChapterSubtitle, li.ChapterSubtitle, div.ChapterSubtitle
	{mso-style-name:"Chapter Subtitle";
	margin-top:3.0pt;
	margin-right:0cm;
	margin-bottom:6.0pt;
	margin-left:0cm;
	line-height:17.0pt;
	page-break-after:avoid;
	border:none;
	padding:0cm;
	font-size:14.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.8pt;
	font-style:italic;}
p.a, li.a, div.a
	{mso-style-name:\041F\0440\043E\0441\0442\043E\0439;
	margin:0cm;
	margin-bottom:.0001pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.FootnoteBase, li.FootnoteBase, div.FootnoteBase
	{mso-style-name:"Footnote Base";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:54.0pt;
	line-height:10.0pt;
	font-size:8.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.BlockQuotation, li.BlockQuotation, div.BlockQuotation
	{mso-style-name:"Block Quotation";
	margin-top:0cm;
	margin-right:11.9pt;
	margin-bottom:6.0pt;
	margin-left:68.3pt;
	line-height:11.0pt;
	background:#F2F2F2;
	border:none;
	padding:0cm;
	font-size:10.0pt;
	font-family:"Chicago","sans-serif";
	letter-spacing:-.25pt;}
p.BodyTextKeep, li.BodyTextKeep, div.BodyTextKeep
	{mso-style-name:"Body Text Keep";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:53.85pt;
	line-height:12.0pt;
	page-break-after:avoid;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.Picture, li.Picture, div.Picture
	{mso-style-name:Picture;
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:53.85pt;
	line-height:12.0pt;
	page-break-after:avoid;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.DocumentLabel, li.DocumentLabel, div.DocumentLabel
	{mso-style-name:"Document Label";
	margin-top:12.0pt;
	margin-right:-42.0pt;
	margin-bottom:25.0pt;
	margin-left:-42.0pt;
	text-indent:-.55pt;
	line-height:32.0pt;
	page-break-after:avoid;
	border:none;
	padding:0cm;
	font-size:26.0pt;
	font-family:"Arial","sans-serif";
	text-transform:uppercase;
	letter-spacing:-1.0pt;
	font-weight:bold;}
p.CoverTitle, li.CoverTitle, div.CoverTitle
	{mso-style-name:"Cover Title";
	margin-top:12.0pt;
	margin-right:0cm;
	margin-bottom:25.0pt;
	margin-left:.55pt;
	text-indent:-.55pt;
	line-height:32.0pt;
	page-break-after:avoid;
	border:none;
	padding:0cm;
	font-size:26.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-1.0pt;
	font-weight:bold;}
p.CoverSubtitle, li.CoverSubtitle, div.CoverSubtitle
	{mso-style-name:"Cover Subtitle";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:0cm;
	margin-left:.55pt;
	margin-bottom:.0001pt;
	line-height:24.0pt;
	page-break-after:avoid;
	border:none;
	padding:0cm;
	font-size:24.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-1.5pt;
	font-weight:bold;}
p.HeaderBase, li.HeaderBase, div.HeaderBase
	{mso-style-name:"Header Base";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:53.85pt;
	text-align:right;
	line-height:12.0pt;
	font-size:7.5pt;
	font-family:"Arial","sans-serif";
	font-variant:small-caps;
	letter-spacing:-.25pt;}
p.IndexBase, li.IndexBase, div.IndexBase
	{mso-style-name:"Index Base";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:18.0pt;
	text-indent:-18.0pt;
	line-height:12.0pt;
	font-size:9.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.BlockDefinition, li.BlockDefinition, div.BlockDefinition
	{mso-style-name:"Block Definition";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:167.25pt;
	text-indent:-4.0cm;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
span.CODE
	{mso-style-name:CODE;
	font-family:"Courier New";}
span.Superscript
	{mso-style-name:Superscript;
	font-weight:bold;
	vertical-align:super;}
p.TOCBase, li.TOCBase, div.TOCBase
	{mso-style-name:"TOC Base";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:0cm;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.BlockIcon, li.BlockIcon, div.BlockIcon
	{mso-style-name:"Block Icon";
	margin-top:3.0pt;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:0cm;
	text-align:center;
	line-height:72.0pt;
	background:#B2B2B2;
	font-size:80.0pt;
	font-family:Wingdings;
	color:white;
	position:relative;
	top:5.0pt;
	letter-spacing:-.5pt;
	font-weight:bold;}
p.FooterFirst, li.FooterFirst, div.FooterFirst
	{mso-style-name:"Footer First";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:0cm;
	line-height:9.5pt;
	border:none;
	padding:0cm;
	font-size:7.5pt;
	font-family:"Arial","sans-serif";
	text-transform:uppercase;}
p.FooterEven, li.FooterEven, div.FooterEven
	{mso-style-name:"Footer Even";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:0cm;
	line-height:9.5pt;
	border:none;
	padding:0cm;
	font-size:7.5pt;
	font-family:"Arial","sans-serif";
	text-transform:uppercase;}
p.FooterOdd, li.FooterOdd, div.FooterOdd
	{mso-style-name:"Footer Odd";
	margin-top:30.0pt;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:0cm;
	line-height:9.5pt;
	border:none;
	padding:0cm;
	font-size:7.5pt;
	font-family:"Arial","sans-serif";
	text-transform:uppercase;}
p.HeaderFirst, li.HeaderFirst, div.HeaderFirst
	{mso-style-name:"Header First";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:53.85pt;
	text-align:right;
	line-height:12.0pt;
	border:none;
	padding:0cm;
	font-size:7.5pt;
	font-family:"Arial","sans-serif";
	text-transform:uppercase;}
p.HeaderEven, li.HeaderEven, div.HeaderEven
	{mso-style-name:"Header Even";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:30.0pt;
	margin-left:53.85pt;
	text-align:right;
	text-indent:0cm;
	line-height:12.0pt;
	border:none;
	padding:0cm;
	font-size:7.5pt;
	font-family:"Arial","sans-serif";
	text-transform:uppercase;}
p.HeaderOdd, li.HeaderOdd, div.HeaderOdd
	{mso-style-name:"Header Odd";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:30.0pt;
	margin-left:53.85pt;
	text-align:right;
	text-indent:0cm;
	line-height:12.0pt;
	border:none;
	padding:0cm;
	font-size:7.5pt;
	font-family:"Arial","sans-serif";
	text-transform:uppercase;}
p.TitleAddress, li.TitleAddress, div.TitleAddress
	{mso-style-name:"Title Address";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:0cm;
	line-height:8.0pt;
	font-size:7.0pt;
	font-family:"Arial","sans-serif";}
span.Slogan
	{mso-style-name:Slogan;
	letter-spacing:-.3pt;
	font-style:italic;}
p.TitleCover, li.TitleCover, div.TitleCover
	{mso-style-name:"Title Cover";
	margin-top:24.0pt;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:0cm;
	text-align:center;
	line-height:28.0pt;
	page-break-after:avoid;
	border:none;
	padding:0cm;
	font-size:28.0pt;
	font-family:"Arial Narrow","sans-serif";
	font-weight:bold;}
p.SubtitleCover, li.SubtitleCover, div.SubtitleCover
	{mso-style-name:"Subtitle Cover";
	margin-top:6.0pt;
	margin-right:0cm;
	margin-bottom:24.0pt;
	margin-left:0cm;
	text-align:center;
	line-height:24.0pt;
	page-break-after:avoid;
	font-size:18.0pt;
	font-family:"Arial Narrow","sans-serif";
	font-weight:bold;
	font-style:italic;}
p.ChapterLabel, li.ChapterLabel, div.ChapterLabel
	{mso-style-name:"Chapter Label";
	margin-top:0cm;
	margin-right:382.75pt;
	margin-bottom:6.0pt;
	margin-left:0cm;
	text-align:center;
	line-height:18.0pt;
	page-break-before:always;
	background:black;
	border:none;
	padding:0cm;
	font-size:13.0pt;
	font-family:"Arial","sans-serif";
	color:white;}
p.ChapterNumber, li.ChapterNumber, div.ChapterNumber
	{mso-style-name:"Chapter Number";
	margin-top:0cm;
	margin-right:382.75pt;
	margin-bottom:12.0pt;
	margin-left:0cm;
	text-align:center;
	line-height:33.0pt;
	background:black;
	border:none;
	padding:0cm;
	font-size:42.0pt;
	font-family:"Arial","sans-serif";
	color:white;
	position:relative;
	top:4.0pt;
	font-weight:bold;}
p.ListLast, li.ListLast, div.ListLast
	{mso-style-name:"List Last";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:36.0pt;
	text-indent:-18.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";}
span.DFN
	{mso-style-name:DFN;
	font-weight:bold;}
p.ListBulletFirst, li.ListBulletFirst, div.ListBulletFirst
	{mso-style-name:"List Bullet First";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:72.0pt;
	text-indent:-18.0pt;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.ListBulletLast, li.ListBulletLast, div.ListBulletLast
	{mso-style-name:"List Bullet Last";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:72.0pt;
	text-indent:-18.0pt;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.ListNumberFirst, li.ListNumberFirst, div.ListNumberFirst
	{mso-style-name:"List Number First";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:53.85pt;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.ListNumberLast, li.ListNumberLast, div.ListNumberLast
	{mso-style-name:"List Number Last";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:53.85pt;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.a0, li.a0, div.a0
	{mso-style-name:\0421\043F\0438\0441\043E\043A\0421\0432\043E\0439\0441\0442\0432;
	margin-top:0cm;
	margin-right:1.0cm;
	margin-bottom:0cm;
	margin-left:53.85pt;
	margin-bottom:.0001pt;
	background:#DFDFDF;
	font-size:10.0pt;
	font-family:"Courier New";}
p.BlockQuotationFirst, li.BlockQuotationFirst, div.BlockQuotationFirst
	{mso-style-name:"Block Quotation First";
	margin-top:0cm;
	margin-right:11.9pt;
	margin-bottom:6.0pt;
	margin-left:68.3pt;
	line-height:11.0pt;
	page-break-after:avoid;
	background:#CCCCCC;
	font-size:10.0pt;
	font-family:"Chicago","sans-serif";
	letter-spacing:-.25pt;
	font-weight:bold;}
p.SectionHeading, li.SectionHeading, div.SectionHeading
	{mso-style-name:"Section Heading";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:0cm;
	text-indent:0cm;
	page-break-after:avoid;
	font-size:20.0pt;
	font-family:"Arial","sans-serif";
	font-weight:bold;}
p.BlockQuotationLast, li.BlockQuotationLast, div.BlockQuotationLast
	{mso-style-name:"Block Quotation Last";
	margin-top:0cm;
	margin-right:11.9pt;
	margin-bottom:6.0pt;
	margin-left:68.3pt;
	line-height:11.0pt;
	background:#F2F2F2;
	font-size:10.0pt;
	font-family:"Chicago","sans-serif";
	letter-spacing:-.25pt;}
p.ListFirst, li.ListFirst, div.ListFirst
	{mso-style-name:"List First";
	margin-top:4.0pt;
	margin-right:0cm;
	margin-bottom:4.0pt;
	margin-left:36.0pt;
	text-indent:-18.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";}
p.BlockMarginComment, li.BlockMarginComment, div.BlockMarginComment
	{mso-style-name:"Block Margin Comment";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:0cm;
	page-break-after:avoid;
	border:none;
	padding:0cm;
	font-size:10.0pt;
	font-family:"Times New Roman","serif";}
p.CoverAddress, li.CoverAddress, div.CoverAddress
	{mso-style-name:"Cover Address";
	margin:0cm;
	margin-bottom:.0001pt;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.comments, li.comments, div.comments
	{mso-style-name:comments;
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:36.0pt;
	text-indent:-36.0pt;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"HelvCondenced","sans-serif";
	color:blue;}
p.CoverCompany, li.CoverCompany, div.CoverCompany
	{mso-style-name:"Cover Company";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:6.0pt;
	margin-left:0cm;
	text-align:right;
	line-height:18.0pt;
	font-size:18.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;
	font-weight:bold;}
p.CoverComment, li.CoverComment, div.CoverComment
	{mso-style-name:"Cover Comment";
	margin-top:24.0pt;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:0cm;
	line-height:28.0pt;
	page-break-after:avoid;
	border:none;
	padding:0cm;
	font-size:28.0pt;
	font-family:"Arial Narrow","sans-serif";
	font-weight:bold;}
p.CoverMessage, li.CoverMessage, div.CoverMessage
	{mso-style-name:"Cover Message";
	margin:0cm;
	margin-bottom:.0001pt;
	font-size:14.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.TOCHeading1, li.TOCHeading1, div.TOCHeading1
	{mso-style-name:"TOC Heading1";
	margin-top:11.0pt;
	margin-right:0cm;
	margin-bottom:3.0pt;
	margin-left:0cm;
	text-indent:0cm;
	line-height:16.0pt;
	page-break-after:avoid;
	font-size:12.0pt;
	font-family:"Arial","sans-serif";
	font-weight:bold;}
span.STRONG
	{mso-style-name:STRONG;
	font-weight:bold;
	font-style:italic;}
p.a1, li.a1, div.a1
	{mso-style-name:\0421\043F\0438\0441\043E\043A\0421\0432\043E\0439\0441\0442\0432\041F\0435\0440\0432\044B\0439;
	margin-top:12.0pt;
	margin-right:1.0cm;
	margin-bottom:0cm;
	margin-left:53.85pt;
	margin-bottom:.0001pt;
	background:#DFDFDF;
	font-size:10.0pt;
	font-family:"Courier New";}
p.a2, li.a2, div.a2
	{mso-style-name:\0421\043F\0438\0441\043E\043A\0421\0432\043E\0439\0441\0442\0432\041F\043E\0441\043B\0435\0434\043D\0438\0439;
	margin-top:0cm;
	margin-right:1.0cm;
	margin-bottom:12.0pt;
	margin-left:53.85pt;
	background:#DFDFDF;
	font-size:10.0pt;
	font-family:"Courier New";}
p.ReportAnnotation, li.ReportAnnotation, div.ReportAnnotation
	{mso-style-name:ReportAnnotation;
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:0cm;
	margin-left:53.85pt;
	margin-bottom:.0001pt;
	font-size:8.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.ReportAnnotationHDR, li.ReportAnnotationHDR, div.ReportAnnotationHDR
	{mso-style-name:ReportAnnotationHDR;
	margin-top:3.0pt;
	margin-right:0cm;
	margin-bottom:3.0pt;
	margin-left:53.85pt;
	font-size:8.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;
	font-weight:bold;}
span.FileName
	{mso-style-name:FileName;
	font-variant:small-caps;}
p.TableNormal, li.TableNormal, div.TableNormal
	{mso-style-name:TableNormal;
	margin-top:6.0pt;
	margin-right:0cm;
	margin-bottom:0cm;
	margin-left:0cm;
	margin-bottom:.0001pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.TableTitle, li.TableTitle, div.TableTitle
	{mso-style-name:TableTitle;
	margin-top:0cm;
	margin-right:-5.65pt;
	margin-bottom:0cm;
	margin-left:-5.65pt;
	margin-bottom:.0001pt;
	text-align:center;
	page-break-after:avoid;
	background:#CCCCCC;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;
	font-weight:bold;}
p.Status, li.Status, div.Status
	{mso-style-name:Status;
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:0cm;
	text-indent:22.7pt;
	line-height:12.0pt;
	background:#CCCCCC;
	font-size:12.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
p.CoverAuthor, li.CoverAuthor, div.CoverAuthor
	{mso-style-name:"Cover Author";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:0cm;
	line-height:12.0pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	letter-spacing:-.25pt;}
span.BalloonTextChar
	{mso-style-name:"Balloon Text Char";
	mso-style-link:"Balloon Text";
	font-family:"Tahoma","sans-serif";
	letter-spacing:-.25pt;}
 /* Page Definitions */
 @page Section1
	{size:595.3pt 841.9pt;
	margin:71.9pt 42.5pt 62.9pt 3.0cm;}
div.Section1
	{page:Section1;}
 /* List Definitions */
 ol
	{margin-bottom:0cm;}
ul
	{margin-bottom:0cm;}
-->
</style>

</head>


<body lang=EN-US link=blue vlink=purple>

<div class=Section1>

<p class=NormalWeb10 align=center style='text-align:center'><b><span lang=RU
style='font-size:16.0pt'>Карточка учебного продукта </span></b></p>

<p class=NormalWeb10 align=center style='text-align:center'><b><span lang=RU
style='font-size:16.0pt'>Описание</span></b></p>


	  <?
			function checkHtml($str){
				$mystring = 'ul';
				$pos = strpos($str, $mystring);
				if ($pos === false) {
					$str = nl2br($str);
				}
				return $str;
			}
//iwrite($arResult);
global  $arEventInfo ;
	      $course_name = $arResult["NAME"];
	      $course_id = $arResult["ID"];

	      $course_code = $arResult['PROPERTIES']['course_code']['VALUE'];
	      $course_version  = $arResult['PROPERTIES']['course_version']['VALUE'];
	      $course_price = $arResult['PROPERTIES']['course_price']['VALUE'];
	      //$course_description = $arResult['PROPERTIES']['course_description']['VALUE'];
	      $course_language = $arResult['PROPERTIES']['course_language']['VALUE'];
	      $course_duration = $arResult['PROPERTIES']['course_duration']['VALUE'];
	      $course_type = $arResult['PROPERTIES']['course_type']['VALUE'];
	      $course_puproses = $arResult['PROPERTIES']['course_puproses']['~VALUE'];
          //iwrite($arResult['PROPERTIES']['course_puproses']['~VALUE']);



	      //$course_topics = nl2br($arResult['PROPERTIES']['course_topics']['VALUE']);
	      $course_audience = $arResult['PROPERTIES']['course_audience']['~VALUE'];
	      //$course_required = nl2br($arResult['PROPERTIES']['course_required']['VALUE']);
	      $course_linkedcourses = nl2br($arResult['PROPERTIES']['course_linkedcourses']['VALUE']);
	      $course_trainers = $arResult['PROPERTIES']['course_trainers']['VALUE'];
	      $course_owner = $arResult['PROPERTIES']['course_owner']['VALUE'];
	      $course_requirements = nl2br($arResult['PROPERTIES']['course_requirements']['VALUE']);
	      $course_addsources = $arResult['PROPERTIES']['course_addsources']['~VALUE'];
	      $course_other =$arResult['PROPERTIES']['course_other']['~VALUE'];
	      $course_filename = $arResult['PROPERTIES']['course_filename']['VALUE'];
	      $course_idcategory = strip_tags($arResult['DISPLAY_PROPERTIES']['course_idcategory']);
	      //$course_linkedcourses = nl2br($arResult['PROPERTIES']['course_linkedcourses']['VALUE']);


          $course_puproses = checkHtml($course_puproses);
          $course_audience = checkHtml($course_audience);
          $course_addsources = checkHtml($course_addsources);
          $course_other = checkHtml($course_other);



	      $course_topics_html_text = $arResult['PROPERTIES']['course_top_html']['VALUE']['TEXT'];
	      $course_topics_html_type = $arResult['PROPERTIES']['course_top_html']['VALUE']['TYPE'];
	      //iwrite($arResult['PROPERTIES']['course_top_html']);
	      if (($course_topics_html_type=="text") or ($course_topics_html_type=="TEXT")) {

	      	$course_topics = nl2br($course_topics_html_text);
	      } else {
	      	$course_topics = $arResult['PROPERTIES']['course_top_html']['~VALUE']['TEXT'];
	      }

	      $course_desc_html_text = $arResult['PROPERTIES']['course_desc_new']['VALUE']['TEXT'];
	      $course_desc_html_type = $arResult['PROPERTIES']['course_desc_new']['VALUE']['TYPE'];
	      if (($course_desc_html_type=="text") or ($course_desc_html_type=="TEXT")) {
	      	$course_description = nl2br($course_desc_html_text);
	      } else {
	      	$course_description = $arResult['PROPERTIES']['course_desc_new']['~VALUE']['TEXT'];
	      }
          //iwrite($arResult['PROPERTIES']['course_linked_new']);
	      $course_linked_html_text = $arResult['PROPERTIES']['course_linked_new']['VALUE']['TEXT'];
	      $course_linked_html_type = $arResult['PROPERTIES']['course_linked_new']['VALUE']['TYPE'];
	      if (($course_linked_html_type=="text") or ($course_linked_html_type=="TEXT")){
	      	$course_linkedcourses = nl2br($course_linked_html_text);
	      } else {
	      	$course_linkedcourses = $arResult['PROPERTIES']['course_linked_new']['~VALUE']['TEXT'];
	      }
          //iwrite($arResult['PROPERTIES']['course_req_new']);
	      $course_required_html_text = $arResult['PROPERTIES']['course_req_new']['VALUE']['TEXT'];
	      $course_required_html_type = $arResult['PROPERTIES']['course_req_new']['VALUE']['TYPE'];
	      if (($course_required_html_type=="text") or ($course_required_html_type=="TEXT")){
	      	$course_required = nl2br($course_required_html_text);
	      } else {
	      	$course_required = $arResult['PROPERTIES']['course_req_new']['~VALUE']['TEXT'];
	      }

	      //$course_topics = nl2br($arResult['PROPERTIES']['course_topics']['VALUE']);
 ?>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0
 style='margin-left:-12.6pt;border-collapse:collapse;border:none'>
 <thead>
  <tr>
   <td width=178 valign=top style='width:133.3pt;border:solid windowtext 1.0pt;
   padding:0cm 5.4pt 0cm 5.4pt'>
   <p class=TableTitle style='margin-left:0cm'><span lang=RU>Атрибут</span></p>
   </td>
   <td width=458 valign=top style='width:343.7pt;border:solid windowtext 1.0pt;
   border-left:none;padding:0cm 5.4pt 0cm 5.4pt'>
   <p class=TableTitle style='margin-left:0cm'><span lang=RU>Содержание</span></p>
   </td>
  </tr>
 </thead>

  <tr>
  <td width=178 valign=top style='width:133.3pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=TableNormal><span lang=RU>Код</span></p>
  </td>
  <td width=458 valign=top style='width:343.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=TableNormal><i><?=$course_code?></i></p>
  </td>
 </tr>
<tr>
  <td width=178 valign=top style='width:133.3pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=TableNormal><span lang=RU>Название</span></p>
  </td>
  <td width=458 valign=top style='width:343.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=TableNormal><b><i><span lang=RU><?=$course_name?></span></i></b></p>
  </td>
 </tr>
 <?
 //версия служебное поле

 ?>
 <? if (strlen($course_version)>0){?>
 <tr>
  <td width=178 valign=top style='width:133.3pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=TableNormal><span lang=RU>Версия/Дата</span></p>
  </td>
  <td width=458 valign=top style='width:343.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <?=$course_version?>
  </td>
 </tr>
 <? } ?>
   <?
 //версия служебное поле

 ?>
 <?if (strlen($arResult['PROPERTIES']['course_format']['VALUE_ENUM_ID'])>0) {?>
  <tr>
  <td width=178 valign=top style='width:133.3pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=TableNormal><span lang=RU>Формат</span></p>
  </td>
  <td width=458 valign=top style='width:343.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'>

	<? if($arResult['PROPERTIES']['course_format']['VALUE_ENUM_ID'] == 102)  { ?>
		Очный
	<? } ?>
	<? if($arResult['PROPERTIES']['course_format']['VALUE_ENUM_ID'] == 103)  { ?>
		Online (дистанционный)
	<? } ?>

  </td>
 </tr>
<? } ?>
	<?if (strlen($course_duration)>0){?>
	<? 		$mystring = $course_duration;
			$findme   = 'ч';
			$pos = strpos($mystring, $findme);
			if ($pos === false) {
			    $temp = " академических часов";
			} else {
			     $temp = "";
			}

	?>
 <tr>
  <td width=178 valign=top style='width:133.3pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=TableNormal><span lang=RU>Длительность </span></p>
  </td>
  <td width=458 valign=top style='width:343.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
<?=$course_duration?> <?=$temp?>
  </td>
 </tr>
  <? } ?>

  <? if(strlen($course_description)>1)  {  ?>
 <tr style='height:75.75pt'>
  <td width=178 valign=top style='width:133.3pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:75.75pt'>
  <p class=TableNormal><span lang=RU>Краткое описание</span></p>
  </td>
  <td width=458 valign=top style='width:343.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:75.75pt'>
  <?if ($course_desc_html_type=="TEXT"){?>
<?=$course_description?>
  <? } else {?>
<?=$course_description?>
  <? } ?>
  </td>
 </tr>
  <? } ?>


<? if(!$course_owner=="")  {  ?>
 <tr>
  <td width=178 valign=top style='width:133.3pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=TableNormal><span lang=RU>Владелец</span></p>
  </td>
  <td width=458 valign=top style='width:343.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
<?=$course_owner?>
  </td>
 </tr>
<? } ?>

 <? if(!$course_audience=="")  {  ?>

 <tr>
  <td width=178 valign=top style='width:133.3pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=TableNormal><span lang=RU>Целевая аудитория</span></p>
  </td>
  <td width=458 valign=top style='width:343.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
<?=$course_audience?>
  </td>
 </tr>
  <? } ?>

<? if(!$course_puproses=="")  {  ?>
  <tr>
  <td width=178 valign=top style='width:133.3pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=TableNormal><span lang=RU>Цели</span></p>
  </td>
  <td width=458 valign=top style='width:343.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
<?=$course_puproses?>
  </td>
 </tr>
<? } ?>

<? if(!$course_audience=="")  {  ?>
  <tr>
  <td width=178 valign=top style='width:133.3pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=TableNormal><span lang=RU>Целевая аудитория</span></p>
  </td>
  <td width=458 valign=top style='width:343.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
<?=$course_audience?>
  </td>
 </tr>
<? } ?>





 <? if(strlen($course_topics)>1)  {  ?>
<tr>
  <td width=178 valign=top style='width:133.3pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=TableNormal><span lang=RU>Рассматриваемые темы</span></p>
  </td>
  <td width=458 valign=top style='width:343.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <?if ($course_topics_html_type=="TEXT"){?>
  <?=$course_topics?>

  <? } else {?>
   <?=$course_topics?>
  <? }?>
  </td>
 </tr>

<? } ?>
<? if(strlen($course_required)>1)  {  ?>
 <tr>
  <td width=178 valign=top style='width:133.3pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=TableNormal><span lang=RU>Предварительная подготовка - общее</span></p>
  </td>
  <td width=458 valign=top style='width:343.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  	<?if (strtoupper($course_required_html_type)=="TEXT"){?>

		<?=$course_required?>

		<? } else {?>
		<div><?=$course_required?></div>
	<? }?>


  </td>
 </tr>
 <? } ?>



<?  //ID_PREDV_COURSES  course_format
	$varNumberPredvCourses  =  count($arResult["PROPERTIES"]["ID_PREDV_COURSES"]["VALUE"]);
	$arIDCourses = array();
	if  (($varNumberPredvCourses > 0) and  array_key_exists("0", $arResult["PROPERTIES"]["ID_PREDV_COURSES"]["VALUE"])){?>
 <tr>
  <td width=178 valign=top style='width:133.3pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=TableNormal><span lang=RU>Предварительная подготовка – курсы УЦ:</span></p>
  </td>
  <td width=458 valign=top style='width:343.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'>


	<div class="indent">
         <blockquote>
			<ul class="linked">
		<?
			$arOrder = array("PROPERTY_COURSE_FORMAT" =>"DESC", "PROPERTY_COURSE_CODE" =>"ASC"); // DESC - онлайн курсы позади
			$arFilter = array("IBLOCK_ID"=>6, "ACTIVE"=>"Y" , "ID"=>$arResult["PROPERTIES"]["ID_PREDV_COURSES"]["VALUE"]);
			$arGroupBy = false;
			//$arGroupBy = array("PROPERTY_COURSE_FORMAT");
			$arNavStartParams = array();
			$arSelectFields = array("ID", "NAME", "PROPERTY_COURSE_CODE", "PROPERTY_COURSE_FORMAT", "PROPERTY_COURSE_DURATION" );
			$res = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelectFields);
			$index = 0; $tempVariable ="";
			while($ob = $res->GetNextElement())
			{
				$arFields = $ob->GetFields();?>
				<? if ($index == 0)  {
                	 $tempVariable = $arFields["PROPERTY_COURSE_FORMAT_ENUM_ID"];
                }?>
				<? if (($index == 0)  and ($arFields["PROPERTY_COURSE_FORMAT_ENUM_ID"] == 102)){
                	echo "<strong>Очные курсы:</strong>";
                }?>
				<? if (($index == 0)  and ( $arFields["PROPERTY_COURSE_FORMAT_ENUM_ID"] == 103) or
					($tempVariable <> $arFields["PROPERTY_COURSE_FORMAT_ENUM_ID"])) {
                	echo "<br /><strong>Online курсы:</strong>";
                }?>
                <?
                // ">=PROPERTY_STARTDATE" => $todayDate, "PROPERTY_SCHEDULE_COURSE"=>$arIDCourses
                // check курсы в раписании, если есть то выводим
				$arFilterTimetable = Array("IBLOCK_ID"=>9, "PROPERTY_SCHEDULE_COURSE"=>$arFields["ID"],
					 "ACTIVE" => "Y", ">=PROPERTY_STARTDATE" => date("Y-m-d"));
				$arGroupByTimetable = false;
				$arNavStartParamsTimetable = array("nTopCount" => 5);
				$arOrderTimetable = array("PROPERTY_SCHEDULE_COURSE" => "ASC");
				$arSelectFieldsTimetable = Array(
				"ID",
				"NAME",
				"PROPERTY_STARTDATE",
				"PROPERTY_REGISTRATION_LINK",
				"PROPERTY_COURSE_CODE",
				"PROPERTY_SCHEDULE_DURATION",
				"PROPERTY_STARTDATE",
				"PROPERTY_ENDDATE",
				"PROPERTY_CITY.NAME",
				"PROPERTY_CITY"
				);
				$indexTimetable = false;
				$resTimetable = CIBlockElement::GetList($arOrderTimetable, $arFilterTimetable, $arGroupByTimetable,
					$arNavStartParamsTimetable, $arSelectFieldsTimetable);
				$number = 0;
				$dateSomeCourses = "";
				while($obTimetable = $resTimetable->GetNextElement())
				{
					$arFieldsTimetable = $obTimetable->GetFields();
					$indexTimetable = true;
					if ($number !== 0){
						$dateSomeCourses .= ", ";
					}
					//iwrite($arFieldsTimetable);
					$dateSomeCourses .= $arFieldsTimetable['PROPERTY_STARTDATE_VALUE'];
            		if (strlen($arFieldsTimetable['PROPERTY_ENDDATE_VALUE'])>0){
            			$dateSomeCourses .= "-". $arFieldsTimetable['PROPERTY_ENDDATE_VALUE'];
            		}
	            	if ($arFieldsTimetable['PROPERTY_CITY_VALUE'] <> 14909){
            			$dateSomeCourses .= " (". $arFieldsTimetable['PROPERTY_CITY_NAME']. ")";
            		}
            		$number = $number + 1;
				}
                ?>
	            <li>
	            <?/*<a href="/training/catalog/course.html?ID=<?=$arFields['ID']?>">*/?>
	            	<?=$arFields['PROPERTY_COURSE_CODE_VALUE']?>
	            	<?=$arFields['NAME']?><?if (!$indexTimetable){?>
	            		<?/*</a>*/?>
                    <? } ?><?
	            	if ($indexTimetable){
	            		if (strlen($arFields['PROPERTY_COURSE_DURATION_VALUE'])>0){
	            			//echo ", ".$arFields['PROPERTY_COURSE_DURATION_VALUE']. " час.";
	            		}
	            		//echo "</a>, ";
	            		//echo $dateSomeCourses;
	            	}
	            	?>


	            </li>
                <? $index = $index + 1;
                   $tempVariable = $arFields["PROPERTY_COURSE_FORMAT_ENUM_ID"];
                 ?>
			<? } ?>
			</ul>
         </blockquote>
	</div><br />


  </td>
 </tr>
 <? } ?>


 <?  //ID_PREDV_COURSES  course_format
	$varNumberLinkedCourses  =  count($arResult["PROPERTIES"]["ID_LINKED_COURSES"]["VALUE"]);
	$arIDCourses = array();
	if  (($varNumberLinkedCourses > 0) and  array_key_exists("0", $arResult["PROPERTIES"]["ID_LINKED_COURSES"]["VALUE"])){?>
  <tr>
  <td width=178 valign=top style='width:133.3pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=TableNormal><span lang=RU>Связанные курсы</span></p>
  </td>
  <td width=458 valign=top style='width:343.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
	<div class="indent">
           <blockquote>
			<ul class="linked">
		<?
			$arOrder = array("PROPERTY_COURSE_FORMAT" =>"DESC", "PROPERTY_COURSE_CODE" =>"ASC"); // DESC - онлайн курсы позади
			$arFilter = array("IBLOCK_ID"=>6, "ACTIVE"=>"Y" , "ID"=>$arResult["PROPERTIES"]["ID_LINKED_COURSES"]["VALUE"]);
			$arGroupBy = false;
			//$arGroupBy = array("PROPERTY_COURSE_FORMAT");
			$arNavStartParams = array();
			$arSelectFields = array("ID", "NAME", "PROPERTY_COURSE_CODE", "PROPERTY_COURSE_FORMAT", "PROPERTY_COURSE_DURATION" );
			$res = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelectFields);
			$index = 0; $tempVariable ="";
			while($ob = $res->GetNextElement())
			{
				$arFields = $ob->GetFields();?>
				<? if ($index == 0)  {
                	 $tempVariable = $arFields["PROPERTY_COURSE_FORMAT_ENUM_ID"];
                }?>
				<? if (($index == 0)  and ($arFields["PROPERTY_COURSE_FORMAT_ENUM_ID"] == 102)){
                	echo "<strong>Очные курсы:</strong>";
                }?>
				<? if (($index == 0)  and ( $arFields["PROPERTY_COURSE_FORMAT_ENUM_ID"] == 103) or
					($tempVariable <> $arFields["PROPERTY_COURSE_FORMAT_ENUM_ID"])) {
                	echo "<br /><strong>Online курсы:</strong>";
                }?>
                <? // ">=PROPERTY_STARTDATE" => $todayDate, "PROPERTY_SCHEDULE_COURSE"=>$arIDCourses
                // check курсы в раписании, если есть то выводим
				$arFilterTimetable = Array("IBLOCK_ID"=>9, "PROPERTY_SCHEDULE_COURSE"=>$arFields["ID"],
					 "ACTIVE" => "Y", ">=PROPERTY_STARTDATE" => date("Y-m-d"));
				$arGroupByTimetable = false;
				$arNavStartParamsTimetable = array("nTopCount" => 5);
				$arOrderTimetable = array("PROPERTY_STARTDATE" => "ASC");
				$arSelectFieldsTimetable = Array(
				"ID",
				"NAME",
				"PROPERTY_STARTDATE",
				"PROPERTY_REGISTRATION_LINK",
				"PROPERTY_COURSE_CODE",
				"PROPERTY_SCHEDULE_DURATION",
				"PROPERTY_STARTDATE",
				"PROPERTY_ENDDATE",
				"PROPERTY_CITY.NAME",
				"PROPERTY_CITY"
				);
				$indexTimetable = false;
				$resTimetable = CIBlockElement::GetList($arOrderTimetable, $arFilterTimetable, $arGroupByTimetable,
					$arNavStartParamsTimetable, $arSelectFieldsTimetable);
				$dateSomeCourses = "";
				$number = 0;
				while($obTimetable = $resTimetable->GetNextElement())
				{
					$arFieldsTimetable = $obTimetable->GetFields();
					$indexTimetable = true;
					if ($number !== 0){
						$dateSomeCourses .= ", ";
					}
					//iwrite($arFieldsTimetable);
					$dateSomeCourses .= $arFieldsTimetable['PROPERTY_STARTDATE_VALUE'];
            		if (strlen($arFieldsTimetable['PROPERTY_ENDDATE_VALUE'])>0){
            			$dateSomeCourses .= "-". $arFieldsTimetable['PROPERTY_ENDDATE_VALUE'];
            		}
	            	if ($arFieldsTimetable['PROPERTY_CITY_VALUE'] <> 14909){
            			$dateSomeCourses .= " (". $arFieldsTimetable['PROPERTY_CITY_NAME']. ")";
            		}
            		$number = $number + 1;
				}
                ?>
	            <li><?/*<a href="/training/catalog/course.html?ID=<?=$arFields['ID']?>">*/?>
	            	<?=$arFields['PROPERTY_COURSE_CODE_VALUE']?>
	            	<?=$arFields['NAME']?><?if (!$indexTimetable){?>
	            		<?/*</a>*/?>
                    <? } ?><?
	            	if ($indexTimetable){
	            		if (strlen($arFields['PROPERTY_COURSE_DURATION_VALUE'])>0){
	            			//echo ", ".$arFields['PROPERTY_COURSE_DURATION_VALUE']. " час.";
	            		}
	            		//echo "</a>, ";
	            		//echo $dateSomeCourses;
	            	}
	            	?>

	            </li>
                <? $index = $index + 1;
                   $tempVariable = $arFields["PROPERTY_COURSE_FORMAT_ENUM_ID"];
                 ?>
			<? } ?>
			</ul>
			</blockquote>
	</div><br />
  </td>
 </tr>
   <? } ?>


<? if(!$course_addsources=="")  {  ?>
 <tr>
  <td width=178 valign=top style='width:133.3pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=TableNormal><span lang=RU>Рекомендуемые дополнительные материалы,
  источники</span></p>
  </td>
  <td width=458 valign=top style='width:343.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
<?=$course_addsources?>
  </td>
 </tr>
 <? } ?>


<? if(!$course_classrequirements=="")  {  ?>
 <tr>
  <td width=178 valign=top style='width:133.3pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=TableNormal><span lang=RU>Требования к классу</span></p>
  </td>
  <td width=458 valign=top style='width:343.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
<?=$course_classrequirements?>
  </td>
 </tr>
 <? } ?>

<? if(!$course_other=="")  {  ?>
 <tr>
  <td width=178 valign=top style='width:133.3pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=TableNormal><span lang=RU>Примечание</span></p>
  </td>
  <td width=458 valign=top style='width:343.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
<?=$course_other?>
  </td>
 </tr>
 <? } ?>

</table>




</div>

</body>

</html>


