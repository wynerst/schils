<?php
error_reporting(0);
function koneksi()
{
global $cn;
global $db;
$database='schils00';
$host='localhost';
$user='root';
$pass='';
$cn=mysql_connect($host,$user,$pass) or die('Server down!!');
$db=mysql_select_db($database,$cn) or die('database tidak ada');
}
koneksi();
function nama($nim)
{
koneksi(); 
$m=mysql_fetch_object(mysql_query("select * from member where member_id='$nim'"));
$nama=$m->member_name;
return $nama;
}

function selisihhari($tglAwal, $tglAkhir)
{
date_default_timezone_set('Asia/Jakarta');
 	
    $pecah1 = explode("-", $tglAwal);
    $date1 = $pecah1[2];
    $month1 = $pecah1[1];
    $year1 = $pecah1[0];

    $pecah2 = explode("-", $tglAkhir);
    $date2 = $pecah2[2];
    $month2 = $pecah2[1];
    $year2 =  $pecah2[0];

    $jd1 = GregorianToJD($month1, $date1, $year1);
    $jd2 = GregorianToJD($month2, $date2, $year2);

    $selisih = $jd2 - $jd1;
    return $selisih;
}

function denda($id) 
{

$dloan=mysql_fetch_array(mysql_query("select * from loan where loan_id='$id'"));
$loan_date=$dloan['loan_date'];
$due_date=$dloan['due_date'];
$now=date('Y-m-d');
$member_id=$dloan['member_id'];


$qholiday=mysql_query("SELECT COUNT(*) AS jum FROM `holiday` WHERE `holiday_date` BETWEEN '$due_date' AND '$now' ");
$dholiday=mysql_fetch_array($qholiday);
$libur=$dholiday['jum'];

$dmember=mysql_fetch_array(mysql_query("select * from member where member_id='$member_id'"));
$member_type_id=$dmember['member_type_id'];

$dmember_type=mysql_fetch_array(mysql_query("select * from mst_member_type where member_type_id='$member_type_id'"));
$denda=$dmember_type['fine_each_day'];

if ($due_date<$now) $nama=(selisihhari($due_date, $now)-$libur)*$denda;
else $nama='0';
return $nama;
}

function jml_keterlambatan($id) 
{

$dloan=mysql_fetch_array(mysql_query("select * from loan where loan_id='$id'"));
$loan_date=$dloan['loan_date'];
$due_date=$dloan['due_date'];
$now=date('Y-m-d');
$member_id=$dloan['member_id'];


$dhol=mysql_fetch_array(mysql_query("SELECT COUNT(*) AS jum FROM `holiday` WHERE `holiday_date` BETWEEN '$due_date' AND '$now' "));
$libur=$dhol['jum'];

if ($due_date<$now) $nama=selisihhari($due_date, $now)-$libur;
else $nama='0';
return $nama;
}


function isrenewed_bynim($id) {
$q=mysql_fetch_array(mysql_query("select * from member where member_id = '$id'"));
$q2=mysql_fetch_array(mysql_query("select * from mst_member_type where member_type_id = '$q[member_type_id]'"));
$hasil=$q2['reborrow_limit'];
return $hasil;

}

function adddate($id)
{
$vardate=date("Y-m-d");
$q=mysql_fetch_array(mysql_query("select * from member where member_id = '$id'"));

$q2=mysql_fetch_array(mysql_query("select * from mst_member_type where member_type_id = '$q[member_type_id]'"));
$tot=$q2['loan_periode'];

$newdate2 = strtotime ( '+'.$tot.' day' , strtotime ( $vardate ) ) ;
$newdate = date ( 'Y-m-j' , $newdate2 );

$a1=mysql_query("SELECT COUNT(*) AS jum FROM `holiday` WHERE `holiday_date` BETWEEN '$vardate' AND '$newdate' ");
$q1=mysql_fetch_array($a1);
$libur=$q1['jum'];

$lm_pinjam1 = strtotime ( '+'.$libur.' day' , strtotime ( $newdate ) ) ;
$lm_pinjam = date ( 'Y-m-j' , $lm_pinjam1 );

return $lm_pinjam;
}


function register_datebynim($id) {
$q=mysql_fetch_array(mysql_query("select * from member where member_id = '$id'"));
$hasil=$q['register_date'];
return $hasil;
}

function expire_datebynim($id) {
$q=mysql_fetch_array(mysql_query("select * from member where member_id = '$id'"));
$hasil=$q['expire_date'];
return $hasil;
}


function judul_byitem($id) {
	$a=mysql_fetch_array(mysql_query("select * from item where item_code='$id'"));
	$b=mysql_fetch_array(mysql_query("select * from biblio where biblio_id='$a[biblio_id]'"));
	$judul=$b['title'];
	return $judul;
}

// be sure that this file not accessed directly
if (!defined('INDEX_AUTH')) {
  die("can not access this file directly");
} elseif (INDEX_AUTH != 1) {
  die("can not access this file directly");
}

?>



 <style>

.button {
   border-top: 1px solid #96d1f8;
   background: #65a9d7;
   background: -webkit-gradient(linear, left top, left bottom, from(#539dcf), to(#65a9d7));
   background: -webkit-linear-gradient(top, #539dcf, #65a9d7);
   background: -moz-linear-gradient(top, #539dcf, #65a9d7);
   background: -ms-linear-gradient(top, #539dcf, #65a9d7);
   background: -o-linear-gradient(top, #539dcf, #65a9d7);
   padding: 9px 15px;
   -webkit-border-radius: 3px;
   -moz-border-radius: 3px;
   border-radius: 3px;
   -webkit-box-shadow: rgba(0,0,0,1) 0 1px 0;
   -moz-box-shadow: rgba(0,0,0,1) 0 1px 0;
   box-shadow: rgba(0,0,0,1) 0 1px 0;
   text-shadow: rgba(0,0,0,.4) 0 1px 0;
   color: white;
   font-size: 12px;
   text-decoration: none;
   margin-top:-10px;
   }
.button:hover {
   border-top-color: #28597a;
   background: #28597a;
   color: #ccc;
   }
.button:active {
   border-top-color: #1b435e;
   background: #1b435e;
   } 

.simpan {
background: #ff3019; /* Old browsers */
background: -moz-linear-gradient(top,  #ff3019 0%, #cf0404 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ff3019), color-stop(100%,#cf0404)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #ff3019 0%,#cf0404 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #ff3019 0%,#cf0404 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #ff3019 0%,#cf0404 100%); /* IE10+ */
background: linear-gradient(to bottom,  #ff3019 0%,#cf0404 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff3019', endColorstr='#cf0404',GradientType=0 ); /* IE6-9 */
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border-radius: 5px;
  color: #ffffff;
  font-size: 12px;
  padding: 5px 15px 5px 15px;
  text-decoration: none;
  width:auto;
  border:none;
   }
.simpan:hover {
   border-top-color: #28597a;
   background: #990000;
   color: #ccc;

  }

table {
    *border-collapse: collapse; /* IE7 and lower */
    border-spacing: 0;
    width: 100%;
}

#hasil {
    border: solid #ccc 1px;
}

#hasil tr:hover {
    background: #FFCC33;
    -o-transition: all 0.1s ease-in-out;
    -webkit-transition: all 0.1s ease-in-out;
    -moz-transition: all 0.1s ease-in-out;
    -ms-transition: all 0.1s ease-in-out;
    transition: all 0.1s ease-in-out;   
}  
  
#hasil td, #hasil th {
    border-left: 1px solid #ccc;
    border-top: 1px solid #ccc;
    padding-left: 10px;
	padding-right: 10px;

	padding-top: 5px;
	padding-bottom: 5px;
    text-align: left;  
		opacity:0.9;

}

#hasil th {
   background: #65a9d7;
   background: -webkit-gradient(linear, left top, left bottom, from(#539dcf), to(#65a9d7));
   background: -webkit-linear-gradient(top, #539dcf, #65a9d7);
   background: -moz-linear-gradient(top, #539dcf, #65a9d7);
   background: -ms-linear-gradient(top, #539dcf, #65a9d7);
   background: -o-linear-gradient(top, #539dcf, #65a9d7);
	border-top: none;
	color: #FFFFFF;
	font-size:13px;
	font-weight:normal;
   text-shadow: rgba(0,0,0,.4) 0 1px 0;

}

#hasil td {
   background: #fbf8e9;
   color: #000000;
   font-size:13px;
	
}

#hasil td:first-child, #hasil th:first-child {
    border-left: none;
}

   
   </style>


<?php



if (empty($_SESSION['pnim'])) {
	if (isset($_POST['login'])) {
		
		$ceknim=mysql_num_rows(mysql_query("select * from member where member_id = '$_POST[nim]'"));	
		$cekloan=mysql_num_rows(mysql_query("select * from loan where member_id = '$_POST[nim]' AND is_return ='0'"));	
		
		if ($ceknim>0) {
			
			if ($cekloan>0) {
				$_SESSION['pnim']=$_POST['nim'];
				$page='login';
				
			}
			
			else  { 
				$error='no_loan';
				$page='front';
				}
			
		}
		
		else  {
			$error='non_member';
			$page='front';
			}
	}
	
	else {$page='front';}
	
}


if (!empty($_SESSION['pnim'])) {

	if (isset($_POST['perpanjang'])) {
	
		$cekloan=mysql_num_rows(mysql_query("select * from loan where item_code = '$_POST[item_id]' AND member_id = '$_SESSION[pnim]' AND is_return = '0' "));
	
		$q2=mysql_fetch_array(mysql_query("select * from loan where item_code = '$_POST[item_id]' AND member_id = '$_SESSION[pnim]' AND is_return = '0' "));
		$loan_id=$q2['loan_id'];
		
	if (isrenewed_bynim($_SESSION['pnim']) > 0) {	
	  if ($cekloan>0) {				
		if (jml_keterlambatan($loan_id) == 0 ) {
			
			if ($q2['renewed'] < isrenewed_bynim($_SESSION['pnim'])) {
				$day=adddate($_SESSION['pnim']);
				$now=date("Y-m-d");
				mysql_query("UPDATE `loan` SET `due_date` = '$day',`renewed` = '1', return_date = '$now' WHERE `loan_id` = '$loan_id';");
				$sts="<div style=\"background:#4169E1 ; color:#FFFFFF; padding:5px 15px; width:95%; margin-bottom:10px;\">Perpanjangan buku dengan no barcode ".$_POST['item_id']." berhasil dilakukan.</div>";
				
			} //cek perpanjangan
			else {
				$sts="<div style=\"background:#CC3300; color:#FFFFFF; padding:5px 15px; width:95%; margin-bottom:10px;\">Maaf koleksi ini tidak dapat diperpanjang, buku dengan no barcode ".$_POST['item_id']." sudah pernah diperpanjang.</div>";
			
			}
			
		} //cek keterlambatan
		
		else {
			$sts="<div style=\"background:#CC3300; color:#FFFFFF; padding:5px 15px; width:95%; margin-bottom:10px;\">Maaf, koleksi ini tidak dapat diperpanjang, buku dengan no barcode ".$_POST['item_id']." terlambat ".jml_keterlambatan($loan_id)." hari dengan denda Rp. ".denda($loan_id)."</div>";
		//$sts="select * from loan where item_code = '$_POST[item_id]' AND member_id = '$_SESSION[pnim]' AND is_return = '0' ";
		}
		
	} //cek pinjaman
	  else {
			$sts="<div style=\"background:#CC3300; color:#FFFFFF; padding:5px 15px; width:95%; margin-bottom:10px;\">Maaf, koleksi ini tidak ditemukan</div>";
			$page='login';
	  }
	  
	}//cek tipe anggota
	else {
			$sts="<div style=\"background:#CC3300; color:#FFFFFF; padding:5px 15px; width:95%; margin-bottom:10px;\">Maaf, tipe keanggotaan anda tidak dapat melakukan perpanjangan buku</div>";
	}
		 		
		$page='login';
		
		
	}
	
	if (empty($_POST['perpanjang'])) {
			if (isset($_POST['logout'])) {
			$page ='front';
			$_SESSION['pnim']='';
			echo "<script>alert(\"Transaksi perpanjangan on-line telah selesai\")</script>";
			}
				else {$page='login';}

	}
	
	
}

switch ($page) {
	
	case 'front' :

$info = 'Selamat Datang di perpanjangan mandiri, dimana Anda bisa melakukan perpanjangan masa pinjam buku secara on-line, tanpa harus datang ke perpustakaan ';
$page_title = __('Perpanjang mandiri');
?>
Masukan nomor induk mahasiswa / nomor anggota perpustakaan pada form dibawah ini. Perpanjang on-line dapat dilakukan jika anda sudah terdaftar menjadi anggota perpustakaan dan memiliki pinjaman buku.<br/><br/>

<?php
	switch ($error) {
		case 'no_loan':echo "<div style=\"background:#CC3300; color:#FFFFFF; padding:5px 15px; width:95%; margin-bottom:10px;\">Maaf permintaan anda tidak dapat dilanjutkan, anda tidak memiliki pinjaman buku.</div>"; break;
		case 'non_member':echo "<div style=\"background:#CC3300; color:#FFFFFF; padding:5px 15px; width:95%; margin-bottom:10px;\">Maaf permintaan anda tidak dapat dilanjutkan, no anggota anda belum terdaftar.	</div>"; break;
	}
?>


<form action="index.php?p=perpanjang" method="post">
    <div class="fieldLabel"><?php echo __('Nomor Induk Mahasiswa'); ?></div>
        <div class="login_input"><input type="text" name="nim" autofocus required/></div>
  <input type="submit" name="login" value="<?php echo __('Login'); ?>" class="memberButton" />
</form>
    
 
<?php
	break;
	case 'login' :
	$info="Selamat anda berhasil login, silahkan lakukan perpanjangan mandiri";
	$page_title = __('Data Anggota');

?>

<form action="index.php?p=perpanjang" method="post">
    <input	 type="submit" name="logout" value="Selesaikan Transaksi" class="simpan" />
</form>
	<br/>
<form action="index.php?p=perpanjang" method="post">

	<table width="100%" border="0" cellspacing="2" cellpadding="4">
  <tr>
    <td width="24%"><strong>Nama Anggota</strong></td>
    <td width="1%">:</td>
    <td width="32%"><?php echo nama($_SESSION['pnim']);?></td>
    <td width="20%"><strong>ID anggota</strong></td>
    <td width="1%">:</td>
    <td width="22%"><?php echo $_SESSION['pnim']?></td>
  </tr>
  <tr>
    <td><strong>Tanggal Registrasi</strong></td>
    <td>:</td>
    <td><?php echo register_datebynim($_SESSION['pnim'])?></td>
    <td><strong>Berlaku Hingga</strong></td>
    <td>:</td>
    <td><?php echo expire_datebynim($_SESSION['pnim']) ?></td>
  </tr>
</table>
  <br/>
<div style="border: #00CCFF 1px solid; padding-top:5px; padding-left:10px;; width:98%; margin-bottom:10px; font-style:italic">
Untuk melakukan perpanjangan buku secara on-line, silahkan masukkan nomor barcode / nomor inventaris yang terdapat pada halaman sampul buku. Koleksi yang melebihi jatuh tempo tidak dapat diperpanjang secara on-line.<br/> <br/>
<?php echo $sts?>

<table width="100%">
	<tr>	
    	<td width="34%"><input name="item_id" type="text" placeholder="No Barcode Buku" onfocus/></td>
      <td width="66%"><input name="perpanjang" type="submit" value="Perpanjang"  class="button" /></td>
    </tr>
</table> 

</div>
<br/>
<div align="center" style=" font-weight:bold; color:#FF9900;">DAFTAR PINJAMAN</div>

<table id="hasil">
  <tr>
    <th width="64%">Judul buku</th>
    <th width="18%">Tanggal Pinjam</th>
    <th width="18%">Tanggal Kembali</th>
  </tr>
  <?php
  $q=mysql_query("select * from loan where member_id = '$_SESSION[pnim]' AND is_return !='1'");
  while ($d=mysql_fetch_array($q)) {
  ?>
  <tr>
    <td><?php echo judul_byitem($d['item_code']);
				if ($d['renewed']>0) echo "<div style=\"color:#0033CC;font-size:12px; font-style:italic\">koleksi telah diperpanjang</div>";
				else echo "";
				
				if (jml_keterlambatan($d['loan_id']) > 0) {echo "<div style=\"color:#FF0000;font-size:12px; font-style:italic\">terlambat selama ".jml_keterlambatan($d['loan_id'])." hari dengan denda Rp. ".denda($d['loan_id'])."</div>";}
				else echo "";
				
		?>
    </td>
    <td><?php echo $d['loan_date']?></td>
    <td><?php echo $d['due_date']?></td>
  </tr>
  <?php }?>
</table>

</form>
<?php
	break;	
}
?>
 
