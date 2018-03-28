<?php

/**
 * This is the model class for table "adm_email_config".
 *
 * The followings are the available columns in table 'adm_email_config':
 * @property integer $e_id
 * @property string $smtp_server
 * @property string $smtp_user
 * @property string $smtp_pass
 * @property integer $smtp_port
 * @property string $email_sender_name
 * @property string $email_rec_notification
 * @property string $domain
 * @property integer $email_method
 */
class AdmEmailConfig extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'adm_email_config';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email_rec_notification, domain, email_method', 'required'),
			array('smtp_port, email_method', 'numerical', 'integerOnly'=>true),
			array('smtp_server, email_sender_name', 'length', 'max'=>200),
			array('smtp_user, smtp_pass', 'length', 'max'=>300),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('e_id, smtp_server, smtp_user, smtp_pass, smtp_port, email_sender_name, email_rec_notification, domain, email_method', 'safe', 'on'=>'search'),
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
			'e_id' => 'E',
			'smtp_server' => 'Smtp Server',
			'smtp_user' => 'Smtp User',
			'smtp_pass' => 'Smtp Pass',
			'smtp_port' => 'Smtp Port',
			'email_sender_name' => 'Email Sender Name',
			'email_rec_notification' => 'Email Rec Notification',
			'domain' => 'Domain',
			'email_method' => 'Email Method',
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

		$criteria->compare('e_id',$this->e_id);
		$criteria->compare('smtp_server',$this->smtp_server,true);
		$criteria->compare('smtp_user',$this->smtp_user,true);
		$criteria->compare('smtp_pass',$this->smtp_pass,true);
		$criteria->compare('smtp_port',$this->smtp_port);
		$criteria->compare('email_sender_name',$this->email_sender_name,true);
		$criteria->compare('email_rec_notification',$this->email_rec_notification,true);
		$criteria->compare('domain',$this->domain,true);
		$criteria->compare('email_method',$this->email_method);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AdmEmailConfig the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
