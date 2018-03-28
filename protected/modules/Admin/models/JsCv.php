<?php

/**
 * This is the model class for table "js_cv".
 *
 * The followings are the available columns in table 'js_cv':
 * @property integer $cv_id
 * @property integer $ref_js_id
 * @property string $cv_path
 */
class JsCv extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'js_cv';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ref_js_id, cv_path', 'required'),
            array('ref_js_id', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('cv_id, ref_js_id, cv_path', 'safe', 'on' => 'search'),
            array('cv_path', 'file', 'types' => 'jpg, gif, png', 'allowEmpty' => true, 'on' => 'update'),
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
            'cv_id' => 'Cv',
            'ref_js_id' => 'Ref Js',
            'cv_path' => 'Cv Path',
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

        $criteria->compare('cv_id', $this->cv_id);
        $criteria->compare('ref_js_id', $this->ref_js_id);
        $criteria->compare('cv_path', $this->cv_path, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return JsCv the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
