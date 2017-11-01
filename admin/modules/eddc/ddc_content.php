<?php
/**
 * Copyright (C) 2015 Eko Wahyudi (waaah.you92@gmail.com)
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
/* e-DDC for SLiMS, update 09-04-2015*/ 
?>
<div class="col-sm-12">
    <div class="panel panel-default" >
        <div class="panel-body">
            <table id="ddc" class="table table-striped table-bordered"> 
                <thead>
                    <tr>
                        <th>Class</th><th>About</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                // Get e-DDC data from Databse
                $ddc = $dbs->query("SELECT clas, about FROM ddc_db");
                    while ($data = $ddc->fetch_row()) {
                        echo"<tr>
							<td>$data[0]</td><td>$data[1]</td>
						</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>