<?php

/**
 * This is the model class for table "js_basic".
 *
 * The followings are the available columns in table 'js_basic':
 * @property integer $js_id
 * @property string $js_name
 * @property string $js_email
 * @property string $js_contact_no1
 * @property string $js_contact_no2
 * @property string $js_address
 * @property string $js_gender
 * @property string $js_dob
 */
class JsBasic extends CActiveRecord {

    public $cv;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'js_basic';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('js_name, js_email, js_contact_no1, js_contact_no2, js_address', 'required'),
            array('js_name, js_email', 'length', 'max' => 255),
            array('js_contact_no1, js_contact_no2', 'length', 'max' => 25),
            array('js_gender', 'length', 'max' => 20),
            array('js_dob', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('js_id, js_name, js_email, js_contact_no1, js_contact_no2, js_address, js_gender, js_dob', 'safe', 'on' => 'search'),
            array('cv', 'file', 'types' => 'pdf, doc', 'safe' => true),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'js_id' => 'Js',
            'js_name' => 'Js Name',
            'js_email' => 'Js Email',
            'js_contact_no1' => 'Js Contact No1',
            'js_contact_no2' => 'Js Contact No2',
            'js_address' => 'Js Address',
            'js_gender' => 'Js Gender',
            'js_dob' => 'Js Dob',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('js_id', $this->js_id);
        $criteria->compare('js_name', $this->js_name, true);
        $criteria->compare('js_email', $this->js_email, true);
        $criteria->compare('js_contact_no1', $this->js_contact_no1, true);
        $criteria->compare('js_contact_no2', $this->js_contact_no2, true);
        $criteria->compare('js_address', $this->js_address, true);
        $criteria->compare('js_gender', $this->js_gender, true);
        $criteria->compare('js_dob', $this->js_dob, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return JsBasic the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
