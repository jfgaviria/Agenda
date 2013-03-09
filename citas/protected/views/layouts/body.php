<!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">
                    <h3><?php echo CHtml::encode($this->pageTitle); ?></h3>

<!--                     <div class="resBtnSearch"> -->
<!--                         <a href="#"><span class="icon16 icomoon-icon-search-3"></span></a> -->
<!--                     </div> -->
                    <!-- 
                    <div class="search">
                        <form id="searchform" action="search.html">
                            <input type="text" id="tipue_search_input" class="top-search" placeholder="Search here ..." />
                            <input type="submit" id="tipue_search_button" class="search-btn" value=""/>
                        </form>
                    </div>
                    --><!-- End search -->
                    
                    <?php 
                    	$divider = '<span class="divider"><span class="icon16 icomoon-icon-arrow-right-2"></span></span>';
                    ?>
                    <ul class="breadcrumb">
                        <li>Usted est&aacute; aqu&iacute;:</li>
                        <li>
                            <a href="#" class="tip" title="Regresar al Panel de Control">
                                <span class="icon16 icomoon-icon-screen-2"></span>
                            </a> 
                            <?php echo $divider; ?>
                        </li>
                        <?php 
//                         	echo '<li>' . implode('</li>'.$divider.'<li class="active">', $this->breadcrumbs) . '</li>';
                        ?>
                    </ul>

                </div><!-- End .heading-->
                
                <?php echo $content; ?>
                
            </div><!-- End contentwrapper -->
        </div><!-- End #content -->                