<!-- Plugin Kotak Saran Kritik by Erwan Setyo Budi (erwansetyobudi.librarian@gmail.com)-->

<?php
//isikan sama persis dengan yang ada di file "sysconfig.local.inc.php"
//jika ada password maka harus diisi juga passwordnya
$host = 'localhost';
$user = 'root';
$dbname = 'schils00';
$pass = '';
 
$connect = mysql_connect($host, $user, $pass) or die(mysql_error());
$dbselect = mysql_select_db($dbname);
?>
