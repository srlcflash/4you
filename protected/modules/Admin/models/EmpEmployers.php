<?php

/**
 * This is the model class for table "emp_employers".
 *
 * The followings are the available columns in table 'emp_employers':
 * @property integer $employer_id
 * @property string $employer_name
 * @property string $employer_address
 * @property string $employer_tel
 * @property string $employer_mobi
 * @property string $employer_email
 * @property string $employer_contact_person
 */
class EmpEmployers extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'emp_employers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('employer_name, employer_address, employer_tel, employer_mobi, employer_email, employer_contact_person', 'required'),
			array('employer_name, employer_tel, employer_mobi, employer_email, employer_contact_person', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('employer_id, employer_name, employer_address, employer_tel, employer_mobi, employer_email, employer_contact_person', 'safe', 'on'=>'search'),
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
			'employer_id' => 'Employer',
			'employer_name' => 'Employer Name',
			'employer_address' => 'Employer Address',
			'employer_tel' => 'Employer Tel',
			'employer_mobi' => 'Employer Mobi',
			'employer_email' => 'Employer Email',
			'employer_contact_person' => 'Employer Contact Person',
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

		$criteria->compare('employer_id',$this->employer_id);
		$criteria->compare('employer_name',$this->employer_name,true);
		$criteria->compare('employer_address',$this->employer_address,true);
		$criteria->compare('employer_tel',$this->employer_tel,true);
		$criteria->compare('employer_mobi',$this->employer_mobi,true);
		$criteria->compare('employer_email',$this->employer_email,true);
		$criteria->compare('employer_contact_person',$this->employer_contact_person,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EmpEmployers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
