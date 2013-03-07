<?php
/**
 * @name index
 * Panel de Control
 * 
 * @author juan.gaviria
 */
$subtitle = 'Panel de Control';
$this->pageTitle=Yii::app()->name . ' - ' . $subtitle;
$this->breadcrumbs=array(
		ucfirst($this->id), $subtitle,
);
?>
				<!-- Build page from here: -->
                <div class="row-fluid">
                
                    <div class="span12">
                        <div class="centerContent">
                            <div class="circle-stats">
                                
                                <div class="circular-item tipB" title="Pedidos">
                                    <span class="icon icomoon-icon-cart-4"></span>
                                    <input type="text" value="82" class="greenCircle" />
                                </div>

                                <div class="circular-item tipB" title="Facturados">
                                    <span class="icon icomoon-icon-coins"></span>
                                    <input type="text" value="32" class="redCircle" />
                                </div>

                                <div class="circular-item tipB" title="Pendientes">
                                    <span class="icon icomoon-icon-clock"></span>
                                    <input type="text" value="47" class="orangeCircle" />
                                </div>
                                
                                <div class="circular-item tipB" title="Anulados">
                                    <span class="icon icomoon-icon-recycle"></span>
                                    <input type="text" value="16" class="greenCircle" />
                                </div>

                            </div>
                        </div>

                    </div><!-- End .span4 -->

                </div><!-- End .row-fluid -->

                <div class="row-fluid">

                    <div class="span8">
                        <div class="box chart gradient">
                            <div class="title">
                                <h4>
                                    <span class="icon16 icomoon-icon-bars"></span>
                                    <span>Citas Mensuales</span>
                                </h4>
                                <a href="#" class="minimize">Minimizar</a>
                            </div>
                            <div class="content" style="padding-bottom:0;">
                               <div class="visitors-chart" style="height: 230px;width:100%;margin-top:15px; margin-bottom:15px;"></div>
                               <ul class="chartShortcuts">
                                    <li>
                                        <a href="#">
                                            <span class="head">Citas Totales</span>
                                            <span class="number">509</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="head">Citas Asistidas</span>
                                            <span class="number">309</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="head">Citas Anuladas</span>
                                            <span class="number">109</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="head">Citas Pendientes</span>
                                            <span class="number">325</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- End .box -->
                    </div><!-- End .span8 -->


                    <div class="span4">
                        <div class="box gradient">
                            <div class="title">
                                <h4>
                                    <span class="icon16 icomoon-icon-pie"></span>
                                    <span>Citas x Asesor</span>
                                </h4>
                                <a href="#" class="minimize">Minimizar</a>
                            </div>
                            <div class="content">
                               <div class="pieStats" style="height: 390px; width:100%;"></div>
                            </div>
                        </div><!-- End .box -->                     
                    </div><!-- End .span4 -->

                </div><!-- End .row-fluid -->

                <div class="row-fluid">

                	<div class="span4">
                        <div class="reminder">
                            <h4>Metas Programadas</h4>
                            <ul>
                                <li class="clearfix">
                                    <div class="icon">
                                        <span class="icon32 icomoon-icon-basket gray"></span>
                                    </div>
                                    <span class="number">70</span> 
                                    <span class="txt">Nuevas Citas</span>
                                    <a class="btn btn-warning">ver</a>
                                </li>
                                <li class="clearfix">
                                    <div class="icon">
                                        <span class="icon32 icomoon-icon-support red"></span>
                                    </div>
                                    <span class="number">30</span> 
                                    <span class="txt">Cambios de Plan</span>
                                    <a class="btn btn-warning">ver</a>
                                </li>
                                <li class="clearfix">
                                    <div class="icon">
                                        <span class="icon32 icomoon-icon-new green"></span>
                                    </div>
                                    <span class="number">15</span> 
                                    <span class="txt">Nuevos Pacientes</span>
                                    <a class="btn btn-warning">ver</a>
                                </li>
                                <li class="clearfix">
                                    <div class="icon">
                                        <span class="icon32 icomoon-icon-comments-4 blue"></span>
                                    </div>
                                    <span class="number">23</span> 
                                    <span class="txt">Seguimientos</span> 
                                    <a class="btn btn-warning">ver</a>
                                </li>
                                <li class="clearfix">
                                    <div class="icon">
                                        <span class="icon32 icomoon-icon-cog dark"></span>
                                    </div>
                                    <span class="number">20</span> 
                                    <span class="txt">Ampliaciones de Portafolio</span>
                                    <a class="btn btn-warning">ver</a>
                                </li>                                   
                            </ul>
                        </div><!-- End .reminder -->
                    </div><!-- End .span4 -->
                    
                    <div class="span4">
                        <div class="todo">
                            <h4>Actividades <a href="#" class="icon tip" title="Adicionar actividad><span class="icon16 icomoon-icon-plus-2"></span></a></h4>
                            <ul>
                                <li class="clearfix">
                                    <div class="txt">
                                        Seguimiento a la cita 102030 de...
                                        <span class="by label">luis.moreno</span>
                                        <span class="date badge badge-important">Today</span>
                                    </div>
                                    <div class="controls">
                                        <a href="#" title="Realizar actividad" class="tip"><span class="icon12 icomoon-icon-paper-plane"></span></a>
                                        <a href="#" title="Cambiar estado" class="tip"><span class="icon12 icomoon-icon-switch"></span></a>
                                    </div>
                                </li>
                                <li class="clearfix">
                                    <div class="txt">
                                        Verificar citas
                                        <span class="by label">juan.gaviria</span>
                                        <span class="date badge badge-success">Ma&ntilde;ana</span>
                                    </div>
                                    <div class="controls">
                                        <a href="#" title="Realizar actividad" class="tip"><span class="icon12 icomoon-icon-paper-plane"></span></a>
                                        <a href="#" title="Cambiar estado" class="tip"><span class="icon12 icomoon-icon-switch"></span></a>
                                    </div>
                                </li>
                                <li class="clearfix">
                                    <div class="txt">
                                        Seguimiento a la cita 349845 de...
                                        <span class="by label">martha.perez</span>
                                        <span class="date badge badge-success">Ma&ntilde;ana</span>
                                    </div>
                                    <div class="controls">
                                        <a href="#" title="Realizar actividad" class="tip"><span class="icon12 icomoon-icon-paper-plane"></span></a>
                                        <a href="#" title="Cambiar estado" class="tip"><span class="icon12 icomoon-icon-switch"></span></a>
                                    </div>
                                </li>
                                <li class="clearfix">
                                    <div class="txt">
                                        Control de pacientes
                                        <span class="by label">luis.moreno</span>
                                        <span class="date badge badge-info">18.01.2013</span>
                                    </div>
                                    <div class="controls">
                                        <a href="#" title="Realizar actividad" class="tip"><span class="icon12 icomoon-icon-paper-plane"></span></a>
                                        <a href="#" title="Cambiar estado" class="tip"><span class="icon12 icomoon-icon-switch"></span></a>
                                    </div>
                                </li>
                                <li class="clearfix">
                                    <div class="txt">
                                        Copia de seguridad del sistema
                                        <span class="by label">Steve</span>
                                        <span class="date badge badge-info">08.02.2013</span>
                                    </div>
                                    <div class="controls">
                                        <a href="#" title="Realizar actividad" class="tip"><span class="icon12 icomoon-icon-paper-plane"></span></a>
                                        <a href="#" title="Cambiar estado" class="tip"><span class="icon12 icomoon-icon-switch"></span></a>
                                    </div>
                                </li>
                            </ul>
                        </div>

                    </div><!-- End .span4 -->

                    <div class="span4">
                        <div class="box gradient">
                            <div class="title">
                                <h4>
                                    <span class="icon16 icomoon-icon-comments-15"></span>
                                    <span>Chat Interno</span><span class="notification">Pr&oacute;ximamente</span>
                                </h4>
                            </div>
                            <div class="content noPad">

                                <ul class="messages">
                                    <li class="user clearfix">
                                        <a href="#" class="avatar">
                                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/avatar2.jpeg" alt="" />
                                        </a>
                                        <div class="message">
                                            <div class="head clearfix">
                                                <span class="name"><strong>juan.gaviria</strong> dice:</span>
                                                <span class="time">hace 25 segundos</span>
                                            </div>
                                            <p>
                                                Me tengo que ir, hablamos ma&ntilde;ana.
                                            </p>
                                        </div>
                                    </li>
                                    <li class="admin clearfix">
                                        <a href="#" class="avatar">
                                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/avatar3.jpeg" alt="" />
                                        </a>
                                        <div class="message">
                                            <div class="head clearfix">
                                                <span class="name"><strong>luis.moreno</strong> dice:</span>
                                                <span class="time">hace 1 segundo</span>
                                            </div>
                                            <p>
                                                OK, que tengas un buen d&iacute;a.
                                            </p>
                                        </div>
                                    </li>

                                    <li class="sendMsg">
                                        <form class="form-horizontal" action="#">
                                            <textarea class="elastic" id="textarea" rows="1" placeholder="Ingrese su mensaje ..." style="width:98%;"></textarea>
                                            <button type="submit" class="btn btn-info marginT10">Enviar Mensaje</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- End .box -->
                    </div><!-- End .span4 -->

                </div><!-- End .row-fluid -->

                <div class="row-fluid">
                	<div class="span12">
                        <div class="box calendar gradient">
                            <div class="title">
                                <h4>
                                    <span class="icon16 icomoon-icon-calendar"></span>
                                    <span>Calendario</span>
                                </h4>
                                <!-- <a href="#" class="minimize">Minimize</a> -->
                            </div>
                            <div class="content noPad"> 
                                <div id="calendar">
                                </div>
                            </div>
                        </div><!-- End .box -->  
                    </div><!-- End .span8 --> 
                </div>
                
                <div class="modal fade hide" id="myModal1">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
                        <h3>Chat layout</h3>
                    </div>
                    <div class="modal-body">
                        <ul class="messages">
                            <li class="user clearfix">
                                <a href="#" class="avatar">
                                    <img src="images/avatar2.jpeg" alt="" />
                                </a>
                                <div class="message">
                                    <div class="head clearfix">
                                        <span class="name"><strong>Lazar</strong> says:</span>
                                        <span class="time">25 seconds ago</span>
                                    </div>
                                    <p>
                                        Time to go i call you tomorrow.
                                    </p>
                                </div>
                            </li>
                            <li class="admin clearfix">
                                <a href="#" class="avatar">
                                    <img src="images/avatar3.jpeg" alt="" />
                                </a>
                                <div class="message">
                                    <div class="head clearfix">
                                        <span class="name"><strong>Sugge</strong> says:</span>
                                        <span class="time">just now</span>
                                    </div>
                                    <p>
                                        OK, have a nice day.
                                    </p>
                                </div>
                            </li>

                            <li class="sendMsg">
                                <form class="form-horizontal" action="#">
                                    <textarea class="elastic" id="textarea1" rows="1" placeholder="Enter your message ..." style="width:98%;"></textarea>
                                    <button type="submit" class="btn btn-info marginT10">Send message</button>
                                </form>
                            </li>
                            
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn" data-dismiss="modal">Close</a>
                    </div>
                </div>
