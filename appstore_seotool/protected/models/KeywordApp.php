<?php

/**
 * This is the model class for table "keyword_app".
 *
 * The followings are the available columns in table 'keyword_app':
 * @property integer $id
 * @property integer $app_id
 * @property integer $keyword_id
 * @property AppKeyword $appKeyword
 * @property AppCode $appCode related app code
 * @property KeywordCode $keywordCode related keyword code
 */
class KeywordApp extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return KeywordApp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'keyword_app';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('app_id, keyword_id', 'required'),
			array('app_id, keyword_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, app_id, keyword_id', 'safe', 'on'=>'search'),
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
                    'appKeyword' => array(self::HAS_ONE, 'AppKeyword', 'keyword_app_id'),
                    'keywordCode' => array(self::BELONGS_TO, 'KeywordCode', 'keyword_id'),
                    'appCode' => array(self::BELONGS_TO, 'AppCode', 'app_id'),
                   
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'app_id' => 'App',
			'keyword_id' => 'Keyword',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('app_id',$this->app_id);
		$criteria->compare('keyword_id',$this->keyword_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}