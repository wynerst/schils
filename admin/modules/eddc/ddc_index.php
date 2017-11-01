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
<!-- Menu -->
<div class="panel panel-primary">
    <div class="panel-heading"><b><img src="<?php echo SWB;?>images/default/image.png" width=15 height=20> e-DDC Edition 23</b></div>
    <div class="panel-body"><marquee><i><span class="label label-primary">electronic - Dewey Decimal Classification Edition 23 for SLiMS</span></i></marquee>
        <nav class="navbar navbar-default">
            <ul class="nav nav-tabs nav-pills">
                <li class="active"><a href="#home" data-toggle="tab"><i class="glyphicon glyphicon-home"></i> Home</a> </li>
                <li><a href="#content" data-toggle="tab"><i class="glyphicon glyphicon-book"></i> Content</a></li>
                <li><a href="#tables" data-toggle="tab"><i class="glyphicon glyphicon-list-alt"></i> Tables</a></li>
                <li><a href="#glossary" data-toggle="tab"><i class="glyphicon glyphicon-file"></i> Glossary</a></li>
            </ul>
            <!-- Tab -->
            <div class="tab-content">
                <!-- Home -->
                <div class="tab-pane active" id="home"><p>
                    <?php include "ddc_home.php";?>
                </div>
                <!-- Table e-DDC -->
                <div class="tab-pane" id="content"><p>
                    <?php include "ddc_content.php";?>
                </div>
                <!-- Tables -->
                <div class="tab-pane" id="tables"><p>
                    <?php include "ddc_tables.php";?>
                </div>
                <!-- Glossary -->
                <div class="tab-pane" id="glossary"><p>
                    <?php include "ddc_glossary.php";?>
                </div>
            </div>
        </nav>
    </div>
</div>

