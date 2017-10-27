<?php
// Header
header("Content-type: application/vnd-ms-excel");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Pragma: public");
header("Expires: 0");
 
// Nama file ekspor "SuggestionBox-export.xls"
header("Content-Disposition: attachment; filename=SuggestionBox-export.xls");
header("Content-Transfer-Encoding: binary ");
 
// Table
include 'suggestion_box_view.inc.php';
?>	