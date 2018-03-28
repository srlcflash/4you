<?php

/**
 * This is the model class for table "emp_advertisement".
 *
 * The followings are the available columns in table 'emp_advertisement':
 * @property integer $ad_id
 * @property integer $ref_district_id
 * @property integer $ref_city_id
 * @property integer $ref_industry_id
 * @property integer $ref_cat_id
 * @property integer $ref_subcat_id
 * @property integer $ref_designation_id
 * @property string $ad_salary
 * @property integer $ad_is_negotiable
 * @property integer $ref_work_type
 * @property string $ad_title
 * @property integer $ad_is_use_desig_as_title
 * @property string $ad_expire_date
 * @property integer $ad_is_image
 * @property string $ad_image_url
 * @property string $ad_text
 */
class EmpAdvertisement extends CActiveRecord {

    public $image;
    public $AdverImage;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'emp_advertisement';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ad_id, ad_title, ad_expire_date, ad_image_url, ad_text', 'required'),
            array('ad_id, ref_district_id, ref_city_id, ref_industry_id, ref_cat_id, ref_subcat_id, ref_designation_id, ad_is_negotiable, ref_work_type, ad_is_use_desig_as_title, ad_is_image', 'numerical', 'integerOnly' => true),
            array('ad_salary', 'length', 'max' => 18),
            array('ad_title', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ad_id, ref_district_id, ref_city_id, ref_industry_id, ref_cat_id, ref_subcat_id, ref_designation_id, ad_salary, ad_is_negotiable, ref_work_type, ad_title, ad_is_use_desig_as_title, ad_expire_date, ad_is_image, ad_image_url, ad_text', 'safe', 'on' => 'search'),
            array('image', 'file', 'types' => 'pdf', 'safe' => true),
            array('AdverImage', 'file', 'types' => 'png, jpg', 'safe' => true),
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
            'ad_id' => 'Ad',
            'ref_district_id' => 'Ref District',
            'ref_city_id' => 'Ref City',
            'ref_industry_id' => 'Ref Industry',
            'ref_cat_id' => 'Ref Cat',
            'ref_subcat_id' => 'Ref Subcat',
            'ref_designation_id' => 'Ref Designation',
            'ad_salary' => 'Ad Salary',
            'ad_is_negotiable' => 'Ad Is Negotiable',
            'ref_work_type' => 'Ref Work Type',
            'ad_title' => 'Ad Title',
            'ad_is_use_desig_as_title' => 'Ad Is Use Desig As Title',
            'ad_expire_date' => 'Ad Expire Date',
            'ad_is_image' => 'Ad Is Image',
            'ad_image_url' => 'Ad Image Url',
            'ad_text' => 'Ad Text',
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

        $criteria->compare('ad_id', $this->ad_id);
        $criteria->compare('ref_district_id', $this->ref_district_id);
        $criteria->compare('ref_city_id', $this->ref_city_id);
        $criteria->compare('ref_industry_id', $this->ref_industry_id);
        $criteria->compare('ref_cat_id', $this->ref_cat_id);
        $criteria->compare('ref_subcat_id', $this->ref_subcat_id);
        $criteria->compare('ref_designation_id', $this->ref_designation_id);
        $criteria->compare('ad_salary', $this->ad_salary, true);
        $criteria->compare('ad_is_negotiable', $this->ad_is_negotiable);
        $criteria->compare('ref_work_type', $this->ref_work_type);
        $criteria->compare('ad_title', $this->ad_title, true);
        $criteria->compare('ad_is_use_desig_as_title', $this->ad_is_use_desig_as_title);
        $criteria->compare('ad_expire_date', $this->ad_expire_date, true);
        $criteria->compare('ad_is_image', $this->ad_is_image);
        $criteria->compare('ad_image_url', $this->ad_image_url, true);
        $criteria->compare('ad_text', $this->ad_text, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return EmpAdvertisement the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
