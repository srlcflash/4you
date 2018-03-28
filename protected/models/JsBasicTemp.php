<?php

/**
 * This is the model class for table "js_basic_temp".
 *
 * The followings are the available columns in table 'js_basic_temp':
 * @property integer $jsbt_id
 * @property string $jsbt_fname
 * @property string $jsbt_lname
 * @property string $jsbt_email
 * @property string $jsbt_contact_no
 * @property string $jsbt_created_time
 */
class JsBasicTemp extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'js_basic_temp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('jsbt_fname, jsbt_lname, jsbt_email, jsbt_contact_no, jsbt_created_time', 'required'),
			array('jsbt_fname, jsbt_lname, jsbt_email, jsbt_contact_no', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('jsbt_id, jsbt_fname, jsbt_lname, jsbt_email, jsbt_contact_no, jsbt_created_time', 'safe', 'on'=>'search'),
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
			'jsbt_id' => 'Jsbt',
			'jsbt_fname' => 'Jsbt Fname',
			'jsbt_lname' => 'Jsbt Lname',
			'jsbt_email' => 'Jsbt Email',
			'jsbt_contact_no' => 'Jsbt Contact No',
			'jsbt_created_time' => 'Jsbt Created Time',
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

		$criteria->compare('jsbt_id',$this->jsbt_id);
		$criteria->compare('jsbt_fname',$this->jsbt_fname,true);
		$criteria->compare('jsbt_lname',$this->jsbt_lname,true);
		$criteria->compare('jsbt_email',$this->jsbt_email,true);
		$criteria->compare('jsbt_contact_no',$this->jsbt_contact_no,true);
		$criteria->compare('jsbt_created_time',$this->jsbt_created_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return JsBasicTemp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
