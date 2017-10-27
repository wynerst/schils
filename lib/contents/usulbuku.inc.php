<?php
// Formulir by Bayu S Pambudi
?>
<form action="lib/contents/insertusul.php" method="POST">
<table width='100%' cellpadding='2'  cellspacing='2' align='center' bgcolor="#FFFFF">
<center><h3>Isilah Semua Kolom Untuk Mempermudah Pencarian Buku*</center>
<hr>
<tr><td><b><u>DATA PENGUSUL</u></b></td></tr>
<tr><td width="250px"><b>Nama</b><br><br></td>
<td width="10"><b>:</b></td>
<td><input type="varchar" name="member_name" size="100" maxlength="100"/><br><br></td></tr>
<tr><td><b>No Anggota Perpustakaan</b></td><td width="10"><b>:</b></td><td><input type="varchar" name="member_id" size="20" maxlength="20"/></td></tr>
<tr><td colspan=3><hr></td></tr>
<tr><td><b><u>DATA BUKU YANG DIUSULKAN</u></b></td></tr>
<tr><td><b>Judul Buku</b><br>(Ditulis Lengkap)</td><td width="10"><b>:</b></td><td><textarea name="title" cols="30" rows="4"></textarea></td></tr>
<tr><td width="250px"><b>Pengarang</b><br></td>
<td width="10"><b>:</b></td>
<td><input type="text" name="author" size="50" maxlength="50"/></td></tr>
<tr><td width="250px"><b>Penerbit</b><br></td>
<td width="10"><b>:</b></td>
<td><input type="text" name="publisher" size="50" maxlength="50"/></td></tr>
<tr><td><b>Keterangan Buku</b><br>(Diisi Edisi, Cetakan, Tahun Terbit)</td><td width="10"><b>:</b></td><td><textarea name="keterangan" cols="30" rows="4"></textarea></td></tr>
<tr><td width="250px"><b>Harga Buku (Rp.)</b><br>(tanpa titik, ex: 34000)</td>
<td width="10"><b>:</b></td>
<td><input type="text" name="price" size="50" maxlength="50"/></td></tr>
<tr><td><b>Informasi Lainnya</b><br>(ex: Saya melihat buku ini ada di toko Gramedia)</td><td width="10"><b>:</b></td><td><textarea name="informasi" cols="30" rows="4"></textarea></td></tr>
<tr><td></td><td><input type="submit" name="kirim" value="Usul!"/>
  <label>
  <input type="reset" name="Reset" id="button" value="Batal">
  </label></td></tr>
</table>
