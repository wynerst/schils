<!DOCTYPE html>
<?php
$page_title=$sysconf['library_name']." | Kotak Saran & Kritik";
?>
<html>
<head>
</head>
<body>
<div id="masking"></div>
    <div class="container">
        <div class="row">
            <div class="span6 offset1">
                <div class="row">
                    
<td><center><h4>Kotak  Saran dan Kritik  PERPUSTAKAAN</h4></center></td>
<hr/>
<form name="suggestion_box" action = "suggestion_box_insert.php" method = "post"> 
<table height="100%" border="0" cellpadding="5" cellspacing="0">
	<tbody>
	
        <tr>
            <td><?php echo __('Visitor Name'); ?>*&nbsp </td>
            <td></td>
            <td><input class="span4" type="text" name="name_suggestion"  required="required" /></td>
        </tr>
        <tr>
            <td><?php echo __('Email'); ?>*&nbsp </td>
            <td></td>
            <td><input class="span4" type="text" name="email"  required="required" /></td>
        </tr>
		<tr>
            <td><?php echo __('Phone Number'); ?></td>
            <td></td>
            <td><input class="span4" type="text" placeholder="Optional" name="phone_numb"  /></td>
        </tr>
        <tr>
            <td><?php echo __('Topic'); ?>*&nbsp </td>
            <td></td>
            <td><input class="span4" type="text" name="topic" required="required" /></td>
        </tr>
		
        <tr>
            <td><?php echo __('Description'); ?>*&nbsp </td>
            <td></td>
         <td><textarea class="span4" name="description" type="textarea" id="textfield3" cols="35" rows="6" title="Masukkan Alamat Anda secara lengkap"></textarea></td>
  </tr>
        
        <tr>
            <td align="right" colspan="3"><input class="btn btn-primary" type="submit" id="button" value="<?php echo __('Save'); ?>">
			<input class="btn btn-danger" type = "reset"  value="<?php echo __('Cancel'); ?> "/></td>
			      
		</tr>
		
	</tbody>
</table>
</form>
 <a>*Wajib diisi</a>
</form>
      </div>
            </div>
        </div>
    </div>

</body>
</html>
