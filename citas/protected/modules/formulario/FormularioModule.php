<?php
/**
 * Formulario module
 * 
 * @author Juan Fernando Gaviria <juan.gaviria@sevensense.co> 
 * @link http://www.sevensense.co/
 * @license http://www.opensource.org/licenses/bsd-license.php
 * @version $Id: FormularioModule.php 123 2011-07-22 10:04:33Z juan.gaviria $
 */

class FormularioModule extends CWebModule 
{
	/**
	 * @var text
	 * @desc Clase para el Formulario
	 */
	public $formCssClass = "";
	
	/**
	 * @var text
	 * @desc Tag para enmarcar el campo y su label
	 */
	public $formEnclosureRowTag = "div";
	
	/**
	 * @var text
	 * @desc Tag para enmarcar el campo y su label
	 */
	public $formEnclosureSubRowTag = '';
	
	/**
	 * @var text
	 * @desc Clase para cada fila del formulario
	 */
	public $formRowCssClass = "field-block button-height";
	
	/**
	 * @var text
	 * @desc Clase para cada fila del formulario
	 */
	public $formSubRowCssClass = '';
	
	/**
	 * @var text
	 * @desc Tag para enmarcar el campo
	 */
	public $formEnclosureFieldTag = null;
	
	/**
	 * @var text
	 * @desc Clase para cada fila del formulario
	 */
	public $formEnclosureFieldTagCssClass = "form-item";
	
	/**
	 * @var text
	 * @desc Clase para el contenedor de informaci�n de cada campo
	 */
	public $formInfoInputCssClass = 'input-info';
	
	/**
	 * @var text
	 * @desc Clase para el contenedor de informaci�n de cada label de campo
	 */
	public $formLabelCssClass = 'label';
	
	/**
	 * @var text
	 * @desc Clase para el contenedor de cada campo de texto
	 */
	public $formInputCssClass = 'input';
	
	/**
	 * @var text
	 * @desc Clase para el contenedor de cada campo select
	 */
	public $formSelectCssClass = 'select';
	
	/**
	 * @var text
	 * @desc Clase para el contenedor de cada campo switch
	 */
	public $formSwitchCssClass = 'switch';
	
	/**
	 * @var text
	 * @desc Tag para enmarcar los botones
	 */
	public $formEnclosureRowButtonsTag = '';
	
	/**
	 * @var text
	 * @desc Clase para el contenedor de botones
	 */
	public $formRowButtonsCssClass = '';
	
	/**
	 * @var text
	 * @desc Tag para enmarcar los botones
	 */
	public $formEnclosureSubRowButtonsTag = '';
	
	/**
	 * @var text
	 * @desc Clase para el contenedor de botones
	 */
	public $formSubRowButtonsCssClass = '';
	
	/**
	 * @var text
	 * @desc Clase para el boton submit
	 */
	public $formSubmitCssClass ='button glossy mid-margin-right';
	
	/**
	 * @var text
	 * @desc Clase para el boton cancel
	 */
	public $formCancelCssClass = 'button glossy';
	
	/**
	 * @var text
	 * @desc Label para el boton submit
	 */
	public $formSubmitLabel = 'Guardar';
	
	/**
	 * @var text
	 * @desc Label para el boton cancel
	 */
	public $formCancelLabel = 'Cancelar';
	
	/**
	 * @var {@link CActiveForm}
	 * @desc Definicion del Formulario
	 */
	static private $_form = null;
	
	/**
	 * @var {@link Controller}
	 * @desc Controlador
	 */
	static private $_this = null;

	
	/**
	 * @see CModule::init()
	 */
    public function init()
    {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application

        // import the module-level models and components
        $this->setImport(array(
            'formulario.models.*',
            'formulario.components.*',
        ));
    }

    /**
     * @see CWebModule::beforeControllerAction()
     */
    public function beforeControllerAction($controller, $action)
    {
        if(parent::beforeControllerAction($controller, $action))
        {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        }
        else
            return false;
    }
	
    /**
     * Inicializa el Widget para el Formulario
     * @param string $formId El ID para el Formulario
     * @param Controller $_this El Controlador
     * @see Controller
     */
    public static function beginForm($formId, $_this){
    	echo CHtml::tag('div', array('id'=>'ajax_loader', 'style'=>'display: none;'), CHtml::image(Yii::app()->request->baseUrl.'/images/spinner.gif', 'Cargando'));
    	
    	self::$_this = $_this;
    	self::$_form = $_this->beginWidget('CActiveForm', array(
					'id'=>$formId,
					'enableAjaxValidation'=>false,
					'enableClientValidation'=>true,
					'clientOptions'=>array(
						'validateOnSubmit'=>true,
						'validateOnChange'=>false
					),
					'htmlOptions' => array('enctype'=>'multipart/form-data', 'class'=>Yii::app()->getModule('formulario')->formCssClass),
				));
    }
    
    /**
     * Finaliza el Widget para el Formulario
     */
    public static function endForm(){
    	self::$_this->endWidget();
    }

    /**
     * Crea un Widget para mostrar Dialogos Modales para el Formulario
     * @param string $id
     * @param string $title
     * @param array $botones
     * @param boolean $autoOpen
     * @param boolean $modal
     * @param mixed $width Puede ser un valor numerico o 'auto'
     * @param mixed $height Puede ser un valor numerico o 'auto'
     */
    private static function wDialog($id, $title, $botones = array(), $autoOpen = false, $modal = true, $width = 550, $height = 'auto'){
    	self::$_this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    		'id'=>$id,
    		'options'=>array(
    			'title'=>$title,
    			'autoOpen'=>$autoOpen,
    			'modal'=>$modal,
    			'width'=>$width,
    			'height'=>$height,
    			'buttons' => count($botones) > 0 ? $botones : array('Cerrar'=>'js:function(){$(this).dialog("close")}')
    		),
    	));
    	
    	echo '<div class="divAlerta"></div>';
    	
    	self::$_this->endWidget('zii.widgets.jui.CJuiDialog');
    }
    
	/**
	 * Crea cada campo de un Formulario con todas las clases y parametros necesarios, 
	 * ademas de las validaciones creadas desde el modelo {@link CActiveRecord}
	 * @name setFormField
	 * @param CActiveRecord model La clase de modelo para la cual se va a generar el campo
	 * @param string field El nombre del campo a generar
	 * @param string type El tipo del campo a generar
	 * @param array data Datos para los combos de seleccion
	 * @param array htmlParams Par�metros HTML adicionales
	 * @return CHtml El campo con sus validaciones y estilos
	 * @see CActiveRecord
	 * @see CHtml
	 */
	public function setFormField($model, $field, $type, $data = null, $htmlParams = array()){
		// Parametros HTML
		$prompt				= isset($htmlParams['prompt']) ? $htmlParams['prompt'] : 'Seleccione...';
		$size 				= isset($htmlParams['size']) ? $htmlParams['size'] : 'auto';
		$maxlength 			= isset($htmlParams['maxlength']) ? $htmlParams['maxlength'] : 'auto';
		$target_url 		= isset($htmlParams['target_url']) ? $htmlParams['target_url'] : '';
		$target_field_id 	= isset($htmlParams['target_field_id']) ? $htmlParams['target_field_id'] : '';
		$js_success			= isset($htmlParams['js_success']) ? $htmlParams['js_success'] : null;
		$checked 			= isset($htmlParams['checked']) ? $htmlParams['checked'] : '';
		$data_text_on 		= isset($htmlParams['data-text-on']) ? $htmlParams['data-text-on'] : '';
		$data_text_off		= isset($htmlParams['data-text-off']) ? $htmlParams['data-text-off'] : '';
		$submitLabel 		= isset($htmlParams['submitLabel']) && $htmlParams['submitLabel'] != '' ? $htmlParams['submitLabel'] : Yii::app()->getModule('formulario')->formSubmitLabel;
		$cancelLabel 		= isset($htmlParams['cancelLabel']) && $htmlParams['cancelLabel'] != '' ? $htmlParams['submitLabel'] : Yii::app()->getModule('formulario')->formCancelLabel;
		
		// ID del campo
		$fieldId = isset($htmlParams['fieldId']) && $htmlParams['fieldId'] != '' ? $htmlParams['fieldId'] : $field;
		
		// Clases adicionales para los campos
		$fieldClass = '';
		if(isset($htmlParams['fieldClass'])){
			$fieldClass = ' ' . $htmlParams['fieldClass'];
		}
		
		// Inicio del contenedor de las filas
		$html = '';
		if($type != 'hidden'){
			$html = CHtml::tag(Yii::app()->getModule('formulario')->formEnclosureRowTag, array('class'=>Yii::app()->getModule('formulario')->formRowCssClass), false, false);
			if(Yii::app()->getModule('formulario')->formEnclosureSubRowTag != ''){
				$html .= CHtml::tag(Yii::app()->getModule('formulario')->formEnclosureSubRowTag, array('class'=>Yii::app()->getModule('formulario')->formSubRowCssClass), false, false);
			}
		}

		// Inicio del contenedor del campo
		$html .= !is_null(Yii::app()->getModule('formulario')->formEnclosureFieldTag) ? CHtml::tag(Yii::app()->getModule('formulario')->formEnclosureFieldTag, array('class'=>Yii::app()->getModule('formulario')->formEnclosureFieldTagCssClass), false, false) : '';
		
		// Definici�n del label siempre y cuando
		$exepciones = array('hidden', 'defaultbuttons', 'submitbutton', 'ajaxsubmitbutton', 'htmlbutton', 'cancelbutton');
		$html .= !in_array($type, $exepciones) ? self::$_form->labelEx($model, $field, array('class'=>Yii::app()->getModule('formulario')->formLabelCssClass)) : '';
		
		// Definici�n del texto de ayuda
		$info = '';
		if(isset($htmlParams['info']) && $htmlParams['info'] != ''){
			$info = CHtml::tag('small', array('class'=>Yii::app()->getModule('formulario')->formInfoInputCssClass), $htmlParams['info']);
		}
		$htmlParams['infoPosition'] = !isset($htmlParams['infoPosition']) ? 'bottom' : $htmlParams['infoPosition'];
		// Texto de ayuda encima del campo
		if(isset($htmlParams['infoPosition']) && $htmlParams['infoPosition'] == 'top'){
			$html .= $info;
		}
		
		// Clases CSS para la validacion de los campos
		$validationCss = array();
		if(FormularioModule::isRequired($model, $field)){
			$validationCss[] = 'required';
		}
		
		// Parametros HTML adicionales para el campo
		$htmlParams['fieldHtmlParams'] = isset($htmlParams['fieldHtmlParams']) ? $htmlParams['fieldHtmlParams'] : array();
		
        switch (strtolower($type)){
        	case 'hidden':
        		$html .= self::$_form->hiddenField($model, $field, array('id'=>$fieldId, 'value'=>!is_null($data) ? $data : ''));
        		break;
        		
        	case 'textfield':
        	case 'emailfield':
        	case 'timefield':
        		$fieldHtmlParams = array_merge(array('id'=>$fieldId, 'class'=>Yii::app()->getModule('formulario')->formInputCssClass . $fieldClass . ' validate['.implode(',', $validationCss).']', 'size'=>$size, 'maxlength'=>$maxlength), $htmlParams['fieldHtmlParams']);
        		if($type == 'emailfield')
        			$validationCss[] = 'custom[email]';
        		if($type == 'timefield')
        			$fieldHtmlParams['class'] .= ' timepicker';
        		$html .= self::$_form->textField($model, $field, $fieldHtmlParams);
        		break;
        		
        	case 'passwordfield':
        		$html .= self::$_form->passwordField($model, $field, array('id'=>$field, 'class'=>Yii::app()->getModule('formulario')->formInputCssClass . $fieldClass . ' validate['.implode(',', $validationCss).']', 'size'=>$size, 'maxlength'=>$maxlength, 'data-confirm'=>'true', 'data-show-strength'=>true, 'data-min-length'=>'5'));
        		break;        
        				
        	case 'dropdownlist':
        		$fieldHtmlParams = array_merge(array('id'=>$fieldId, 'prompt'=>$prompt, 'class'=>Yii::app()->getModule('formulario')->formSelectCssClass . $fieldClass . ' validate['.implode(',', $validationCss).']'), $htmlParams['fieldHtmlParams']);
        		$html .= self::$_form->dropDownList($model, $field, $data, $fieldHtmlParams);
        		break;
        		
        	case 'dropdownlist2':
        		$fieldHtmlParams = array_merge(array('id'=>$fieldId, 'class'=>Yii::app()->getModule('formulario')->formSelectCssClass . $fieldClass . ' validate['.implode(',', $validationCss).']'), $htmlParams['fieldHtmlParams']);
        		$html .= self::$_this->widget('ext.select2.ESelect2', array(
        				'model'=>$model,
        				'attribute'=>$field,
        				'data'=>$data,
        				'htmlOptions'=>$fieldHtmlParams,
        				'options'=>array(
        						'placeholder'=>$prompt,
        						'allowClear'=>true,
        				),
        		), true);
        		break;
        		
        	case 'dropdowndep':
        		$html .= self::$_form->dropDownList($model, $field, $data, array('id'=>$fieldId, 'prompt'=>$prompt, 'class'=>Yii::app()->getModule('formulario')->formSelectCssClass . $fieldClass . ' validate['.implode(',', $validationCss).']', 
        						'ajax'=>array(
        							'type'=>'POST', 
        							'url'=>$target_url, 
        							'success'=>'function(data){
        								$("#ajax_loader").hide();
        								$("#'.$target_field_id.'").html(data)
        								'.$js_success.'
        							}',
		        					'beforeSend'=>'function(){
	        							$("#ajax_loader").fadeIn();
	        						}',
        						)
        				));
        		break;
        		
			case 'checkbox':
        		$html .= self::$_form->checkBox($model, $field, array('id'=>$field, 'value'=>$data, 'uncheckValue'=>'0', 'class'=>$fieldClass . ' validate['.implode(',', $validationCss).']', 'checkedLabel'=>$data_text_on, 'uncheckedLabel'=>$data_text_off));
        		break;
        		
        	case 'switch':
        		$html .= self::$_form->checkBox($model, $field, array('id'=>$fieldId, 'value'=>$data, 'class'=>Yii::app()->getModule('formulario')->formSwitchCssClass . $fieldClass, 'checked'=>$checked, 'data-text-on'=>$data_text_on, 'data-text-off'=>$data_text_off));
        		break;
        		
        	case 'datefield':
        		$fieldHtmlParams = array_merge(array('id'=>$fieldId, 'style'=>'vertical-align:top', 'class'=>Yii::app()->getModule('formulario')->formInputCssClass . $fieldClass . ' validate['.implode(',', $validationCss).']', 'size'=>$size, 'maxlength'=>$maxlength), $htmlParams['fieldHtmlParams']);
        		$html .= self::$_this->widget('zii.widgets.jui.CJuiDatePicker', array(
								'model'=>$model,
								'attribute'=>$field,
								'language'=>Yii::app()->language=='es' ? 'es' : null,
								'options'=>array(
										'changeMonth'=>'true',
										'changeYear'=>'true',
										'yearRange' => '-99:+2',
										'showAnim'=>isset($htmlParams['dateAnim']) ? $htmlParams['dateAnim'] : 'show', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
										'showOn'=>'focus', // 'focus', 'button', 'both'
										'dateFormat'=>isset($htmlParams['dateFormat']) ? $htmlParams['dateFormat'] : 'yy-mm-dd',
										'value'=>date('Y-m-d H:i:s'),
										'theme'=>'redmond',
// 										'buttonText'=>Yii::t('ui','Select form calendar'),
// 										'buttonImage'=>Yii::app()->request->baseUrl.'/images/calendar.gif',
// 										'buttonImageOnly'=>true,
								),
								'htmlOptions'=>$fieldHtmlParams,
						), true);
        		break;
        		
        	case 'defaultbuttons':
        	case 'ajaxsubmitbutton':
        	case 'cancelbutton':
        		if(Yii::app()->getModule('formulario')->formEnclosureRowButtonsTag != ''){
        			$html .= CHtml::tag(Yii::app()->getModule('formulario')->formEnclosureRowButtonsTag, array('class'=>Yii::app()->getModule('formulario')->formRowButtonsCssClass), false, false);
        		}
        		if(Yii::app()->getModule('formulario')->formEnclosureSubRowButtonsTag != ''){
        			$html .= CHtml::tag(Yii::app()->getModule('formulario')->formEnclosureSubRowButtonsTag, array('class'=>Yii::app()->getModule('formulario')->formSubRowButtonsCssClass), false, false);
        		}
        		if($type == 'ajaxsubmitbutton' || $type == 'defaultbuttons'){
	        		$html .= CHtml::ajaxSubmitButton($submitLabel, CHtml::normalizeUrl($data), array(
								'dataType'=>'json',
								'type'=>'post',
	        					'error'=>'function(){
        							if(data.error && data.error != ""){
										alerta("Atenci&oacute;n", data.error,{
											Cerrar: function() { $( this ).dialog( "close" ); }
										});
									}
        						}',
								'success'=>'function(data){
	        						$("#ajax_loader").hide();
									if(data.error && data.error != ""){
	        							'.self::wDialog('error', 'Error').'
	        							$("#error div.divAlerta").html(data.error);
	        							$("#error").dialog("open"); return false;
									}else{
	        							'.self::wDialog('mensaje', 'Atencion', array('Aceptar'=>'js:function(){$(this).dialog("close"); window.location.href = document.location.href + \''. (isset($_REQUEST['op']) && !strstr($_SERVER['QUERY_STRING'], "op") ? "?op=".$_REQUEST['op'] : "") .'\'; }') ).'
	        							$("#mensaje div.divAlerta").html(data.mensaje);
	        							$("#mensaje").dialog("open"); return false;
									}
								}',
	        					'beforeSend'=>'function(){
        							$("#ajax_loader").fadeIn();
        						}',
							),
							array('id'=>$field.'_submit', 'class'=>Yii::app()->getModule('formulario')->formSubmitCssClass . $fieldClass)
							);
        		}
				if($type == 'cancelbutton' || $type == 'defaultbuttons'){
        			$html .= CHtml::htmlButton($cancelLabel, array('id'=>$field.'_cancel', 'class'=>Yii::app()->getModule('formulario')->formCancelCssClass . $fieldClass));
				}
				if(Yii::app()->getModule('formulario')->formEnclosureRowButtonsTag != ''){
					$html .= CHtml::closeTag(Yii::app()->getModule('formulario')->formEnclosureRowButtonsTag);
				}
				if(Yii::app()->getModule('formulario')->formEnclosureSubRowButtonsTag != ''){
					$html .= CHtml::closeTag(Yii::app()->getModule('formulario')->formEnclosureSubRowButtonsTag);
				}
        		break;
        		
        	case 'submitbutton':
        	case 'htmlbutton':
        		if($type == 'submitbutton')
        			$tipo = 'submit';
        		else
        			$tipo = 'button';
        		$html .= CHtml::htmlButton($submitLabel, array('id'=>$field.'_submit', 'class'=>Yii::app()->getModule('formulario')->formSubmitCssClass . $fieldClass, 'type'=>$tipo));
        		break;
        		
        	case 'raw':
        		$html .= $data;
        		break;
        		
        }
        // Texto de ayuda debajo del campo
        if(isset($htmlParams['infoPosition']) && $htmlParams['infoPosition'] == 'bottom'){
        	$html .= $info;
        }
        // Cierre del contenedor del campo
        $html .= !is_null(Yii::app()->getModule('formulario')->formEnclosureFieldTag) ? CHtml::closeTag(Yii::app()->getModule('formulario')->formEnclosureFieldTag) : '';
		// Cierre del contenedor de la fila
        if($type != 'hidden'){
	        $html .= CHtml::closeTag(Yii::app()->getModule('formulario')->formEnclosureRowTag);
	        if(Yii::app()->getModule('formulario')->formEnclosureSubRowTag != ''){
	        	$html .= CHtml::closeTag(Yii::app()->getModule('formulario')->formEnclosureSubRowTag);
	        }
        }
        
        return $html;
	}
	
	/**
	 * Verifica si un campo es requerido
	 * @name isRequired
	 * @param CActiveRecord $model
	 * @param string $field
	 * @return boolean
	 * @see CActiveRecord
	 */
	private function isRequired( $model, $field ){
		$validators = $model->getValidators($field);
		foreach ($validators AS $validator){
			if($validator instanceof CRequiredValidator){
				return true;
			}
		}
		return false;
	}
	
	/**
	 * Renderiza automaticamente un formulario
	 * @name renderForm
	 * @param CActiveRecord $model
	 * @param array $hidden Atributos que van ocultos en el formulario
	 * @param array $exclude Atributos que no van en el formulario
	 * @param array $fieldParams Parametros adicionales para los campos
	 * @return array Arreglo con los campos del formulario
	 * @see CActiveRecord
	 */
	public function renderForm( $model, $hidden = array(), $exclude = array(), $fieldParams = array() ){
		$attributes = $model->getAttributes();
		$relations  = array_values($model->relations());
		$rules		= $model->rules();
		
		// Siempre el ID como hidden
		if(count($hidden) == 0){
			$hidden[0] = 'id';
		}
		
		// Excluir los parametros
		if(count($exclude) > 0){
			foreach($exclude AS $e){
				if(key_exists($e, $attributes))
					unset($attributes[$e]);
			}
		}

		$fields = array();
		foreach($attributes AS $attr=>$value){
			// DropDownList a partir de las relaciones
			for($i=0; $i<count($relations); $i++){
				$rel =& $relations[$i];
				
				if($attr == $rel[2]){
					// Si la clase enviada es User se instancia UserModule
					if($rel[1] == 'User'){
						Yii::import('application.modules.user.models.user');
					}
					$mData = new $rel[1]();
					// Si existen los parametros 'descripcioin' o 'nombre' se usaran estos
					// para la descripcion de las opciones del Select, de lo contrario se usara
					// el primer atributo de texto configurado en los rules del modelo
					if(key_exists('descripcion', $mData->getAttributes())){
						$textField = 'descripcion';
					}else if(key_exists('nombre', $mData->getAttributes())){
						$textField = 'nombre';
					}else{
						foreach($mData->rules() AS $r){
							if($r[1] == 'length'){
								$textField = $r[0];
								break;
							}
						}
					}
					$data = CHtml::listData($mData->findAll(), $mData->tableSchema->primaryKey, $textField);
					$fields[] = self::setFormField($model, $attr, 'dropdownlist', $data);
					continue 2;
				}
			}
			
			foreach($rules AS $r){
				if(strstr($r[0], $attr)){
					// Checkbox normales o estilo iPhone
					if($r[1] === 'boolean'){
						$checkbox = isset($fieldParams['checkbox']) ? $fieldParams['checkbox'] : 'checkbox';
						$fields[] = self::setFormField($model, $attr, $checkbox);
						continue 2;
					}
					// Campos de Fecha con selector
					if($r[1] === 'date'){
						$fields[] = self::setFormField($model, $attr, 'datefield');
						continue 2;
					}
				}
			}
			if(in_array($attr, $hidden)){
				$fields[] = self::setFormField($model, $attr, 'hidden');
			}else{
				$fields[] = self::setFormField($model, $attr, 'textfield');
			}
		}
		
		return $fields;
	}
	
	public static function getToken( $name ){
		$alphanum = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdfghijklmnopqrstuvwxyz0123456789";
		$token	  = md5(substr(md5(str_shuffle($alphanum)), 0, 10));
		$_SESSION["token_".$name] = $token;
		
		return $token;
	}
	
	
	public static function desencriptar($cadena,$name){
		$suma = 0;
		$newtexto = "";
	
		for($x=0; $x < strlen($_SESSION["token_".$name]); $x++){
			$suma += ord($_SESSION["token_".$name][$x]);
		}
			
		$semilla = "$suma";
		$suma = 0;
	
		for($z=0; $z < strlen($semilla); $z++){
			$suma += $semilla[$z];
		}
	
		$semilla = $suma;
	
		for($y=0; $y < strlen($cadena); $y++){
			if(ord($cadena[$y]) - $semilla > 31){
				$suma = (ord($cadena[$y]) - $semilla);
			}else{
				$suma = 126 - (31 - (ord($cadena[$y]) - $semilla));
			}
			$newtexto .= chr($suma);
		}
	
		return $newtexto;
	}

}