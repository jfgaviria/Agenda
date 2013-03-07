<?php

/**
 * This is the model class for table "{{asesor}}".
 *
 * The followings are the available columns in table '{{asesor}}':
 * @property integer $id
 * @property integer $id_usuario
 * @property integer $cod_fenix
 * @property integer $id_tipo_documento
 * @property string $documento
 * @property string $nombre
 * @property string $apellidos
 * @property integer $id_tipo_vinculacion
 * @property string $fe_vinculacion
 * @property string $fe_retiro
 * @property integer $id_estado_asesor
 * @property string $fe_estado
 *
 * The followings are the available model relations:
 * @property ActividadesAsesor[] $actividadesAsesors
 * @property AsesorEstado $idEstadoAsesor
 * @property TipoVinculacion $idTipoVinculacion
 * @property TipoDocumento $idTipoDocumento
 * @property User $idUsuario
 * @property Cliente[] $clientes
 * @property Comisiones[] $comisiones
 * @property CotizacionEncabezado[] $cotizacionEncabezados
 * @property PedidoEncabezado[] $pedidoEncabezados
 */
class Asesor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Asesor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{asesor}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_usuario, cod_fenix, id_tipo_documento, documento, nombre, apellidos, id_tipo_vinculacion, fe_vinculacion, id_estado_asesor, fe_estado', 'required'),
			array('id_usuario, cod_fenix, id_tipo_documento, id_tipo_vinculacion, id_estado_asesor', 'numerical', 'integerOnly'=>true),
			array('documento', 'length', 'max'=>10),
			array('nombre, apellidos', 'length', 'max'=>50),
			array('fe_vinculacion, fe_retiro', 'safe'),
			array('fe_vinculacion, fe_retiro', 'date', 'format'=>'yyyy-M-d H:m:s'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_usuario, cod_fenix, id_tipo_documento, documento, nombre, apellidos, id_tipo_vinculacion, fe_vinculacion, fe_retiro, id_estado_asesor, fe_estado', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		Yii::import('application.modules.user.models.user');
		return array(
			'idUsuario' => array(self::BELONGS_TO, 'User', 'id_usuario'),
			'actividadesAsesors' => array(self::HAS_MANY, 'ActividadesAsesor', 'id_asesor'),
			'idEstadoAsesor' => array(self::BELONGS_TO, 'AsesorEstado', 'id_estado_asesor'),
			'idTipoVinculacion' => array(self::BELONGS_TO, 'TipoVinculacion', 'id_tipo_vinculacion'),
			'idTipoDocumento' => array(self::BELONGS_TO, 'TipoDocumento', 'id_tipo_documento'),
			'clientes' => array(self::HAS_MANY, 'Cliente', 'id_asesor'),
			'comisiones' => array(self::HAS_MANY, 'Comisiones', 'id_asesor'),
			'cotizacionEncabezados' => array(self::HAS_MANY, 'CotizacionEncabezado', 'id_asesor'),
			'pedidoEncabezados' => array(self::HAS_MANY, 'PedidoEncabezado', 'id_asesor'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_usuario' => 'Nombre del Usuario',
			'cod_fenix' => 'Cod. Fenix',
			'id_tipo_documento' => 'Tipo de Documento',
			'documento' => 'Documento',
			'nombre' => 'Nombre',
			'apellidos' => 'Apellidos',
			'id_tipo_vinculacion' => 'Tipo de Vinculación',
			'fe_vinculacion' => 'Fecha de Vinculación',
			'fe_retiro' => 'Fecha de Retiro',
			'id_estado_asesor' => 'Estado del Asesor',
			'fe_estado' => 'Fecha de Estado',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('id_usuario',$this->id_usuario);
		$criteria->compare('cod_fenix',$this->cod_fenix);
		$criteria->compare('id_tipo_documento',$this->id_tipo_documento);
		$criteria->compare('documento',$this->documento,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('apellidos',$this->apellidos,true);
		$criteria->compare('id_tipo_vinculacion',$this->id_tipo_vinculacion);
		$criteria->compare('fe_vinculacion',$this->fe_vinculacion,true);
		$criteria->compare('fe_retiro',$this->fe_retiro,true);
		$criteria->compare('id_estado_asesor',$this->id_estado_asesor);
		$criteria->compare('fe_estado',$this->fe_estado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}