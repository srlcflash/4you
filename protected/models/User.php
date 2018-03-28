<?php

/**
 * This is the model class for table "site_user".
 *
 * The followings are the available columns in table 'site_user':
 * @property integer $user_id
 * @property integer $ref_emp_or_js_id
 * @property string $user_name
 * @property string $user_password
 * @property string $user_access_token
 * @property integer $user_type
 * @property integer $user_is_verified
 * @property string $user_created_date
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'site_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ref_emp_or_js_id, user_name, user_password, user_access_token, user_type, user_is_verified, user_created_date', 'required'),
			array('ref_emp_or_js_id, user_type, user_is_verified', 'numerical', 'integerOnly'=>true),
			array('user_name, user_password', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_id, ref_emp_or_js_id, user_name, user_password, user_access_token, user_type, user_is_verified, user_created_date', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'ref_emp_or_js_id' => 'Ref Emp Or Js',
			'user_name' => 'User Name',
			'user_password' => 'User Password',
			'user_access_token' => 'User Access Token',
			'user_type' => 'User Type',
			'user_is_verified' => 'User Is Verified',
			'user_created_date' => 'User Created Date',
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

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('ref_emp_or_js_id',$this->ref_emp_or_js_id);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('user_password',$this->user_password,true);
		$criteria->compare('user_access_token',$this->user_access_token,true);
		$criteria->compare('user_type',$this->user_type);
		$criteria->compare('user_is_verified',$this->user_is_verified);
		$criteria->compare('user_created_date',$this->user_created_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
