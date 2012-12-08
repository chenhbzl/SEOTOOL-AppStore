<?php

/**
 * This is the model class for table "app_keyword".
 *
 * The followings are the available columns in table 'app_keyword':
 * @property integer $id
 * @property integer $keyword_app_id
 * @property integer $search_view_rank
 * @property string $sum_key_counter
 * @property string $insert_date
 * @property integer $seq_no
 */
class AppKeyword extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return AppKeyword the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'app_keyword';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('keyword_app_id, search_view_rank, seq_no', 'numerical', 'integerOnly' => true),
            array('sum_key_counter', 'length', 'max' => 10),
            array('insert_date', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, keyword_app_id, search_view_rank, sum_key_counter, insert_date, seq_no', 'safe', 'on' => 'search'),
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
            'id' => 'ID',
            'keyword_app_id' => 'Keyword App',
            'search_view_rank' => 'Search View Rank',
            'sum_key_counter' => 'Sum Key Counter',
            'insert_date' => 'Insert Date',
            'seq_no' => 'Seq No',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('keyword_app_id', $this->keyword_app_id);
        $criteria->compare('search_view_rank', $this->search_view_rank);
        $criteria->compare('sum_key_counter', $this->sum_key_counter, true);
        $criteria->compare('insert_date', $this->insert_date, true);
        $criteria->compare('seq_no', $this->seq_no);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    /**
     * Get appkeyword by start&end date
     * @param String $start
     * @param String $end
     * @param int $keyword_app_id
     * @return type
     */
    public static function getByDate($start, $end = null, $keyword_app_id = null) {
        $criteria = new CDbCriteria;
        $criteria->group = 'DATE(insert_date)';
        $criteria->select = 'keyword_app_id, search_view_rank, sum_key_counter, DATE(insert_date) as insert_date, MAX(seq_no)';
        if (!$keyword_app_id == null)
            $criteria->condition = "keyword_app_id = " . $keyword_app_id;
        $criteria->order = "insert_date DESC";
        if (!($end == null || empty($end)))
            $criteria->addBetweenCondition('DATE(insert_date)', $start, $end);
        else
            $criteria->addCondition('insert_date >= ' . $start);
        $model = AppKeyword::model()->findAll($criteria);
//        var_dump($criteria);
        return $model;
    }

    /**
     * get AppKeyword Info with specified date
     * @param int $keyword_app_id
     * @param String $date
     */
    public static function getByDate2($keyword_app_id, $date) {
        $criteria = new CDbCriteria;
        $criteria->select = 'keyword_app_id, search_view_rank, sum_key_counter, DATE(insert_date) as insert_date, MAX(seq_no)';
        $criteria->condition = "keyword_app_id = " . $keyword_app_id . " and DATE(insert_date) = DATE('" . $date."')";
        $model = AppKeyword::model()->findAll($criteria);
        return $model;
    }
    
    public function creat_AppKeyword($id, $rank){
        if ($this->isNewRecord) {
            $this->insert_date = new CDbExpression('NOW()');
        }
        //$this->update_date = new CDbExpression('NOW()');
        $this->keyword_app_id = $id;
        $this->search_view_rank = $rank;
        
        return $this->save();
    }
}