<?php

/**
 * This is the model class for table "{{menu}}".
 *
 * The followings are the available columns in table '{{menu}}':
 * @property integer $id
 * @property integer $id_padre
 * @property string $title
 * @property string $subtitle
 * @property integer $subtitle_pos
 * @property string $url
 * @property string $active
 * @property string $visible
 * @property integer $status
 */
class Menu extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Menu the static model class
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
		return '{{menu}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, url', 'required'),
			array('id_padre, subtitle_pos, status', 'numerical', 'integerOnly'=>true),
			array('title, subtitle, active, visible', 'length', 'max'=>100),
			array('url', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_padre, title, subtitle, subtitle_pos, url, active, visible, status', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_padre' => 'Id Padre',
			'title' => 'Title',
			'subtitle' => 'Subtitle',
			'subtitle_pos' => 'Subtitle Pos',
			'url' => 'Url',
			'active' => 'Active',
			'visible' => 'Visible',
			'status' => 'Estado',
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
		$criteria->compare('id_padre',$this->id_padre);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('subtitle',$this->subtitle,true);
		$criteria->compare('subtitle_pos',$this->subtitle_pos);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('active',$this->active,true);
		$criteria->compare('visible',$this->visible,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}