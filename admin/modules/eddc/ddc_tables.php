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
<div class="col-sm-12"><div class="panel panel-default"><div class="panel-body">
	<div class="col-sm-3">
		<div class="sidebar-nav">
			<div class="panel-body">
				<div class="navbar navbar-default">
					<ul class="nav nav nav-pills nav-stacked">
						<li class="active"><a href="#table1" data-toggle="tab"><i class="glyphicon glyphicon-log-in"></i> Table 1</a></li>
						<li><a href="#table2" data-toggle="tab"><i class="glyphicon glyphicon-log-in"></i> Table 2</a></li>
						<li><a href="#table3" data-toggle="tab"><i class="glyphicon glyphicon-log-in"></i> Table 3</a></li>
						<li><a href="#table4" data-toggle="tab"><i class="glyphicon glyphicon-log-in"></i> Table 4</a></li>
						<li><a href="#table5" data-toggle="tab"><i class="glyphicon glyphicon-log-in"></i> Table 5</a></li>
						<li><a href="#table6" data-toggle="tab"><i class="glyphicon glyphicon-log-in"></i> Table 6</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-9">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane active" id="table1">
					<?php
						$ddc = $dbs->query("SELECT content_text FROM ddc_content WHERE content_id ='table1'");
							while ($content = $ddc->fetch_row()) {
								echo"$content[0]";
							}
					?>				
					</div>
					<div class="tab-pane" id="table2">
					<?php
						$ddc = $dbs->query("SELECT content_text FROM ddc_content WHERE content_id ='table2'");
							while ($content = $ddc->fetch_row()) {
								echo"$content[0]";
							}
					?>
					</div>
					<div class="tab-pane" id="table3">
					<?php
						$ddc = $dbs->query("SELECT content_text FROM ddc_content WHERE content_id ='table3'");
							while ($content = $ddc->fetch_row()) {
								echo"$content[0]";
							}
					?>
					</div>
					<div class="tab-pane" id="table4">
					<?php
						$ddc = $dbs->query("SELECT content_text FROM ddc_content WHERE content_id ='table4'");
							while ($content = $ddc->fetch_row()) {
								echo"$content[0]";
							}
					?>
					</div>
					<div class="tab-pane" id="table5">
					<?php
						$ddc = $dbs->query("SELECT content_text FROM ddc_content WHERE content_id ='table5'");
							while ($content = $ddc->fetch_row()) {
								echo"$content[0]";
							}
					?>
					</div>
					<div class="tab-pane" id="table6">
					<?php
						$ddc = $dbs->query("SELECT content_text FROM ddc_content WHERE content_id ='table6'");
							while ($content = $ddc->fetch_row()) {
								echo"$content[0]";
							}
					?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>