<?php

class KeywordCodeController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', 'appRank_with_Keyword'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'appRank_with_Keyword'),
				'users'=>array('tuantd'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new KeywordCode;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['KeywordCode']))
		{
                    
                        $id = $this->checkExisted($_POST['KeywordCode']);
                        
                        if($id == 0){
                            $model->attributes=$_POST['KeywordCode'];
                            
                            if($model->save())
				$this->redirect(array('view','id'=>$model->keyword_id));
                        }
                        else                            
                            $this->redirect(array('view','id'=>$id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['KeywordCode']))
		{
			$model->attributes=$_POST['KeywordCode'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->keyword_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('KeywordCode');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new KeywordCode('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['KeywordCode']))
			$model->attributes=$_GET['KeywordCode'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=KeywordCode::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='keyword-code-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        protected function checkExisted($data){
            
            $models = KeywordCode::model()->findAll();
            foreach($models as $model){
                if(strcmp($data['keyword'], $model->keyword) == 0)
                    return $model->keyword_id;
            }
            
            return 0;
        }

                //------------------------------------------------------------------------------------------------------------
        // using Search API
        //------------------------------------------------------------------------------------------------------------
        protected function getResultNumber($data){
            $finder_1 = "\"resultCount\":";
            $finder_1_size = strlen($finder_1);
            $pos_1 = strpos($data, $finder_1) + $finder_1_size;

            $finder_2 = ",";
            $pos_2 = strpos($data, $finder_2);
            $substr = substr($data, $pos_1, $pos_2 - $pos_1);

            return intval($substr);
        }

        protected function getData_by_SearchAPI($country, $keyword, $ID){
            $url = "http://ax.phobos.apple.com.edgesuite.net/WebObjects/MZStoreServices.woa/wa/wsSearch?country=".$country."&entity=software&term=".urlencode($keyword)."&limit=500";
            $curl = curl_init($url);
            if($curl == FALSE)
                return FALSE;

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_TRANSFERTEXT, true);

            $data = curl_exec($curl);
            if($data == FALSE){
                curl_close($curl);
                return FALSE;
            }
            curl_close($curl);

            $results_number = $this->getResultNumber($data);
            if($results_number == 0)
                return FALSE;

            $exploder = "{\"kind\":";
            $results_array = explode($exploder, $data);

            for($i=1; $i<=$results_number; $i++){
                $pos = strpos($results_array[$i], $ID);
                if( $pos == FALSE)
                    continue;
                $ID_size = strlen($ID);
                if(substr($results_array[$i], $pos + $ID_size, 1) != "\"")
                    continue;

                return array($results_array[$i], $i);
            }

        }

        protected function getRank($country, $keyword, $ID){
            $data = $this->getData_by_SearchAPI($country, $keyword, $ID);
            if($data == FALSE)
                return 0;

            $rank = $data[1];
            return $rank;
        }
        
        //------------------------------------------------------------------------------------------------------------
        // Get rank when inputed a keyword
        //------------------------------------------------------------------------------------------------------------
    
        public function actionAppRank_with_Keyword(){
            $models = KeywordCode::model()->findAll();

            foreach($models as $model){
                $key_apps = $model->keywordApps;
                foreach ($key_apps as $key_app) {
                    $appid = $key_app->app_id;
                    $appCode = AppCode::model()->findByPk($appid);
                    $country_id = $appCode->country_id;
                    $countryCode = CountryCode::model()->findByPk($country_id);
                    $country = $countryCode->country_code;
                    
                    $package = $appCode->package_id;
                    
                    $rank = $this->getRank($country, $model->keyword, $package);
                    
                    $appkeyword = new AppKeyword();
                    $appkeyword->creat_AppKeyword($key_app->id, $rank);
                }  
                
            }
        }
}
