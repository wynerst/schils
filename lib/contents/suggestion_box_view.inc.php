<?php
include('suggestion_box_config.php');
?>

 <div class="loginInfo">

<h1><center>Daftar Saran dan Kritik</center></h1>
<a href="index.php?p=suggestion_box">+ Tambah Saran Kritik</a>
<p><a href="index.php?p=suggestion_box_export">Export to spreadsheet format</a></p>
<table  width="100%" border="1" cellpadding="5" cellspacing="0">
    <tdead>
	
        <tr class="CSSTableGenerator2">
            <td><b><center>No.</center></b></td>
            <td><b><center><?php echo __('Visitor Name'); ?></center></b></td>
            <td><b><center><?php echo __('Email'); ?></center></b></td>
			<td><b><center><?php echo __('Phone Number'); ?></center></b></td>
            <td><b><center><?php echo __('Topic'); ?></center></b></td>
            <td><b><center><?php echo __('Description'); ?></center></b></td>
           
        </tr>
    </tdead>
    <tbody>
	<?php
    $query = mysql_query("select * from suggestion_box");
 
    $no = 1;
    while ($data = mysql_fetch_array($query)) {
    ?>
        <tr class="CSSTableGenerator">
            <td><center><?php echo $no; ?></center></td>
            <td><?php echo $data['name_suggestion']; ?></td>
            <td><?php echo $data['email']; ?></td>
			<td><?php echo $data['phone_numb']; ?></td>
            <td><?php echo $data['topic']; ?></td>
            <td><?php echo $data['description']; ?></td>
                       
        </tr>
    <?php
        $no++;
    }
    ?>
    </tbody>

</table>

</div>
