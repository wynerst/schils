<?php
if (!empty($_GET['p']) && $_GET['p'] == 'suggestion_box_success') {
    echo '<h3>Terimakasih Saran dan Kritik Anda, Selamat Berkunjung Kembali Ke Perpustakaan</h3>';
}
?>
<a class="btn btn-primary" href="index.php?p=suggestion_box"><?php echo __('Add'); ?></a>
<a class="btn btn-danger" href="index.php"><?php echo __('Home'); ?></a>
<a class="btn btn-danger" href="index.php?p=suggestion_box_view">Lihat Data</a>