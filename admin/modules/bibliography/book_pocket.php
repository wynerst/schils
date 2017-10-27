<?php
/**
 * Copyright (C) 2007,2008  Arie Nugraha (dicarve@yahoo.com)
 * Some modification by Drajat Hasan (drajat@feraproject.wc.t)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 */

/* Pocket Book print */

// key to authenticate
define('INDEX_AUTH', '1');

// main system configuration
require '../../../sysconfig.inc.php';
// IP based access limitation
require LIB.'ip_based_access.inc.php';
do_checkIP('smc');
do_checkIP('smc-membership');
// start the session
require SB.'admin/default/session.inc.php';
require SB.'admin/default/session_check.inc.php';
require SIMBIO.'simbio_GUI/table/simbio_table.inc.php';
require SIMBIO.'simbio_GUI/form_maker/simbio_form_table_AJAX.inc.php';
require SIMBIO.'simbio_GUI/paging/simbio_paging.inc.php';
require SIMBIO.'simbio_DB/datagrid/simbio_dbgrid.inc.php';
require SIMBIO.'simbio_DB/simbio_dbop.inc.php';

// privileges checking
$can_read = utility::havePrivilege('bibliography', 'r');

if (!$can_read) {
    die('<div class="errorBox">You dont have enough privileges to view this section</div>');
}

// local settings
$max_print = 8;

// clean print queue
if (isset($_GET['action']) AND $_GET['action'] == 'clear') {
    // update print queue count object
    echo '<script type="text/javascript">parent.$(\'#queueCount\').html(\'0\');</script>';
    utility::jsAlert(__('Print queue cleared!'));
    unset($_SESSION['pocket']);
    exit();
}

if (isset($_POST['itemID']) AND !empty($_POST['itemID']) AND isset($_POST['itemAction'])) {
    if (!$can_read) {
        die();
    }
    if (!is_array($_POST['itemID'])) {
        // make an array
        $_POST['itemID'] = array($_POST['itemID']);
    }
    // loop array
    if (isset($_SESSION['pocket'])) {
        $print_count = count($_SESSION['pocket']);
    } else {
        $print_count = 0;
    }
    // card size
    $size = 2;
    // create AJAX request
    echo '<script type="text/javascript" src="'.JWB.'jquery.js"></script>';
    echo '<script type="text/javascript">';
    // loop array
    foreach ($_POST['itemID'] as $itemID) {
        if ($print_count == $max_print) {
            $limit_reach = true;
            break;
        }
        if (isset($_SESSION['pocket'][$itemID])) {
            continue;
        }
        if (!empty($itemID)) {
            //$pocket_text = trim($itemID);
            //echo '$.ajax({url: \''.SWB.'lib/phpbarcode/barcode.php?code='.$pocket_text.'&encoding='.$sysconf['barcode_encoding'].'&scale='.$size.'&mode=png\', type: \'GET\', error: function() { alert(\'Error creating pocket book!\'); } });'."\n";
            // add to sessions
            $_SESSION['pocket'][$itemID] = $itemID;
            $print_count++;
        }
    }
    echo '</script>';
    if (isset($limit_reach)) {
        $msg = str_replace('{max_print}', $max_print, __('Selected items NOT ADDED to print queue. Only {max_print} can be printed at once')); //mfc
        utility::jsAlert($msg);
    } else {
        // update print queue count object
        echo '<script type="text/javascript">parent.$(\'#queueCount\').html(\''.$print_count.'\');</script>';
        utility::jsAlert(__('Selected items added to print queue'));
    }
    exit();
}

// card pdf download
if (isset($_GET['action']) AND $_GET['action'] == 'print') {
    // check if label session array is available
    if (!isset($_SESSION['pocket'])) {
        utility::jsAlert(__('There is no data to print!'));
        die();
    }
    if (count($_SESSION['pocket']) < 1) {
        utility::jsAlert(__('There is no data to print!'));
        die();
    }
    // concat all ID together
    $item_ids = '';
    foreach ($_SESSION['pocket'] as $id) {
        $item_ids .= '\''.$id.'\',';
    }
    // strip the last comma
    $item_ids = substr_replace($item_ids, '', -1);

    // Query
	$pocket_q = $dbs->query('SELECT i.item_code, i.biblio_id,i.call_number,b.title FROM item AS i LEFT JOIN biblio AS b ON b.biblio_id=i.biblio_id WHERE i.item_code IN('.$item_ids.')');
    $pocket_datas = array();
    while ($pocket_d = $pocket_q->fetch_assoc()) {
        if ($pocket_d['item_code']) {
            $pocket_datas[] = $pocket_d;
        }
    }

    // include printed settings configuration file
    include SB.'admin'.DS.'admin_template'.DS.'printed_settings.inc.php';
    // check for custom template settings
    $custom_settings = SB.'admin'.DS.$sysconf['admin_template']['dir'].DS.$sysconf['template']['theme'].DS.'printed_settings.inc.php';
    if (file_exists($custom_settings)) {
        include $custom_settings;
    }

	  // load print settings from database to override value from printed_settings file
    loadPrintSettings($dbs, 'pocket');

    // chunk pockets array
    $chunked_pocket_arrays = array_chunk($pocket_datas, $sysconf['print']['pocket']['items_per_row']);
    // create html ouput
    $html_str = '<!DOCTYPE html>'."\n";
    $html_str .= '<html><head><title>Pocket Book by Drajat</title>'."\n";
    $html_str .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
    $html_str .= '<meta http-equiv="Pragma" content="no-cache" /><meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, post-check=0, pre-check=0" /><meta http-equiv="Expires" content="Fry, 02 Oct 2012 12:00:00 GMT" />';
    $html_str .= '<style type="text/css">'."\n";
    $html_str .= 'label {font-size: 11.5pt;}'."\n";
    $html_str .= 'p {margin: 0;}'."\n";
    $html_str .= '.trapesium { margin-bottom: 5cm;background: url("../images/kantong.png");background-size: 11cm 12cm;background-repeat: no-repeat;width: 11cm;height: 12cm;float: left;}'."\n";
    $html_str .= '.isi {padding-top: 320px;padding-left: 100px;}'."\n";              
    $html_str .= '</style>'."\n";
    $html_str .= '</head>'."\n";
    $html_str .= '<body>'."\n";
    $html_str .= '<a href="#" onclick="window.print()">Print Again</a><br /><br />'."\n";
    foreach ($chunked_pocket_arrays as $pocket_rows) {
        foreach ($pocket_rows as $pocket) {
          $html_str .= '<div class="trapesium">';
          $html_str .= '<div class="isi">';
          $html_str .= '<label>'.$sysconf['print']['pocket']['libraryname'].'<p>'.$sysconf['print']['pocket']['schoolname'].'</p>';
          $html_str .= '<span>Nomor Inven</span>';
          $html_str .= '<span style="margin-left:60px;">: '.$pocket['item_code'].'</span>';
          $html_str .= '<br>';
          $html_str .= '<span>Nomor Panggil</span>';
          $html_str .= '<span style="margin-left:48px;">: '.$pocket['call_number'].'</span>';
          $html_str .= '</div>';
          $html_str .= '</div>';
        }
    }
    //$html_str .= '<script type="text/javascript">self.print();</script>'."\n";
    $html_str .= '</body></html>'."\n";
    // unset the session
    unset($_SESSION['pocket']);
    // write to file
    $print_file_name = 'pocket_card_gen_print_result_'.strtolower(str_replace(' ', '_', $_SESSION['uname'])).'.html';
    $file_write = @file_put_contents(UPLOAD.$print_file_name, $html_str);
    if ($file_write) {
        // update print queue count object
        echo '<script type="text/javascript">parent.$(\'#queueCount\').html(\'0\');</script>';
        // open result in window
        echo '<script type="text/javascript">top.jQuery.colorbox({href: "'.SWB.FLS.'/'.$print_file_name.'", iframe: true, width: 800, height: 500, title: "'.__('Pocket Book Printing').'"})</script>';
    } else { utility::jsAlert('ERROR! Pocket failed to generate, possibly because '.SB.FLS.' directory is not writable'); }
    exit();
}

?>
<fieldset class="menuBox">
<div class="menuBoxInner printIcon">
	<div class="per_title">
    	<h2><?php echo __('Pocket Book Printing'); ?></h2>
    </div>
	<div class="sub_section">
		<div class="btn-group">
		<a target="blindSubmit" href="<?php echo MWB; ?>bibliography/book_pocket.php?action=clear" class="notAJAX btn btn-default" style="color: #f00;"><i class="glyphicon glyphicon-trash"></i>&nbsp;<?php echo __('Clear Print Queue'); ?></a>
		<a target="blindSubmit" href="<?php echo MWB; ?>bibliography/book_pocket.php?action=print" class="notAJAX btn btn-default"><i class="glyphicon glyphicon-print"></i>&nbsp;<?php echo __('Print Pocket for Selected Data'); ?></a>
		<a href="<?php echo MWB; ?>bibliography/pop_print_settings.php?type=pocket" class="notAJAX btn btn-default openPopUp" title="<?php echo __('Pocket Book print settings'); ?>"><i class="glyphicon glyphicon-wrench"></i></a>
    </div>
	    <form name="search" action="<?php echo MWB; ?>bibliography/book_pocket.php" id="search" method="get" style="display: inline;"><?php echo __('Search'); ?>:
	    <input type="text" name="keywords" size="30" />
	    <input type="submit" id="doSearch" value="<?php echo __('Search'); ?>" class="button" />
	    </form>
    </div>
    <div class="infoBox">
    <?php
    echo __('Maximum').' <font style="color: #f00">'.$max_print.'</font> '.__('records can be printed at once. Currently there is').' '; //mfc
    if (isset($_SESSION['pocket'])) {
        echo '<font id="queueCount" style="color: #f00">'.count($_SESSION['pocket']).'</font>';
    } else { echo '<font id="queueCount" style="color: #f00">0</font>'; }
    echo ' '.__('in queue waiting to be printed.'); //mfc
    ?>
    </div>
</div>
</fieldset>
<?php
/* search form end */
/* ITEM LIST */
// table spec
$table_spec = 'item AS i LEFT JOIN biblio AS b ON b.biblio_id=i.biblio_id';
// create datagrid
$datagrid = new simbio_datagrid();
$datagrid->setSQLColumn('i.item_code','i.item_code AS \''.__('No Inventaris').'\'', 'i.call_number AS \''.__('No Panggil').'\'', 'b.title AS \''.__('Judul Buku').'\'');
$datagrid->setSQLorder('b.last_update DESC');
// is there any search
if (isset($_GET['keywords']) AND $_GET['keywords']) {
    $keyword = $dbs->escape_string(trim($_GET['keywords']));
    $words = explode(' ', $keyword);
    if (count($words) > 1) {
        $concat_sql = ' (';
        foreach ($words as $word) {
            $concat_sql .= " (i.item_code LIKE '%$word%' OR b.title LIKE '%$word%'";
        }
        // remove the last AND
        $concat_sql = substr_replace($concat_sql, '', -3);
        $concat_sql .= ') ';
        $datagrid->setSQLCriteria($concat_sql);
    } else {
        $datagrid->setSQLCriteria("i.item_code LIKE '%$keyword%' OR b.title LIKE '%$keyword%'");
    }
}
// set table and table header attributes
$datagrid->table_attr = 'align="center" id="dataList" cellpadding="5" cellspacing="0"';
$datagrid->table_header_attr = 'class="dataListHeader" style="font-weight: bold;"';
// edit and checkbox property
$datagrid->edit_property = false;
$datagrid->chbox_property = array('itemID', __('Add'));
$datagrid->chbox_action_button = __('Add To Print Queue');
$datagrid->chbox_confirm_msg = __('Add to print queue?');
$datagrid->column_width = array('10%','10%', '70%', '15%');
// set checkbox action URL
$datagrid->chbox_form_URL = $_SERVER['PHP_SELF'];
// put the result into variables
$datagrid_result = $datagrid->createDataGrid($dbs, $table_spec, 8, $can_read);
if (isset($_GET['keywords']) AND $_GET['keywords']) {
    echo '<div class="infoBox">'.__('Found').' '.$datagrid->num_rows.' '.__('from your search with keyword').': "'.$_GET['keywords'].'"</div>'; //mfc
}
echo $datagrid_result;
/* main content end */
