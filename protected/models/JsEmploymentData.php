<?php

/**
 * This is the model class for table "js_employment_data".
 *
 * The followings are the available columns in table 'js_employment_data':
 * @property integer $jsemp_id
 * @property integer $ref_js_id
 * @property integer $ref_industry_id
 * @property integer $ref_category_id
 * @property integer $ref_sub_category_id
 * @property integer $ref_designation_id
 * @property integer $jsemp_expected_ref_industry_id
 * @property integer $jsemp_expected_ref_category_id
 * @property integer $jsemp_expected_sub_category_id
 * @property integer $jsemp_expected_designation_id
 * @property string $jsemp_expected_salary
 * @property string $jsemp_no_of_experience_years
 * @property string $jsemp_no_of_experience_months
 */
class JsEmploymentData extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'js_employment_data';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ref_js_id, ref_industry_id, ref_category_id, ref_sub_category_id, ref_designation_id, jsemp_expected_ref_industry_id, jsemp_expected_ref_category_id, jsemp_expected_sub_category_id, jsemp_expected_designation_id', 'required'),
			array('ref_js_id, ref_industry_id, ref_category_id, ref_sub_category_id, ref_designation_id, jsemp_expected_ref_industry_id, jsemp_expected_ref_category_id, jsemp_expected_sub_category_id, jsemp_expected_designation_id', 'numerical', 'integerOnly'=>true),
			array('jsemp_expected_salary, jsemp_no_of_experience_years, jsemp_no_of_experience_months', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('jsemp_id, ref_js_id, ref_industry_id, ref_category_id, ref_sub_category_id, ref_designation_id, jsemp_expected_ref_industry_id, jsemp_expected_ref_category_id, jsemp_expected_sub_category_id, jsemp_expected_designation_id, jsemp_expected_salary, jsemp_no_of_experience_years, jsemp_no_of_experience_months', 'safe', 'on'=>'search'),
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
			'jsemp_id' => 'Jsemp',
			'ref_js_id' => 'Ref Js',
			'ref_industry_id' => 'Ref Industry',
			'ref_category_id' => 'Ref Category',
			'ref_sub_category_id' => 'Ref Sub Category',
			'ref_designation_id' => 'Ref Designation',
			'jsemp_expected_ref_industry_id' => 'Jsemp Expected Ref Industry',
			'jsemp_expected_ref_category_id' => 'Jsemp Expected Ref Category',
			'jsemp_expected_sub_category_id' => 'Jsemp Expected Sub Category',
			'jsemp_expected_designation_id' => 'Jsemp Expected Designation',
			'jsemp_expected_salary' => 'Jsemp Expected Salary',
			'jsemp_no_of_experience_years' => 'Jsemp No Of Experience Years',
			'jsemp_no_of_experience_months' => 'Jsemp No Of Experience Months',
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

		$criteria->compare('jsemp_id',$this->jsemp_id);
		$criteria->compare('ref_js_id',$this->ref_js_id);
		$criteria->compare('ref_industry_id',$this->ref_industry_id);
		$criteria->compare('ref_category_id',$this->ref_category_id);
		$criteria->compare('ref_sub_category_id',$this->ref_sub_category_id);
		$criteria->compare('ref_designation_id',$this->ref_designation_id);
		$criteria->compare('jsemp_expected_ref_industry_id',$this->jsemp_expected_ref_industry_id);
		$criteria->compare('jsemp_expected_ref_category_id',$this->jsemp_expected_ref_category_id);
		$criteria->compare('jsemp_expected_sub_category_id',$this->jsemp_expected_sub_category_id);
		$criteria->compare('jsemp_expected_designation_id',$this->jsemp_expected_designation_id);
		$criteria->compare('jsemp_expected_salary',$this->jsemp_expected_salary,true);
		$criteria->compare('jsemp_no_of_experience_years',$this->jsemp_no_of_experience_years,true);
		$criteria->compare('jsemp_no_of_experience_months',$this->jsemp_no_of_experience_months,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return JsEmploymentData the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
