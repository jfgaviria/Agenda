<?php

/**
 * This is the model class for table "{{medicos}}".
 *
 * The followings are the available columns in table '{{medicos}}':
 * @property integer $id
 * @property string $identificador
 * @property string $nombre
 * @property string $fe_nacimiento
 * @property string $hr_inicio
 * @property string $hr_fin
 * @property integer $estado
 *
 * The followings are the available model relations:
 * @property Agenda[] $agendas
 * @property EspecialidadesMedicos[] $especialidadesMedicoses
 */
class Medicos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Medicos the static model class
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
		return '{{medicos}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, fe_nacimiento, hr_inicio, hr_fin', 'required'),
			array('estado', 'numerical', 'integerOnly'=>true),
			array('estado', 'boolean'),
			array('identificador', 'length', 'max'=>45),
			array('nombre', 'length', 'max'=>100),
			array('fe_nacimiento', 'date', 'format'=>'yyyy-M-d'),
			array('hr_inicio, hr_fin', 'type', 'type'=>'time', 'timeFormat'=>'hh:mm:ss'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, identificador, nombre, fe_nacimiento, hr_inicio, hr_fin, estado', 'safe', 'on'=>'search'),
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
			'agendas' => array(self::HAS_MANY, 'Agenda', 'id_medico'),
			'especialidadesMedicoses' => array(self::HAS_MANY, 'EspecialidadesMedicos', 'id_medico'),
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
			'hr_inicio' => 'Hr Inicio',
			'hr_fin' => 'Hr Fin',
			'estado' => 'Estado',
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
		$criteria->compare('hr_inicio',$this->hr_inicio,true);
		$criteria->compare('hr_fin',$this->hr_fin,true);
		$criteria->compare('estado',$this->estado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function especialidadesMedicosJSON(){
		$data = array();
		if(count($this->especialidadesMedicoses) > 0){
			foreach ($this->especialidadesMedicoses AS $em){
				$data[] = $em->getAttributes();
			}
		}
		return $data;
	}
}