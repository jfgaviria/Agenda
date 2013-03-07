 		<!--Sidebar background-->
        <div id="sidebarbg">
        </div>
        <!--Sidebar content-->
        <div id="sidebar">

            <div class="shortcuts">
                <ul>
                    <li><a href="<?php echo CController::createUrl('/Ayuda'); ?>" title="Ayuda y Soporte" class="tip"><span class="icon24 icomoon-icon-support"></span></a></li>
                    <li><a href="<?php echo CController::createUrl('/Admin/backups'); ?>" title="Copias de Seguridad" class="tip"><span class="icon24 icomoon-icon-database"></span></a></li>
                    <li><a href="<?php echo CController::createUrl('/Estadisticas'); ?>" title="Estad&iacute;sticas" class="tip"><span class="icon24 icomoon-icon-pie-2"></span></a></li>
                    <li><a href="<?php echo CController::createUrl('/Agenda'); ?>" title="Citas" class="tip"><span class="icon24 icomoon-icon-calendar-2"></span></a></li>
                </ul>
            </div><!-- End search -->            

            <div class="sidenav">

                <div class="sidebar-widget" style="margin: -1px 0 0 0;">
                    <h5 class="title" style="margin-bottom:0">Menu Principal</h5>
                </div><!-- End .sidenav-widget -->

                <div class="mainnav">
                	<!-- Menu Principal -->
				    <?php require_once 'menu.php'; ?>
				    <!-- Fin Menu Principal -->
                </div>
            </div><!-- End sidenav -->

        </div><!-- End #sidebar -->