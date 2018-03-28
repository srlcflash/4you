<?php

/**
 * This is the model class for table "adm_package".
 *
 * The followings are the available columns in table 'adm_package':
 * @property integer $pack_id
 * @property string $pack_name
 * @property string $pack_amount
 * @property string $pack_num_of_ads
 * @property integer $pack_is_unlimited
 * @property string $pack_validity_period
 */
class AdmPackage extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'adm_package';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pack_name, pack_amount', 'required'),
			array('pack_is_unlimited', 'numerical', 'integerOnly'=>true),
			array('pack_name', 'length', 'max'=>255),
			array('pack_amount, pack_num_of_ads, pack_validity_period', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pack_id, pack_name, pack_amount, pack_num_of_ads, pack_is_unlimited, pack_validity_period', 'safe', 'on'=>'search'),
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
			'pack_id' => 'Pack',
			'pack_name' => 'Pack Name',
			'pack_amount' => 'Pack Amount',
			'pack_num_of_ads' => 'Pack Num Of Ads',
			'pack_is_unlimited' => 'Pack Is Unlimited',
			'pack_validity_period' => 'Pack Validity Period',
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

		$criteria->compare('pack_id',$this->pack_id);
		$criteria->compare('pack_name',$this->pack_name,true);
		$criteria->compare('pack_amount',$this->pack_amount,true);
		$criteria->compare('pack_num_of_ads',$this->pack_num_of_ads,true);
		$criteria->compare('pack_is_unlimited',$this->pack_is_unlimited);
		$criteria->compare('pack_validity_period',$this->pack_validity_period,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AdmPackage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
