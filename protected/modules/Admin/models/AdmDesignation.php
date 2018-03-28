<?php

/**
 * This is the model class for table "adm_designation".
 *
 * The followings are the available columns in table 'adm_designation':
 * @property integer $desig_id
 * @property integer $ref_cat_id
 * @property string $desig_name
 */
class AdmDesignation extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'adm_designation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ref_cat_id, desig_name', 'required'),
			array('ref_cat_id', 'numerical', 'integerOnly'=>true),
			array('desig_name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('desig_id, ref_cat_id, desig_name', 'safe', 'on'=>'search'),
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
			'desig_id' => 'Desig',
			'ref_cat_id' => 'Ref Cat',
			'desig_name' => 'Desig Name',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('desig_id',$this->desig_id);
		$criteria->compare('ref_cat_id',$this->ref_cat_id);
		$criteria->compare('desig_name',$this->desig_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AdmDesignation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
