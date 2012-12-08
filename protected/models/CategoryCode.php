<?php

/**
 * This is the model class for table "category_code".
 *
 * The followings are the available columns in table 'category_code':
 * @property integer $category_id
 * @property string $category_name
 * @property string $sg_name
 * @property string $us_name
 * @property string $my_name
 * @property string $th_name
 * @property string $in_name
 * @property string $kr_name
 * @property string $za_name
 * @property string $cn_name
 * @property string $nz_name
 * @property string $vn_name
 * @property string $au_name
 * @property string $ph_name
 * @property string $tw_name
 * @property string $id_name
 * @property string $hk_name
 * @property string $ca_name
 * @property string $jp_name
 */
class CategoryCode extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CategoryCode the static model class
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
		return 'category_code';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('rss_enable, category_number', 'required'),
                        array('rss_enable', 'length', 'max'=>2),
                        array('category_number', 'length', 'max'=>10),
			array('category_name', 'length', 'max'=>255),
			array('sg_name, us_name, my_name, th_name, in_name, kr_name, za_name, cn_name, nz_name, vn_name, au_name, ph_name, tw_name, id_name, hk_name, ca_name, jp_name', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('category_id, category_name, rss_enable, category_number, sg_name, us_name, my_name, th_name, in_name, kr_name, za_name, cn_name, nz_name, vn_name, au_name, ph_name, tw_name, id_name, hk_name, ca_name, jp_name', 'safe', 'on'=>'search'),
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
			'category_id' => 'Category',
			'category_name' => 'Category Name',
                        'category_number' => 'Category Number',
                        'rss_enable' => 'RSS Enable',
			'sg_name' => 'Sg Name',
			'us_name' => 'Us Name',
			'my_name' => 'My Name',
			'th_name' => 'Th Name',
			'in_name' => 'In Name',
			'kr_name' => 'Kr Name',
			'za_name' => 'Za Name',
			'cn_name' => 'Cn Name',
			'nz_name' => 'Nz Name',
			'vn_name' => 'Vn Name',
			'au_name' => 'Au Name',
			'ph_name' => 'Ph Name',
			'tw_name' => 'Tw Name',
			'id_name' => 'Id Name',
			'hk_name' => 'Hk Name',
			'ca_name' => 'Ca Name',
			'jp_name' => 'Jp Name',
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

		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('category_name',$this->category_name,true);
                $criteria->compare('category_number',$this->category_number,true);
                $criteria->compare('rss_enable',$this->rss_enable,true);
		$criteria->compare('sg_name',$this->sg_name,true);
		$criteria->compare('us_name',$this->us_name,true);
		$criteria->compare('my_name',$this->my_name,true);
		$criteria->compare('th_name',$this->th_name,true);
		$criteria->compare('in_name',$this->in_name,true);
		$criteria->compare('kr_name',$this->kr_name,true);
		$criteria->compare('za_name',$this->za_name,true);
		$criteria->compare('cn_name',$this->cn_name,true);
		$criteria->compare('nz_name',$this->nz_name,true);
		$criteria->compare('vn_name',$this->vn_name,true);
		$criteria->compare('au_name',$this->au_name,true);
		$criteria->compare('ph_name',$this->ph_name,true);
		$criteria->compare('tw_name',$this->tw_name,true);
		$criteria->compare('id_name',$this->id_name,true);
		$criteria->compare('hk_name',$this->hk_name,true);
		$criteria->compare('ca_name',$this->ca_name,true);
		$criteria->compare('jp_name',$this->jp_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}