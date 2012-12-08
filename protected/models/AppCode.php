<?php

/**
 * This is the model class for table "app_code".
 *
 * The followings are the available columns in table 'app_code':
 * @property string $app_id
 * @property string $package_id
 * @property string $app_name
 * @property integer $country_id
 * @property string $category_id
 * @property integer $app_specify_flag
 * @property string $artist_url
 * @property string $artist_name
 * @property string $price
 * @property string $current_version
 * @property string $version_update_date
 * @property string $require_android
 * @property string $size
 * @property string $insert_date
 * @property string $update_date
 * @property string $delete_date
 * @property integer $delete_flag
 * @property integer $display_flag
 * @property string $summary
 * @property string $app_icon
 * @property float $rating rating mean
 * @property int $rating_count rating count
 * @property string $screenshot1
 * @property string $screenshot2
 * @property string $screenshot3
 * @property string $screenshot4
 * @property string $screenshot5
 * @property string $screenshot6
 * @property string $screenshot7
 * @property string $screenshot8
 * @property array $keywordCodes relate keywordCodes
 * @property CountryCode $countryCode countryCode
 * @property CategoryCode $categoryCode cateogry code
 * @property array $appKeywords Description
 * @property array $keywordApps Description
 * 
 * 
 */
class AppCode extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return AppCode the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'app_code';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('package_id,', 'required'),
            array('country_id, app_specify_flag, delete_flag, display_flag', 'numerical', 'integerOnly' => true),
            array('package_id, app_name, artist_name, all_category, require_android', 'length', 'max' => 255),
            array('category_id1, category_id2, category_id3, category_id4, category_id5,  category_id6, price', 'length', 'max' => 10),
            array('current_version, size', 'length', 'max' => 45),
            array('app_icon, screenshot1, screenshot2, screenshot3, screenshot4, screenshot5, screenshot6, screenshot7, screenshot8', 'length', 'max' => 1000),
            array('artist_url, version_update_date, insert_date, update_date, delete_date, summary', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('app_id, package_id, app_name, country_id, all_category, category_id1, category_id2, category_id3, category_id4, category_id5,  category_id6,, app_specify_flag, artist_url, artist_name, price, current_version, version_update_date, require_android, size, insert_date, update_date, delete_date, delete_flag, display_flag, summary, app_icon, screenshot1, screenshot2, screenshot3, screenshot4, screenshot5, screenshot6, screenshot7, screenshot8', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'keywordCodes' => array(self::MANY_MANY, 'KeywordCode', 'keyword_app(app_id, keyword_id)'),
            'apps' => array(self::HAS_MANY, 'App', 'app_id'),
            'countryCode' => array(self::BELONGS_TO, 'CountryCode', 'country_id'),
            'categoryCode' => array(self::BELONGS_TO, 'CategoryCode', 'category_id1'),
            'keywordApps' => array(self::HAS_MANY, 'KeywordApp', 'app_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'app_id' => 'App',
            'package_id' => 'Package',
            'app_name' => 'App Name',
            'all_category' => 'Category',
            'country_id' => 'Country',
            'category_id1' => 'Category1',
            'category_id2' => 'Category2',
            'category_id3' => 'Category3',
            'category_id4' => 'Category4',
            'category_id5' => 'Category5',
            'category_id6' => 'Category6',
            'app_specify_flag' => 'App Specify Flag',
            'artist_url' => 'Artist Url',
            'artist_name' => 'Artist Name',
            'price' => 'Price',
            'current_version' => 'Current Version',
            'version_update_date' => 'Release Date',
            'require_android' => 'Require Android',
            'size' => 'Size',
            'insert_date' => 'Insert Date',
            'update_date' => 'Update Date',
            'delete_date' => 'Delete Date',
            'delete_flag' => 'Delete Flag',
            'display_flag' => 'Display Flag',
            'summary' => 'Summary',
            'app_icon' => 'App Icon',
            'rating' => 'Rating',
            'rating_count' => 'Rating Count',
            'screenshot1' => 'Screenshot1',
            'screenshot2' => 'Screenshot2',
            'screenshot3' => 'Screenshot3',
            'screenshot4' => 'Screenshot4',
            'screenshot5' => 'Screenshot5',
            'screenshot6' => 'Screenshot6',
            'screenshot7' => 'Screenshot7',
            'screenshot8' => 'Screenshot8',
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
        $countryCode = $this->countryCode;

        $criteria->compare('app_id', $this->app_id, true);
        $criteria->compare('package_id', $this->package_id, true);
        $criteria->compare('app_name', $this->app_name, true);
        $criteria->compare('country_id', $this->country_id);
        $criteria->compare('all_category', $this->all_category, true);
        /*$criteria->compare('category_id1', $this->category_id1, true);
        $criteria->compare('category_id2', $this->category_id2, true);
        $criteria->compare('category_id3', $this->category_id3, true);
        $criteria->compare('category_id4', $this->category_id4, true);
        $criteria->compare('category_id5', $this->category_id5, true);
        $criteria->compare('category_id6', $this->category_id6, true);*/
        $criteria->compare('app_specify_flag', $this->app_specify_flag);
        $criteria->compare('artist_url', $this->artist_url, true);
        $criteria->compare('artist_name', $this->artist_name, true);
        $criteria->compare('price', $this->price, true);
        $criteria->compare('current_version', $this->current_version, true);
        $criteria->compare('version_update_date', $this->version_update_date, true);
        $criteria->compare('require_android', $this->require_android, true);
        $criteria->compare('size', $this->size, true);
        $criteria->compare('insert_date', $this->insert_date, true);
        $criteria->compare('update_date', $this->update_date, true);
        $criteria->compare('delete_date', $this->delete_date, true);
        $criteria->compare('delete_flag', $this->delete_flag);
        $criteria->compare('display_flag', $this->display_flag);
        $criteria->compare('summary', $this->summary, true);
        $criteria->compare('app_icon', $this->app_icon, true);
        $criteria->compare('rating', $this->rating, true);
        $criteria->compare('rating_count', $this->rating_count, true);
        $criteria->compare('screenshot1', $this->screenshot1, true);
        $criteria->compare('screenshot2', $this->screenshot2, true);
        $criteria->compare('screenshot3', $this->screenshot3, true);
        $criteria->compare('screenshot4', $this->screenshot4, true);
        $criteria->compare('screenshot5', $this->screenshot5, true);
        $criteria->compare('screenshot6', $this->screenshot6, true);
        $criteria->compare('screenshot7', $this->screenshot7, true);
        $criteria->compare('screenshot8', $this->screenshot8, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    /* @var $keywordCode KeywordCode */

    public function addKeywordCode($keywordCode) {

        $appCodes = $keywordCode->appCodes;
        array_push($appCodes, $this);
        $keywordCode->appCodes = $appCodes;
        return $keywordCode->save();
    }

    public function addRelation($keywordCode) {
        $keywordApp = new KeywordApp();
        $keywordApp->app_id = $this->app_id;
        $keywordApp->keyword_id = $keywordCode->keyword_id;
        return $keywordApp->save();
    }

    public function behaviors() {
        return array(
            'activerecord-relation' => array(
                'class' => 'ext.yiiext.behaviors.activerecord-relation.EActiveRecordRelationBehavior',
            ),
        );
    }

    protected function beforeValidate() {
        if ($this->isNewRecord) {
            $this->insert_date = new CDbExpression('NOW()');
        }
        $this->update_date = new CDbExpression('NOW()');
        return true;
    }
    
    //------------------------------------------------------------------------------
    public function  fill_attributes($search_result){
  
        $this->package_id = $search_result['package_id'];
        $this->app_name = $search_result['app_name'];       
       
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        $cate_max = 6;
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        
        $cates = $search_result['category'];
        $cate_size = count($cates);
        $cate_ids = array();
        $all_cate = array();
        for($i=0; $i<$cate_max; $i++){
            if($i<$cate_size){
                $cate = CategoryCode::model()->findByAttributes(array('category_name' => $cates[$i]));
                array_push($all_cate, $cate->category_name);
                array_push($cate_ids, $cate->category_id);
            }
            else
                array_push($cate_ids, 0);
        }
        
        $this->all_category = implode(", ", $all_cate);
        $this->category_id1 = $cate_ids[0];
        $this->category_id2 = $cate_ids[1];
        $this->category_id3 = $cate_ids[2];
        $this->category_id4 = $cate_ids[3];
        $this->category_id5 = $cate_ids[4];
        $this->category_id6 = $cate_ids[5];
        
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        $this->app_specify_flag = 1;
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        
        $this->artist_url = $search_result['artist_url'];
        $this->artist_name = $search_result['artist_name'];
        $this->price = $search_result['price'];
        $this->current_version = $search_result['current_version'];
        $this->version_update_date = $search_result['release_date'];
        
        $supported_devices = implode(" & ", $search_result['supported_devices']);
        $this->require_android = $supported_devices;
        
        $this->size = $search_result['size'];
        $this->summary = $search_result['summary'];
        $this->app_icon = $search_result['app_icon_512'];
        $this->rating = $search_result['rating'];
        $this->rating_count = $search_result['rating_count'];
        
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        $screenshot_max = 8;
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        
        $screen = $search_result['screenshot'];
        $screen_size = count($screen);
 
        for($i=$screen_size; $i<$screenshot_max; $i++)
            array_push($screen, "");
        
        $this->screenshot1 = $screen[0];
        $this->screenshot2 = $screen[1];
        $this->screenshot3 = $screen[2];
        $this->screenshot4 = $screen[3];
        $this->screenshot5 = $screen[4];
        $this->screenshot6 = $screen[5];
        $this->screenshot7 = $screen[6];
        $this->screenshot8 = $screen[7];
        
        return $this->save();
    }
    
    public function getRSSEnableArray(){
        $cate_ids = array($this->category_id1, $this->category_id2, $this->category_id3, $this->category_id4, $this->category_id5, $this->category_id6);
        
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        $cate_max = 6;
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        
        $enable_array = array();
        for($i=0; $i<$cate_max; $i++){
            if($cate_ids[$i] == 0){
                array_push($enable_array, 0);
                continue;;
            }
            
            $cate = CategoryCode::model()->findByPk($cate_ids[$i]);
            if($cate->rss_enable)
                array_push($enable_array, $cate->category_number);
            else
                array_push($enable_array, 0);
        }
        
        return $enable_array;
    }
    
    public function creat_App_Model($rank_array){
        
        $model = new App();
        if ($model->isNewRecord) {
            $model->insert_date = new CDbExpression('NOW()');
        }
        $model->update_date = new CDbExpression('NOW()');
        
        $model->app_id = $this->app_id;
        
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        $cate_max = 6;
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        
        $ranks = $rank_array[0];
        $model->all_rank_paid = $ranks[0];
        $model->all_rank_free = $ranks[1];
        $model->all_rank_new_paid = $ranks[2];
        $model->all_rank_new_free = $ranks[3];
        $model->all_rank_grossing = $ranks[4];
        
        $ranks = $rank_array[1];
        $model->category1_rank_paid = $ranks[0];
        $model->category1_rank_free = $ranks[1];
        $model->category1_rank_new_paid = $ranks[2];
        $model->category1_rank_new_free = $ranks[3];
        $model->category1_rank_grossing = $ranks[4];
        
        $ranks = $rank_array[2];
        $model->category2_rank_paid = $ranks[0];
        $model->category2_rank_free = $ranks[1];
        $model->category2_rank_new_paid = $ranks[2];
        $model->category2_rank_new_free = $ranks[3];
        $model->category2_rank_grossing = $ranks[4];
        
        $ranks = $rank_array[3];
        $model->category3_rank_paid = $ranks[0];
        $model->category3_rank_free = $ranks[1];
        $model->category3_rank_new_paid = $ranks[2];
        $model->category3_rank_new_free = $ranks[3];
        $model->category3_rank_grossing = $ranks[4];
        
        $ranks = $rank_array[4];
        $model->category4_rank_paid = $ranks[0];
        $model->category4_rank_free = $ranks[1];
        $model->category4_rank_new_paid = $ranks[2];
        $model->category4_rank_new_free = $ranks[3];
        $model->category4_rank_grossing = $ranks[4];
        
        $ranks = $rank_array[5];
        $model->category5_rank_paid = $ranks[0];
        $model->category5_rank_free = $ranks[1];
        $model->category5_rank_new_paid = $ranks[2];
        $model->category5_rank_new_free = $ranks[3];
        $model->category5_rank_grossing = $ranks[4];
        
        $ranks = $rank_array[6];
        $model->category6_rank_paid = $ranks[0];
        $model->category6_rank_free = $ranks[1];
        $model->category6_rank_new_paid = $ranks[2];
        $model->category6_rank_new_free = $ranks[3];
        $model->category6_rank_grossing = $ranks[4];
        
        return $model->save();
    }

}
