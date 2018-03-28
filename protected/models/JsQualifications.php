<?php

/**
 * This is the model class for table "js_qualifications".
 *
 * The followings are the available columns in table 'js_qualifications':
 * @property integer $jsquali_id
 * @property integer $ref_js_id
 * @property integer $jsquali_type
 * @property string $jsquali_qualification
 */
class JsQualifications extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'js_qualifications';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('jsquali_type, jsquali_qualification', 'required'),
			array('ref_js_id, jsquali_type', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('jsquali_id, ref_js_id, jsquali_type, jsquali_qualification', 'safe', 'on'=>'search'),
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
			'jsquali_id' => 'Jsquali',
			'ref_js_id' => 'Ref Js',
			'jsquali_type' => 'Jsquali Type',
			'jsquali_qualification' => 'Jsquali Qualification',
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

		$criteria->compare('jsquali_id',$this->jsquali_id);
		$criteria->compare('ref_js_id',$this->ref_js_id);
		$criteria->compare('jsquali_type',$this->jsquali_type);
		$criteria->compare('jsquali_qualification',$this->jsquali_qualification,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return JsQualifications the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
