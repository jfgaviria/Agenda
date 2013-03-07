<?php

/**
 * This is the model class for table "{{especialidades_medicos}}".
 *
 * The followings are the available columns in table '{{especialidades_medicos}}':
 * @property integer $id
 * @property integer $id_medico
 * @property integer $id_especialidad
 *
 * The followings are the available model relations:
 * @property Medicos $idMedico
 * @property Especialidades $idEspecialidad
 */
class EspecialidadesMedicos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EspecialidadesMedicos the static model class
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
		return '{{especialidades_medicos}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_medico, id_especialidad', 'required'),
			array('id_medico, id_especialidad', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_medico, id_especialidad', 'safe', 'on'=>'search'),
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
			'idMedico' => array(self::BELONGS_TO, 'Medicos', 'id_medico'),
			'idEspecialidad' => array(self::BELONGS_TO, 'Especialidades', 'id_especialidad'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_medico' => 'Id Medico',
			'id_especialidad' => 'Id Especialidad',
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
		$criteria->compare('id_medico',$this->id_medico);
		$criteria->compare('id_especialidad',$this->id_especialidad);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}