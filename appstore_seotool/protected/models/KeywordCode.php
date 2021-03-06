<?php

/**
 * This is the model class for table "keyword_code".
 *
 * The followings are the available columns in table 'keyword_code':
 * @property integer $keyword_id
 * @property string $keyword
 * @property integer $keyword_specify_flag
 * @property string $insert_date
 * @property string $update_date
 * @property string $delete_date
 * @property integer $delete_flag
 * @property array $appCodes relations app code
 */
class KeywordCode extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return KeywordCode the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'keyword_code';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('keyword', 'required'),
            array('keyword_specify_flag, delete_flag', 'numerical', 'integerOnly' => true),
            array('keyword', 'length', 'max' => 255),
//            array('insert_date, update_date, delete_date', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('keyword_id, keyword, keyword_specify_flag, delete_date, delete_flag', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'appCodes' => array(self::MANY_MANY, 'AppCode', 'keyword_app(keyword_id, app_id)'),
            'keywordApps' => array(self::HAS_MANY, 'KeywordApp', 'keyword_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'keyword_id' => 'Keyword',
            'keyword' => 'Keyword',
            'keyword_specify_flag' => 'Keyword Specify Flag',
            'insert_date' => 'Insert Date',
            'update_date' => 'Update Date',
            'delete_date' => 'Delete Date',
            'delete_flag' => 'Delete Flag',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('keyword_id', $this->keyword_id);
        $criteria->compare('keyword', $this->keyword, true);
        $criteria->compare('keyword_specify_flag', $this->keyword_specify_flag);
        $criteria->compare('insert_date', $this->insert_date, true);
        $criteria->compare('update_date', $this->update_date, true);
        $criteria->compare('delete_date', $this->delete_date, true);
        $criteria->compare('delete_flag', $this->delete_flag);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function behaviors() {
        return array(
            'timestamps' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'insert_date',
                'updateAttribute' => 'update_date',
                'setUpdateOnCreate' => true,
            ),);
    }
    
    protected function beforeValidate() {
        if ($this->isNewRecord) {
            $this->insert_date = new CDbExpression('NOW()');
        }
        $this->update_date = new CDbExpression('NOW()');
        return true;
    }

}