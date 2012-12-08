<?php

/**
 * This is the model class for table "app".
 *
 * The followings are the available columns in table 'app':
 * @property string $id
 * @property string $app_id
 * @property integer $all_rank_paid
 * @property integer $all_rank_free
 * @property integer $all_rank_new_paid
 * @property integer $all_rank_new_free
 * @property integer $all_rank_grossing
 * @property integer $all_game_paid
 * @property integer $all_game_free
 * @property integer $all_game_new_free
 * @property integer $all_game_new_paid
 * @property integer $all_game_grossing
 * @property integer $category_rank_paid
 * @property integer $category_rank_free
 * @property integer $category_rank_new_paid
 * @property integer $category_rank_new_free
 * @property integer $category_rank_grossing
 * @property string $install_count
 * @property string $insert_date
 * @property string $update_date
 * @property string $delete_date
 * @property integer $delete_flag
 * @property integer $seq_no
 */
class App extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return App the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'app';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            //array('seq_no', 'required'),
            array('all_rank_paid, all_rank_free, all_rank_new_paid, all_rank_new_free, all_rank_grossing, all_game_paid, all_game_free, all_game_new_free, all_game_new_paid, all_game_grossing, category1_rank_paid, category1_rank_free, category1_rank_new_paid, category1_rank_new_free, category1_rank_grossing, category2_rank_paid, category2_rank_free, category2_rank_new_paid, category2_rank_new_free, category2_rank_grossing, category3_rank_paid, category3_rank_free, category3_rank_new_paid, category3_rank_new_free, category3_rank_grossing, category4_rank_paid, category4_rank_free, category4_rank_new_paid, category4_rank_new_free, category4_rank_grossing, category5_rank_paid, category5_rank_free, category5_rank_new_paid, category5_rank_new_free, category5_rank_grossing, category6_rank_paid, category6_rank_free, category6_rank_new_paid, category6_rank_new_free, category6_rank_grossing, delete_flag, seq_no', 'numerical', 'integerOnly' => true),
            array('app_id, install_count', 'length', 'max' => 10),
            array('insert_date, update_date, delete_date', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, app_id, all_rank_paid, all_rank_free, all_rank_new_paid, all_rank_new_free, all_rank_grossing, all_game_paid, all_game_free, all_game_new_free, all_game_new_paid, all_game_grossing, category1_rank_paid, category1_rank_free, category1_rank_new_paid, category1_rank_new_free, category1_rank_grossing, category2_rank_paid, category2_rank_free, category2_rank_new_paid, category2_rank_new_free, category2_rank_grossing, category3_rank_paid, category3_rank_free, category3_rank_new_paid, category3_rank_new_free, category3_rank_grossing, category4_rank_paid, category4_rank_free, category4_rank_new_paid, category4_rank_new_free, category4_rank_grossing, category5_rank_paid, category5_rank_free, category5_rank_new_paid, category5_rank_new_free, category5_rank_grossing, category6_rank_paid, category6_rank_free, category6_rank_new_paid, category6_rank_new_free, category6_rank_grossing, install_count, insert_date, update_date, delete_date, delete_flag, seq_no', 'safe', 'on' => 'search'),
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
            'app_id' => 'App',
            'all_rank_paid' => 'All Rank Paid',
            'all_rank_free' => 'All Rank Free',
            'all_rank_new_paid' => 'All Rank New Paid',
            'all_rank_new_free' => 'All Rank New Free',
            'all_rank_grossing' => 'All Rank Grossing',
            'all_game_paid' => 'All Game Paid',
            'all_game_free' => 'All Game Free',
            'all_game_new_free' => 'All Game New Free',
            'all_game_new_paid' => 'All Game New Paid',
            'all_game_grossing' => 'All Game Grossing',
            'category1_rank_paid' => 'Category1 Rank Paid',
            'category1_rank_free' => 'Category1 Rank Free',
            'category1_rank_new_paid' => 'Category1 Rank New Paid',
            'category1_rank_new_free' => 'Category1 Rank New Free',
            'category1_rank_grossing' => 'Category1 Rank Grossing',
            'category2_rank_paid' => 'Category2 Rank Paid',
            'category2_rank_free' => 'Category2 Rank Free',
            'category2_rank_new_paid' => 'Category2 Rank New Paid',
            'category2_rank_new_free' => 'Category2 Rank New Free',
            'category2_rank_grossing' => 'Category2 Rank Grossing',
            'category3_rank_paid' => 'Category3 Rank Paid',
            'category3_rank_free' => 'Category3 Rank Free',
            'category3_rank_new_paid' => 'Category3 Rank New Paid',
            'category3_rank_new_free' => 'Category3 Rank New Free',
            'category3_rank_grossing' => 'Category3 Rank Grossing',
            'category4_rank_paid' => 'Category4 Rank Paid',
            'category4_rank_free' => 'Category4 Rank Free',
            'category4_rank_new_paid' => 'Category4 Rank New Paid',
            'category4_rank_new_free' => 'Category4 Rank New Free',
            'category4_rank_grossing' => 'Category4 Rank Grossing',
            'category5_rank_paid' => 'Category5 Rank Paid',
            'category5_rank_free' => 'Category5 Rank Free',
            'category5_rank_new_paid' => 'Category5 Rank New Paid',
            'category5_rank_new_free' => 'Category5 Rank New Free',
            'category5_rank_grossing' => 'Category5 Rank Grossing',
            'category6_rank_paid' => 'Category6 Rank Paid',
            'category6_rank_free' => 'Category6 Rank Free',
            'category6_rank_new_paid' => 'Category6 Rank New Paid',
            'category6_rank_new_free' => 'Category6 Rank New Free',
            'category6_rank_grossing' => 'Category6 Rank Grossing',
            'install_count' => 'Install Count',
            'insert_date' => 'Insert Date',
            'update_date' => 'Update Date',
            'delete_date' => 'Delete Date',
            'delete_flag' => 'Delete Flag',
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

        $criteria->compare('id', $this->id, true);
        $criteria->compare('app_id', $this->app_id, true);
        $criteria->compare('all_rank_paid', $this->all_rank_paid);
        $criteria->compare('all_rank_free', $this->all_rank_free);
        $criteria->compare('all_rank_new_paid', $this->all_rank_new_paid);
        $criteria->compare('all_rank_new_free', $this->all_rank_new_free);
        $criteria->compare('all_rank_grossing', $this->all_rank_grossing);
        $criteria->compare('all_game_paid', $this->all_game_paid);
        $criteria->compare('all_game_free', $this->all_game_free);
        $criteria->compare('all_game_new_free', $this->all_game_new_free);
        $criteria->compare('all_game_new_paid', $this->all_game_new_paid);
        $criteria->compare('all_game_grossing', $this->all_game_grossing);
        $criteria->compare('category1_rank_paid', $this->category1_rank_paid);
        $criteria->compare('category1_rank_free', $this->category1_rank_free);
        $criteria->compare('category1_rank_new_paid', $this->category1_rank_new_paid);
        $criteria->compare('category1_rank_new_free', $this->category1_rank_new_free);
        $criteria->compare('category1_rank_grossing', $this->category1_rank_grossing);
        $criteria->compare('category2_rank_paid', $this->category2_rank_paid);
        $criteria->compare('category2_rank_free', $this->category2_rank_free);
        $criteria->compare('category2_rank_new_paid', $this->category2_rank_new_paid);
        $criteria->compare('category2_rank_new_free', $this->category2_rank_new_free);
        $criteria->compare('category2_rank_grossing', $this->category2_rank_grossing);
        $criteria->compare('category3_rank_paid', $this->category3_rank_paid);
        $criteria->compare('category3_rank_free', $this->category3_rank_free);
        $criteria->compare('category3_rank_new_paid', $this->category3_rank_new_paid);
        $criteria->compare('category3_rank_new_free', $this->category3_rank_new_free);
        $criteria->compare('category3_rank_grossing', $this->category3_rank_grossing);
        $criteria->compare('category4_rank_paid', $this->category4_rank_paid);
        $criteria->compare('category4_rank_free', $this->category4_rank_free);
        $criteria->compare('category4_rank_new_paid', $this->category4_rank_new_paid);
        $criteria->compare('category4_rank_new_free', $this->category4_rank_new_free);
        $criteria->compare('category4_rank_grossing', $this->category4_rank_grossing);
        $criteria->compare('category5_rank_paid', $this->category5_rank_paid);
        $criteria->compare('category5_rank_free', $this->category5_rank_free);
        $criteria->compare('category5_rank_new_paid', $this->category5_rank_new_paid);
        $criteria->compare('category5_rank_new_free', $this->category5_rank_new_free);
        $criteria->compare('category5_rank_grossing', $this->category5_rank_grossing);
        $criteria->compare('category6_rank_paid', $this->category6_rank_paid);
        $criteria->compare('category6_rank_free', $this->category6_rank_free);
        $criteria->compare('category6_rank_new_paid', $this->category6_rank_new_paid);
        $criteria->compare('category6_rank_new_free', $this->category6_rank_new_free);
        $criteria->compare('category6_rank_grossing', $this->category6_rank_grossing);
        $criteria->compare('install_count', $this->install_count, true);
        $criteria->compare('insert_date', $this->insert_date, true);
        $criteria->compare('update_date', $this->update_date, true);
        $criteria->compare('delete_date', $this->delete_date, true);
        $criteria->compare('delete_flag', $this->delete_flag);
        $criteria->compare('seq_no', $this->seq_no);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    /**
     * Get appp by start&end date
     * @param String $start
     * @param String $end
     * @param int $app_id
     * @return type
     */
    public static function getByDate($app_id, $start, $end = null) {
        $criteria = new CDbCriteria;
        $criteria->group = 'DATE(insert_date)';
        $criteria->select = 'app_id, all_rank_paid , all_rank_free, 
            all_rank_new_paid, all_rank_new_free, all_rank_grossing,
            all_game_paid, all_game_free, all_game_new_paid, all_game_new_free, all_game_grossing,
            category1_rank_paid, category1_rank_free, category1_rank_new_paid, category1_rank_new_free, category1_rank_grossing, category2_rank_paid, category2_rank_free, category2_rank_new_paid, category2_rank_new_free, category2_rank_grossing, category3_rank_paid, category3_rank_free, category3_rank_new_paid, category3_rank_new_free, category3_rank_grossing, category4_rank_paid, category4_rank_free, category4_rank_new_paid, category4_rank_new_free, category4_rank_grossing, category5_rank_paid, category5_rank_free, category5_rank_new_paid, category5_rank_new_free, category5_rank_grossing, category6_rank_paid, category6_rank_free, category6_rank_new_paid, category6_rank_new_free, category6_rank_grossing,
            DATE(insert_date) as insert_date, MAX(seq_no)';
        $criteria->condition = "app_id = " . $app_id;
        $criteria->order = "insert_date DESC";
        if (!($end == null || empty($end)))
            $criteria->addBetweenCondition('insert_date', $start, $end);
        else
            $criteria->addCondition('insert_date >= ' . $start);
        var_dump($criteria);

        $model = App::model()->findAll($criteria);
        return $model;
    }

    /**
     * get app Info with specified date
     * @param int $app_id
     * @param String $date
     */
    public static function getByDate2($app_id, $date) {
        $criteria = new CDbCriteria;
        $criteria->select = 'app_id, all_rank_paid , all_rank_free, 
            all_rank_new_paid, all_rank_new_free, all_rank_grossing,
            all_game_paid, all_game_free, all_game_new_paid, all_game_new_free, all_game_grossing,
            category1_rank_paid, category1_rank_free, category1_rank_new_paid, category1_rank_new_free, category1_rank_grossing, category2_rank_paid, category2_rank_free, category2_rank_new_paid, category2_rank_new_free, category2_rank_grossing, category3_rank_paid, category3_rank_free, category3_rank_new_paid, category3_rank_new_free, category3_rank_grossing, category4_rank_paid, category4_rank_free, category4_rank_new_paid, category4_rank_new_free, category4_rank_grossing, category5_rank_paid, category5_rank_free, category5_rank_new_paid, category5_rank_new_free, category5_rank_grossing, category6_rank_paid, category6_rank_free, category6_rank_new_paid, category6_rank_new_free, category6_rank_grossing,
            DATE(insert_date) as insert_date, MAX(seq_no)';

        $criteria->condition = "app_id = " . $app_id . " and DATE(insert_date) = DATE('" . $date . "')";
        $model = App::model()->findAll($criteria);
        return $model;
    }

}