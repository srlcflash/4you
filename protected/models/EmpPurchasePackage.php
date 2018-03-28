<?php

/**
 * This is the model class for table "emp_purchase_package".
 *
 * The followings are the available columns in table 'emp_purchase_package':
 * @property integer $epp_id
 * @property integer $ref_user_id
 * @property integer $ref_pack_id
 * @property string $epp_pack_name
 * @property string $epp_pack_amount
 * @property integer $epp_pack_num_of_ads
 * @property integer $epp_pack_is_unlimited
 * @property string $epp_pack_validity_period
 * @property string $epp_effective_date
 * @property string $epp_expire_date
 */
class EmpPurchasePackage extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'emp_purchase_package';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('epp_id, ref_user_id, ref_pack_id, epp_pack_num_of_ads, epp_pack_is_unlimited', 'numerical', 'integerOnly'=>true),
			array('epp_pack_name', 'length', 'max'=>225),
			array('epp_pack_amount', 'length', 'max'=>8),
			array('epp_pack_validity_period', 'length', 'max'=>10),
			array('epp_effective_date, epp_expire_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('epp_id, ref_user_id, ref_pack_id, epp_pack_name, epp_pack_amount, epp_pack_num_of_ads, epp_pack_is_unlimited, epp_pack_validity_period, epp_effective_date, epp_expire_date', 'safe', 'on'=>'search'),
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
			'epp_id' => 'Epp',
			'ref_user_id' => 'Ref User',
			'ref_pack_id' => 'Ref Pack',
			'epp_pack_name' => 'Epp Pack Name',
			'epp_pack_amount' => 'Epp Pack Amount',
			'epp_pack_num_of_ads' => 'Epp Pack Num Of Ads',
			'epp_pack_is_unlimited' => 'Epp Pack Is Unlimited',
			'epp_pack_validity_period' => 'Epp Pack Validity Period',
			'epp_effective_date' => 'Epp Effective Date',
			'epp_expire_date' => 'Epp Expire Date',
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

		$criteria->compare('epp_id',$this->epp_id);
		$criteria->compare('ref_user_id',$this->ref_user_id);
		$criteria->compare('ref_pack_id',$this->ref_pack_id);
		$criteria->compare('epp_pack_name',$this->epp_pack_name,true);
		$criteria->compare('epp_pack_amount',$this->epp_pack_amount,true);
		$criteria->compare('epp_pack_num_of_ads',$this->epp_pack_num_of_ads);
		$criteria->compare('epp_pack_is_unlimited',$this->epp_pack_is_unlimited);
		$criteria->compare('epp_pack_validity_period',$this->epp_pack_validity_period,true);
		$criteria->compare('epp_effective_date',$this->epp_effective_date,true);
		$criteria->compare('epp_expire_date',$this->epp_expire_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EmpPurchasePackage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
