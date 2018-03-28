<?php

/**
 * This is the model class for table "js_applied_details".
 *
 * The followings are the available columns in table 'js_applied_details':
 * @property integer $jsad_id
 * @property integer $ref_advertisement_id
 * @property integer $is_registered_user
 * @property integer $ref_js_id
 * @property string $jsad_name
 * @property string $jsad_email
 * @property string $jsad_cv_path
 * @property string $jsad_applied_time
 * @property integer $jsad_applied_user
 */
class JsAppliedDetails extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'js_applied_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ref_advertisement_id, jsad_name, jsad_email, jsad_cv_path, jsad_applied_time, jsad_applied_user', 'required'),
			array('ref_advertisement_id, is_registered_user, ref_js_id, jsad_applied_user', 'numerical', 'integerOnly'=>true),
			array('jsad_name, jsad_email, jsad_cv_path, jsad_applied_time', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('jsad_id, ref_advertisement_id, is_registered_user, ref_js_id, jsad_name, jsad_email, jsad_cv_path, jsad_applied_time, jsad_applied_user', 'safe', 'on'=>'search'),
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
			'jsad_id' => 'Jsad',
			'ref_advertisement_id' => 'Ref Advertisement',
			'is_registered_user' => 'Is Registered User',
			'ref_js_id' => 'Ref Js',
			'jsad_name' => 'Jsad Name',
			'jsad_email' => 'Jsad Email',
			'jsad_cv_path' => 'Jsad Cv Path',
			'jsad_applied_time' => 'Jsad Applied Time',
			'jsad_applied_user' => 'Jsad Applied User',
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

		$criteria->compare('jsad_id',$this->jsad_id);
		$criteria->compare('ref_advertisement_id',$this->ref_advertisement_id);
		$criteria->compare('is_registered_user',$this->is_registered_user);
		$criteria->compare('ref_js_id',$this->ref_js_id);
		$criteria->compare('jsad_name',$this->jsad_name,true);
		$criteria->compare('jsad_email',$this->jsad_email,true);
		$criteria->compare('jsad_cv_path',$this->jsad_cv_path,true);
		$criteria->compare('jsad_applied_time',$this->jsad_applied_time,true);
		$criteria->compare('jsad_applied_user',$this->jsad_applied_user);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return JsAppliedDetails the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
