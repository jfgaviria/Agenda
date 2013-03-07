<?php

/**
 * This is the model class for table "{{agenda}}".
 *
 * The followings are the available columns in table '{{agenda}}':
 * @property integer $id
 * @property integer $id_paciente
 * @property integer $id_medico
 * @property string $fe_inicial
 * @property string $fe_final
 *
 * The followings are the available model relations:
 * @property Medicos $idMedico
 * @property Pacientes $idPaciente
 */
class Agenda extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Agenda the static model class
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
		return '{{agenda}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_paciente, id_medico, fe_inicial', 'required'),
			array('id_paciente, id_medico', 'numerical', 'integerOnly'=>true),
			array('fe_final', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_paciente, id_medico, fe_inicial, fe_final', 'safe', 'on'=>'search'),
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
			'idPaciente' => array(self::BELONGS_TO, 'Pacientes', 'id_paciente'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_paciente' => 'Id Paciente',
			'id_medico' => 'Id Medico',
			'fe_inicial' => 'Fe Inicial',
			'fe_final' => 'Fe Final',
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
		$criteria->compare('id_paciente',$this->id_paciente);
		$criteria->compare('id_medico',$this->id_medico);
		$criteria->compare('fe_inicial',$this->fe_inicial,true);
		$criteria->compare('fe_final',$this->fe_final,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}