<!doctype html>
<html>
    <head><title><?php echo $page_title; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta http-equiv="Pragma" content="no-cache" /><meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, post-check=0, pre-check=0" /><meta http-equiv="Expires" content="Sat, 26 Jul 1997 05:00:00 GMT" />
        <link rel="stylesheet" type="text/css" href="<?php echo SWB; ?>template/default/css/bootstrap.min.css" />
        <?php if (isset($css)) { echo $css; } ?>
        <style type="text/css">
            table.dataTable span.highlight {
                background-color: #62cffc;
            }
            ::-webkit-scrollbar {
                width: 12px;
            }

            ::-webkit-scrollbar-track {
                -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
                border-radius: 10px;
            }

            ::-webkit-scrollbar-thumb {
                border-radius: 10px;
                -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
            }
        </style>
        <script src="<?php echo SWB; ?>/js/ddc_search/search.js"></script>
        <script src="<?php echo SWB; ?>/js/ddc_search/jquery.highlight.js"></script>
        <script src="<?php echo SWB; ?>/js/ddc_search/dataTables.searchHighlight.min.js"></script>
        <script src="<?php echo SWB; ?>/js/ddc_search/dataTables.bootstrap.js"></script>	
        <script src="<?php echo SWB; ?>/template/default/js/bootstrap.min.js"></script>	
        <?php if (isset($js)) { echo $js; } ?>
    </head>
    <body>
        <div id="pageContent">
            <?php echo $content; ?>
        </div>

        <!-- block if we inside iframe -->
        <script type="text/javascript">
            $(document).ready( function () {
                var table = $('#ddc').DataTable( {
                    searchHighlight: true
                } );
                table.search( '' ).draw();
            } );
        </script>

    </body>
</html>
