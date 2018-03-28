<?php

/**
 * This is the model class for table "adm_links".
 *
 * The followings are the available columns in table 'adm_links':
 * @property integer $lnk_id
 * @property integer $lnk_parent_id
 * @property string $lnk_name
 * @property string $lnk_module
 * @property string $lnk_controller
 * @property string $lnk_action
 * @property integer $lnk_is_module
 * @property integer $lnk_depth
 * @property integer $lnk_order
 */
class AdmLinks extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'adm_links';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lnk_parent_id', 'required'),
			array('lnk_parent_id, lnk_is_module, lnk_depth, lnk_order', 'numerical', 'integerOnly'=>true),
			array('lnk_name', 'length', 'max'=>50),
			array('lnk_module, lnk_controller, lnk_action', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('lnk_id, lnk_parent_id, lnk_name, lnk_module, lnk_controller, lnk_action, lnk_is_module, lnk_depth, lnk_order', 'safe', 'on'=>'search'),
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
			'lnk_id' => 'Lnk',
			'lnk_parent_id' => 'Lnk Parent',
			'lnk_name' => 'Lnk Name',
			'lnk_module' => 'Lnk Module',
			'lnk_controller' => 'Lnk Controller',
			'lnk_action' => 'Lnk Action',
			'lnk_is_module' => 'Lnk Is Module',
			'lnk_depth' => 'Lnk Depth',
			'lnk_order' => 'Lnk Order',
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

		$criteria->compare('lnk_id',$this->lnk_id);
		$criteria->compare('lnk_parent_id',$this->lnk_parent_id);
		$criteria->compare('lnk_name',$this->lnk_name,true);
		$criteria->compare('lnk_module',$this->lnk_module,true);
		$criteria->compare('lnk_controller',$this->lnk_controller,true);
		$criteria->compare('lnk_action',$this->lnk_action,true);
		$criteria->compare('lnk_is_module',$this->lnk_is_module);
		$criteria->compare('lnk_depth',$this->lnk_depth);
		$criteria->compare('lnk_order',$this->lnk_order);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AdmLinks the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
