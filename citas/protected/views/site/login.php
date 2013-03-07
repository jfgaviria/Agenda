    <div class="container-fluid">
        <div id="header">
            <div class="row-fluid">
                <div class="navbar">
                    <div class="navbar-inner">
                      <div class="container">
                            <a class="brand" href="<?php echo CController::createUrl('/'); ?>">Comprotel <span class="slogan">CRM</span></a>
                      </div>
                    </div><!-- /navbar-inner -->
                  </div><!-- /navbar -->
            </div><!-- End .row-fluid -->
        </div><!-- End #header -->
    </div><!-- End .container-fluid -->

    <div class="container-fluid">
        <div class="loginContainer">
    		<?php $model = new UserLogin; ?>
			<?php echo CHtml::beginForm('', 'post', array("id"=>"loginForm", "class"=>"form-horizontal")); ?>
			 	<div class="form-row row-fluid">
                    <div class="span12">
                        <div class="row-fluid">
                        	<?php echo CHtml::label(UserModule::t('username').'<span class="icon16 icomoon-icon-user-3 right gray marginR10"></span>', 'username', array('class'=>'form-label span12')); ?>	 
							<?php echo CHtml::activeTextField($model,'username',array('id'=>'login', 'class'=>'span12', 'tabindex'=>'1', 'minlength'=>'1', 'autocomplete'=>'off')); ?>
						</div>
					</div>
				</div>
				<div class="form-row row-fluid">
                    <div class="span12">
                        <div class="row-fluid">
                        	<?php echo CHtml::label(UserModule::t('password')
                        			.'<span class="icon16 icomoon-icon-locked right gray marginR10"></span>'
                        			.'<span class="forgot">'. CHtml::link(UserModule::t("Lost Password?"),Yii::app()->getModule('user')->recoveryUrl) .'</span>', 
                        			'password', array('class'=>'form-label span12')); ?>
							<?php echo CHtml::activePasswordField($model,'password',array('id'=>'pass', 'class'=>'span12', 'tabindex'=>'2', 'autocomplete'=>'off')); ?>
						</div>
					</div>
				</div>
				<div class="form-row row-fluid">                       
                    <div class="span12">
                        <div class="row-fluid">
                            <div class="form-actions">
                            <div class="span12 controls">
                            	<?php echo CHtml::activeCheckBox($model,'rememberMe',array('id'=>'rememberMe', 'class'=>'styled', 'title'=>'Habilitar ingreso automatico')); ?>
                 				<?php echo UserModule::t('Remember me next time'); ?>
                 				<?php echo CHtml::htmlButton('<span class="icon16 icomoon-icon-enter white"></span>'.UserModule::t("Login"),array('type'=>'submit', 'class'=>'btn btn-info righ')); ?>
                            </div>
                            </div>
                        </div>
                    </div> 
                </div>
    		<?php echo CHtml::endForm(); ?>

<?php
$form = new CForm(array(
    'elements'=>array(
        'username'=>array(
            'type'=>'text',
            'maxlength'=>32,
        ),
        'password'=>array(
            'type'=>'password',
            'maxlength'=>32,
        ),
        'rememberMe'=>array(
            'type'=>'checkbox',
        )
    ),

    'buttons'=>array(
        'login'=>array(
            'type'=>'submit',
            'label'=>'Login',
        ),
    ),
), $model);
?>
	<!-- JavaScript at bottom except for Modernizr -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/libs/modernizr.custom.js"></script>
	
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/setup.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/developr.message.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/developr.notify.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/developr.tooltip.js"></script>
	
	<script>

		/*
		 * How do I hook my login script to this?
		 * --------------------------------------
		 *
		 * This script is meant to be non-obtrusive: if the user has disabled javascript or if an error occurs, the login form
		 * works fine without ajax.
		 *
		 * The only part you need to edit is the login script between the EDIT SECTION tags, which does inputs validation
		 * and send data to server. For instance, you may keep the validation and add an AJAX call to the server with the
		 * credentials, then redirect to the dashboard or display an error depending on server return.
		 *
		 * Or if you don't trust AJAX calls, just remove the event.preventDefault() part and let the form be submitted.
		 */

		$(document).ready(function()
		{
			/*
			 * JS login effect
			 * This script will enable effects for the login page
			 */
				// Elements
			var doc = $('html').addClass('js-login'),
				container = $('#container'),
				formLogin = $('#loginForm'),

				// If layout is centered
				centered;

			/******* EDIT THIS SECTION *******/

			/*
			 * AJAX login
			 * This function will handle the login process through AJAX
			 */
			formLogin.submit(function(event)
			{
				// Values
				var login = $.trim($('#login').val()),
					pass = $.trim($('#pass').val());

				// Check inputs
				if (login.length === 0)
				{
					// Display message
					displayError('Por favor ingrese su Nombre de Usuario');
					return false;
				}
				else if (pass.length === 0)
				{
					// Remove empty login message if displayed
					formLogin.clearMessages('Por favor ingrese su Nombre de Usuario');

					// Display message
					displayError('Por favor ingrese su Contrase&ntilde;a');
					return false;
				}
				else
				{
					// Remove previous messages
					formLogin.clearMessages();

					// Show progress
					displayLoading('Validando credenciales...');
					event.preventDefault();

					// Stop normal behavior
					event.preventDefault();


					//This is where you may do your AJAX call, for instance:
					var postData = [
						{ username: login, password: pass, rememberMe: $('#rememberMe').is(':checked') ? $('#rememberMe').val() : '0' }
					];
					$.post(formLogin.attr('action'),{
						UserLogin: postData
					},function(response){
						var data = $.parseJSON(response);

						if(data.logged){
							var urlRedirect = data.logged;
							window.location = urlRedirect;
						}else{
							formLogin.clearMessages();
							displayError(data.error);
						}
					});
				}
			});

			/******* END OF EDIT SECTION *******/

			// Handle resizing (mostly for debugging)
			function handleLoginResize()
			{
				// Detect mode
				centered = (container.css('position') === 'absolute');

				// Set min-height for mobile layout
				if (!centered)
				{
					container.css('margin-top', '');
				}
				else
				{
					if (parseInt(container.css('margin-top'), 10) === 0)
					{
						centerForm(false);
					}
				}
			};

			// Register and first call
			$(window).bind('normalized-resize', handleLoginResize);
			handleLoginResize();

			/*
			 * Center function
			 * @param boolean animate whether or not to animate the position change
			 * @param string|element|array any jQuery selector, DOM element or set of DOM elements which should be ignored
			 * @return void
			 */
			function centerForm(animate, ignore)
			{
				// If layout is centered
				if (centered)
				{
					var siblings = formLogin.siblings(),
						finalSize = formLogin.outerHeight();

					// Ignored elements
					if (ignore)
					{
						siblings = siblings.not(ignore);
					}

					// Get other elements height
					siblings.each(function(i)
					{
						finalSize += $(this).outerHeight(true);
					});

					// Setup
					container[animate ? 'animate' : 'css']({ marginTop: -Math.round(finalSize/2)+'px' });
				}
			};

			// Initial vertical adjust
			centerForm(false);

			/**
			 * Function to display error messages
			 * @param string message the error to display
			 */
			function displayError(message)
			{
				// Show message
				var message = formLogin.message(message, {
					append: false,
					arrow: 'bottom',
					node: 'div',
					classes: ['red-gradient'],
					animate: false					// We'll do animation later, we need to know the message height first
				});

				// Vertical centering (where we need the message height)
				centerForm(true, 'fast');

				// Watch for closing and show with effect
				message.bind('endfade', function(event)
				{
					// This will be called once the message has faded away and is removed
					centerForm(true, message.get(0));

				}).hide().slideDown('fast');
			}

			/**
			 * Function to display loading messages
			 * @param string message the message to display
			 */
			function displayLoading(message)
			{
				// Show message
				var message = formLogin.message('<strong>'+message+'</strong>', {
					append: false,
					arrow: 'bottom',
					classes: ['blue-gradient', 'align-center'],
					stripes: true,
					darkStripes: false,
					closable: false,
					animate: false					// We'll do animation later, we need to know the message height first
				});

				// Vertical centering (where we need the message height)
				centerForm(true, 'fast');

				// Watch for closing and show with effect
				message.bind('endfade', function(event)
				{
					// This will be called once the message has faded away and is removed
					centerForm(true, message.get(0));

				}).hide().slideDown('fast');
			}
		});
	</script>
		</div>
	</div>