<?php

/**
 * This is the model class for table "{{pacientes}}".
 *
 * The followings are the available columns in table '{{pacientes}}':
 * @property integer $id
 * @property string $identificador
 * @property string $nombre
 * @property string $fe_nacimiento
 * @property string $telefono
 * @property string $observaciones
 *
 * The followings are the available model relations:
 * @property Agenda[] $agendas
 */
class Pacientes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Pacientes the static model class
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
		return '{{pacientes}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, fe_nacimiento, telefono', 'required'),
			array('identificador', 'length', 'max'=>45),
			array('nombre', 'length', 'max'=>100),
			array('telefono', 'length', 'max'=>15),
			array('observaciones', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, identificador, nombre, fe_nacimiento, telefono, observaciones', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'agendas' => array(self::HAS_MANY, 'Agenda', 'id_paciente'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'identificador' => 'Identificador',
			'nombre' => 'Nombre',
			'fe_nacimiento' => 'Fe Nacimiento',
			'telefono' => 'Telefono',
			'observaciones' => 'Observaciones',
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
		$criteria->compare('identificador',$this->identificador,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('fe_nacimiento',$this->fe_nacimiento,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('observaciones',$this->observaciones,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}