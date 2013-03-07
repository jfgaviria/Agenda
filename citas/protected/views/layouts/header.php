<div id="header">

        <div class="navbar">
            <div class="navbar-inner">
              <div class="container-fluid">
                <a class="brand" href="<?php echo CController::createUrl('/'); ?>">Agenda M&eacute;dica <span class="slogan">SMDigital</span></a>
                <div class="nav-no-collapse">
                    <ul class="nav">
                        <li class="active"><a href="<?php echo CController::createUrl('/'); ?>"><span class="icon16 icomoon-icon-screen-2"></span> Escritorio</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="icon16 icomoon-icon-cog"></span> Administración
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="menu">
                                    <ul>
                                        <li>                                                    
                                            <a href="<?php echo CController::createUrl('/'); ?>"><span class="icon16 icomoon-icon-equalizer"></span>Maestros</a>
                                        </li>
                                        <li>                                                    
                                            <a href="<?php echo CController::createUrl('/'); ?>"><span class="icon16 icomoon-icon-users"></span>Usuarios</a>
                                        </li>
                                        <li>                                                    
                                            <a href="<?php echo CController::createUrl('/'); ?>"><span class="icon16 icomoon-icon-vcard"></span>Permisos</a>
                                        </li>
                                        <li>                                                    
                                            <a href="#"><span class="icon16 icomoon-icon-wrench"></span>Configuración</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="icon16 icomoon-icon-picture-2"></span>Temas</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="icon16 icomoon-icon-mail-3"></span>Mensajes <span class="notification">Próximamente</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="menu">
                                    <ul class="messages">    
                                        <li class="header"><strong>Mensajes</strong> (10) emails y (2) MP</li>
                                        <li>
                                           <span class="icon"><span class="icon16 icomoon-icon-user-3"></span></span>
                                            <span class="name"><a data-toggle="modal" href="#myModal1"><strong>Sammy Morerira</strong></a><span class="time">hace 35 min.</span></span>
                                            <span class="msg">Tengo una pregunta con respecto a ...</span>
                                        </li>
                                        <li>
                                           <span class="icon avatar"><img src="images/avatar.jpg" alt="" /></span>
                                            <span class="name"><a data-toggle="modal" href="#myModal1"><strong>George Michael</strong></a><span class="time">hace 1 hora</span></span>
                                            <span class="msg">Necesito una reunión urgente con usted ...</span>
                                        </li>
                                        <li>
                                            <span class="icon"><span class="icon16 icomoon-icon-mail-3"></span></span>
                                            <span class="name"><a data-toggle="modal" href="#myModal1"><strong>Ivanovich</strong></a><span class="time">hace 1 día</span></span>
                                            <span class="msg">Le envío mi sugerencia, por favor mírela ...</span>
                                        </li>
                                        <li class="view-all"><a href="#">Ver todos los mensajes <span class="icon16 icomoon-icon-arrow-right-8"></span></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                  
                    <ul class="nav pull-right usernav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="icon16 icomoon-icon-bell-2"></span><span class="notification">3</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="menu">
                                    <ul class="notif">
                                        <li class="header"><strong>Alertas</strong> (3) items</li>
                                        <li>
                                            <a href="#">
                                                <span class="icon"><span class="icon16 icomoon-icon-user-3"></span></span>
                                                <span class="event">2 Clientes para Gestión</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="icon"><span class="icon16 icomoon-icon-comments-4"></span></span>
                                                <span class="event">15 Pedidos sin instalar</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="icon"><span class="icon16 icomoon-icon-new-2"></span></span>
                                                <span class="event">4 Pedidos anulados</span>
                                            </a>
                                        </li>
                                        <li class="view-all"><a href="#">Ver todas las alertas <span class="icon16 icomoon-icon-arrow-right-8"></span></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle avatar" data-toggle="dropdown">
                                <img src="images/avatar.jpg" alt="" class="image" /> 
                                <span class="txt"><?php echo Yii::app()->user->name; ?></span>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="menu">
                                    <ul>
                                        <li>
                                            <a href="<?php echo CController::createUrl('/user/profile'); ?>"><span class="icon16 icomoon-icon-user-3"></span>Editar mis datos</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="icon16 icomoon-icon-comments-2"></span>Ver mensajes</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="icon16 icomoon-icon-coins"></span>Comisiones</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><a href="<?php echo CController::createUrl('/user/logout'); ?>"><span class="icon16 icomoon-icon-exit"></span> Salir</a></li>
                    </ul>
                </div><!-- /.nav-collapse -->
              </div>
            </div><!-- /navbar-inner -->
          </div><!-- /navbar --> 

    </div><!-- End #header -->