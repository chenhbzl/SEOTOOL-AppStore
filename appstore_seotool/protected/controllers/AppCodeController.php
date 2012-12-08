<?php

class AppCodeController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
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
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'update_by_SearchAPI', 'creat_by_RSS'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('admin', 'create', 'delete', 'competeKeyword', 'keywordInfo', 'appInfo', 'competeApp', 'appDetail', 'applist'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'create', 'delete', 'competeKeyword', 'keywordInfo', 'appInfo', 'competeApp', 'appDetail', 'applist', 'update_by_SearchAPI'),
                'users' => array('tuantd'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $appCode = $this->loadModel($id);
        $keywordCode = $this->newKeyword($appCode);
        $this->render('view', array(
            'model' => $appCode,
            'keywordCode' => $keywordCode
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new AppCode;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);


        if (isset($_POST['AppCode'])) {
            
            $postedData = $_POST['AppCode'];
            //$this->render('test', array('para' => $postedData['app_name']));
            ;
            //$model->attributes = $_POST['AppCode'];
            if ($this->creat_by_SearchAPI($postedData, $model))
                $this->redirect(array('view', 'id' => $model->app_id));
        }


        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['AppCode'])) {
            $model->attributes = $_POST['AppCode'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->app_id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionAppList() {
        $this->layout = 'column1';
        $appCodes = AppCode::model()->with(
                        array(
                            'countryCode' => array(
                                'select' => 'country_name'
                            ),
                            'categoryCode' => array(
                                'select' => 'category_name'
                            ),
                            'keywordApps' => false,
                            'keywordCodes' => false,
                        )
                )->findAll(
                array(
                    'condition' => 'display_flag = :displayFlag',
                    'params' => array(
                        ':displayFlag' => 1
                )));

        //$countries = CountryCode::model()->findAll();
        $this->render('applist', array(
            'appCodes' => $appCodes,
        ));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('AppCode');
        //layouts/column2
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new AppCode('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['AppCode']))
            $model->attributes = $_GET['AppCode'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * compete keyword page
     * @param type $id app_id
     * 
     */
    public function actionCompeteKeyword($id) {
        /* @var $model AppCode */
        /* @var $keywordApp KeywordApp */
        /* @var $appKeywords AppKeyword */

//Set app_id into SESSION
        Yii::app()->session['app_id'] = $id;
        $this->layout = 'column1';

        $model = AppCode::model()->with(
                        array(
                            'categoryCode' => false,
                            'countryCode' => false,
                        )
                )->findByPk($id);

        $this->render('competekeyword', array(
            'model' => $model
        ));
    }

    public function actionKeywordInfo() {
        $app_id = Yii::app()->session['app_id'];
        //$start = $_POST['startdate'];
        //$end = $_POST['enddate'];

$start = '2012/11/23';
        $end = '2012/12/04';

//        echo json_encode('sao the');
        $model = AppCode::model()->with(
                        array(
                            'categoryCode' => false,
                            'countryCode' => false,
                            'keywordCodes' => false,
                        )
                )->findByPk($app_id);

        //all date
        $startDate = new DateTime($start);
        $endDate = new DateTime($end);
        $endDate = $endDate->modify('+1 day');
        $interval = new DateInterval('P1D');
        $dates = new DatePeriod($startDate, $interval, $endDate);

        //all keywordApps(keyword_id, app_id = 1)
        $keywordApps = $model->keywordApps;


        $result = array();

        //start of graphic data
        $result['graphic'][0][0] = 'insert_date';
        for ($i = 0; $i < sizeof($keywordApps); $i++) {


            //get all AppKeyword info from start-> end
            $appKeywords = AppKeyword::model()->getByDate($start, $end, $keywordApps[$i]->id);
            //List insert date and search view rank only
            $searchViews = CHtml::listData($appKeywords, 'insert_date', 'search_view_rank', 'keyword_app_id');
            $sumKeyCounter = CHtml::listData($appKeywords, 'insert_date', 'sum_key_counter', 'keyword_app_id');

            /*             * *start of graphic data*********************** */
            //set graphic[0] = keywords            
            $keywordCode = $keywordApps[$i]->keywordCode;


            $result['graphic'][0][$i + 1] = $keywordCode->keyword;
            if (isset($searchViews[$keywordApps[$i]->id])) {
                $j = 0;
                foreach ($dates as $date) {
                    $result['graphic'][$j + 1][0] = $date->format('Y-m-d');
                    if (isset($searchViews[$keywordApps[$i]->id][$date->format('Y-m-d')])) {
                        $result['graphic'][$j + 1][$i + 1] = intval($searchViews[$keywordApps[$i]->id][$date->format('Y-m-d')]);
                    }else
                        $result['graphic'][$j + 1][$i + 1] = 0;

                    $j = $j + 1;
                }
            }else {
                $j = 0;
                foreach ($dates as $date) {
                    $result['graphic'][$j + 1][0] = $date->format('Y-m-d');
                    $result['graphic'][$j + 1][$i + 1] = 0;
                    $j = $j + 1;
                }
            }
            /*             * **********end of graphic************ */



            /*             * *start of summary table************************** */
            //set keyword_id
            $result['summary'][$i][0] = $keywordCode->keyword_id;
            //set keyword (text)
            $result['summary'][$i][2] = $keywordCode->keyword;
            //set insert date
            $result['summary'][$i][3] = $keywordCode->insert_date;
            //specify flag
            $result['summary'][$i][8] = $keywordCode->keyword_specify_flag;

            //summary R-S-E
            if (isset($searchViews[$keywordApps[$i]->id])) {
                if (isset($searchViews[$keywordApps[$i]->id][$start])) {
                    //set start day ranking
                    $result['summary'][$i][5] = $searchViews[$keywordApps[$i]->id][$start];
                }else
                //set start day ranking
                    $result['summary'][$i][5] = '0';

                if (isset($searchViews[$keywordApps[$i]->id][$end])) {
//set end day ranking
                    $result['summary'][$i][6] = $searchViews[$keywordApps[$i]->id][$end];
                }else
//set end day ranking
                    $result['summary'][$i][6] = '0';
            }else {
//set start day ranking
                $result['summary'][$i][5] = '0';
//set end day ranking
                $result['summary'][$i][6] = '0';
            }
//caculate dif
            $result['summary'][$i][7] = intval($result['summary'][$i][6]) - intval($result['summary'][$i][5]);

//register day info
            $registrationDate = $keywordCode->insert_date;

            list($regdate, $time) = preg_split('[ ]', $registrationDate);
            $regisAppKeyword = AppKeyword::model()->getByDate2($keywordApps[$i]->id, $registrationDate);
            $regisSearchView = CHtml::listData($regisAppKeyword, 'insert_date', 'search_view_rank', 'keyword_app_id');

            if (isset($regisSearchView[$keywordApps[$i]->id])) {
                if (isset($regisSearchView[$keywordApps[$i]->id][$regdate])) {
                    $result['summary'][$i][4] = $regisSearchView[$keywordApps[$i]->id][$regdate];
                }else
                    $result['summary'][$i][4] = '0';
            }else
                $result['summary'][$i][4] = '0';

            //today info
            $today = date('Y-m-d', time());
            $todayAppKeyword = AppKeyword::model()->getByDate2($keywordApps[$i]->id, $today);
            $todaySearchView = CHtml::listData($todayAppKeyword, 'insert_date', 'search_view_rank', 'keyword_app_id');

            if (isset($todaySearchView[$keywordApps[$i]->id])) {
                if (isset($todaySearchView[$keywordApps[$i]->id][$today])) {
                    $result['summary'][$i][1] = $todaySearchView[$keywordApps[$i]->id][$today];
                }else
                    $result['summary'][$i][1] = '0';
            }else
                $result['summary'][$i][1] = '0';

            ksort($result['summary'][$i]);
            /*             * *end of summary table* */



            /*             * *start of detail table************** */

            $result['detail'][$i][0] = $keywordCode->keyword_id;
            $result['detail'][$i][2] = $keywordCode->keyword;
            $result['detail'][$i][3] = $keywordCode->insert_date;
            $result['detail'][$i][8] = $keywordCode->keyword_specify_flag;

//detail R-S-E
            if (isset($sumKeyCounter[$keywordApps[$i]->id])) {
                if (isset($sumKeyCounter[$keywordApps[$i]->id][$start])) {
//set start day ranking
                    $result['detail'][$i][5] = $sumKeyCounter[$keywordApps[$i]->id][$start];
                }else
//set start day ranking
                    $result['detail'][$i][5] = '0';

                if (isset($sumKeyCounter[$keywordApps[$i]->id][$end])) {
//set end day ranking
                    $result['detail'][$i][6] = $sumKeyCounter[$keywordApps[$i]->id][$end];
                }else
//set end day ranking
                    $result['detail'][$i][6] = '0';
            }else {
//set start day ranking
                $result['detail'][$i][5] = '0';
//set end day ranking
                $result['detail'][$i][6] = '0';
            }
//detail caculate dif
            $result['detail'][$i][7] = intval($result['detail'][$i][6]) - intval($result['detail'][$i][5]);

//detail register day
            $regisSumKeyCounter = CHtml::listData($regisAppKeyword, 'insert_date', 'sum_key_counter', 'keyword_app_id');

            if (isset($regisSumKeyCounter[$keywordApps[$i]->id])) {
                if (isset($regisSumKeyCounter[$keywordApps[$i]->id][$regdate])) {
                    $result['detail'][$i][4] = $regisSumKeyCounter[$keywordApps[$i]->id][$regdate];
                }else
                    $result['detail'][$i][4] = '0';
            }else
                $result['detail'][$i][4] = '0';
//detail today
            $todaySumKeyCounter = CHtml::listData($todayAppKeyword, 'insert_date', 'sum_key_counter', 'keyword_app_id');

            if (isset($todaySumKeyCounter[$keywordApps[$i]->id])) {
                if (isset($todaySumKeyCounter[$keywordApps[$i]->id][$today])) {
                    $result['detail'][$i][1] = $todaySumKeyCounter[$keywordApps[$i]->id][$today];
                }else
                    $result['detail'][$i][1] = '0';
            }else
                $result['detail'][$i][1] = '0';

            ksort($result['detail'][$i]);
            /*             * *end of detail table*************************** */
        }

        echo json_encode($result);
    }

    /**
     * 
     * @param int $id keyword id
     */
    public function actionCompeteApp($id) {
        $keyword_id = $id;
        $this->layout = 'column1';

        if (!isset(Yii::app()->session['app_id'])) {
//            echo 'session not found';
        }
        if (!Yii::app()->request->isAjaxRequest) {
//            echo 'request not found';
        }
        //get app_id from session
        $app_id = Yii::app()->session['app_id'];
        //set keyword id to sesion
        Yii::app()->session['keyword_id'] = $keyword_id;

        $model = AppCode::model()->with(
                        array(
                            'categoryCode' => false,
                            'countryCode' => false,
                        )
                )->findByPk($app_id);

//        $keywordModel = KeywordCode::model()->with(
//                        array(
//                            'appCodes' => false,
//                        )
//                )->findByPk($keyword_id);
//
//        $keywordApps = $keywordModel->keywordApps;
//        $start = '2012/10/23';
//        $end = "2012/11/22";
//        $result = $this->parseAppData($keywordApps, $start, $end);
//        var_dump($result);
        $this->render('competeapp', array(
            'model' => $model,
        ));
    }

    public function actionAppInfo() {
        if (!isset(Yii::app()->session['keyword_id'])) {
            echo 'session not found';
        }
        if (!Yii::app()->request->isAjaxRequest) {
            echo 'request not found';
        }

        $keyword_id = Yii::app()->session['keyword_id'];

        $s = $_POST['startdate'];
        $e = $_POST['enddate'];

//        $s = '2012/11/23';
//        $e = '2012/12/03';
        $start = new DateTime($s);
        $end = new DateTime($e);
        $end = $end->modify('+1 day');
        $interval = new DateInterval('P1D');
        $dates = new DatePeriod($start, $interval, $end);

        $result = array();

        $keywordModel = KeywordCode::model()->with(
                        array(
                            'appCodes' => false,
                        )
                )->findByPk($keyword_id);

        $keywordApps = $keywordModel->keywordApps;
//        var_dump($keywordApps);
        $result['graphic'][0][0] = 'insert_date';
        for ($i = 0; $i < sizeof($keywordApps); $i++) {
            $keywordCode = $keywordApps[$i]->keywordCode;
            $result['graphic'][0][$i + 1] = $keywordCode['keyword'];

            $appKeywords = AppKeyword::model()->getByDate($s, $e, $keywordApps[$i]->id);
            $searchViews = CHtml::listData($appKeywords, 'insert_date', 'search_view_rank', 'keyword_app_id');
            $sumKeyCounter = CHtml::listData($appKeywords, 'insert_date', 'sum_key_counter', 'keyword_app_id');

            if (isset($searchViews[$keywordApps[$i]->id])) {
                $j = 0;
                foreach ($dates as $date) {
                    $result['graphic'][$j + 1][0] = $date->format('Y-m-d');
                    if (isset($searchViews[$keywordApps[$i]->id][$date->format('Y-m-d')])) {
                        $result['graphic'][$j + 1][$i + 1] = intval($searchViews[$keywordApps[$i]->id][$date->format('Y-m-d')]);
                    }else
                        $result['graphic'][$j + 1][$i + 1] = 0;

                    $j = $j + 1;
                }
            }else {
                $j = 0;
                foreach ($dates as $date) {
                    $result['graphic'][$j + 1][0] = $date->format('Y-m-d');
                    $result['graphic'][$j + 1][$i + 1] = 0;
                    $j = $j + 1;
                }
            }

            //get summary table data
            $appCode = $keywordApps[$i]->appCode;
            //set keyword_id
            $result['summary'][$i][0] = $appCode['app_id'];

            //set keyword (text)
            $result['summary'][$i][1] = $appCode['app_name'];

            //set insert date
            $result['summary'][$i][2] = $appCode['version_update_date'];

            //specify flag
            $result['summary'][$i][7] = $appCode['app_specify_flag'];

            //neu app nay co
            if (isset($searchViews[$keywordApps[$i]->id])) {
                if (isset($searchViews[$keywordApps[$i]->id][$start->format('Y-m-d')])) {
                    //set start day ranking
                    $result['summary'][$i][4] = $searchViews[$keywordApps[$i]->id][$start->format('Y-m-d')];
                }else
                //set start day ranking
                    $result['summary'][$i][4] = '0';

                if (isset($searchViews[$keywordApps[$i]->id][$end->format('Y-m-d')])) {
                    //set end day ranking
                    $result['summary'][$i][5] = $searchViews[$keywordApps[$i]->id][$end->format('Y-m-d')];
                }else
                //set end day ranking
                    $result['summary'][$i][5] = '0';
            }else {
                //set start day ranking
                $result['summary'][$i][4] = '0';
                //set end day ranking
                $result['summary'][$i][5] = '0';
            }

            //caculate dif
            $result['summary'][$i][6] = intval($result['summary'][$i][5]) - intval($result['summary'][$i][4]);

            //sumary register day info
            $registrationDate = $keywordCode['insert_date'];

            list($regdate, $time) = preg_split('[ ]', $registrationDate);
            $regisAppKeyword = AppKeyword::model()->getByDate2($keywordApps[$i]->id, $registrationDate);
            $regisSearchView = CHtml::listData($regisAppKeyword, 'insert_date', 'search_view_rank', 'keyword_app_id');

            if (isset($regisSearchView[$keywordApps[$i]->id])) {
                if (isset($regisSearchView[$keywordApps[$i]->id][$regdate])) {
                    $result['summary'][$i][3] = $regisSearchView[$keywordApps[$i]->id][$regdate];
                }else
                    $result['summary'][$i][3] = '0';
            }else
                $result['summary'][$i][3] = '0';


            ksort($result['summary'][$i]);


            /*             * *start of detail table********* */
            $result['detail'][$i][0] = $appCode['app_id'];
            $result['detail'][$i][1] = $appCode['app_name'];
            $result['detail'][$i][2] = $appCode['insert_date'];
            $result['detail'][$i][3] = $appCode['current_version'];
            $result['detail'][$i][4] = $appCode['version_update_date'];

            $result['detail'][$i][9] = $appCode['app_specify_flag'];

            //detail R-S-E
            if (isset($sumKeyCounter[$keywordApps[$i]->id])) {
                if (isset($sumKeyCounter[$keywordApps[$i]->id][$start->format('Y-m-d')])) {
                    //set start day ranking
                    $result['detail'][$i][6] = $sumKeyCounter[$keywordApps[$i]->id][$start->format('Y-m-d')];
                }else
                //set start day ranking
                    $result['detail'][$i][6] = '0';

                if (isset($sumKeyCounter[$keywordApps[$i]->id][$end->format('Y-m-d')])) {
                    //set end day ranking
                    $result['detail'][$i][7] = $sumKeyCounter[$keywordApps[$i]->id][$end->format('Y-m-d')];
                }else
                //set end day ranking
                    $result['detail'][$i][7] = '0';
            }else {
                //set start day ranking
                $result['detail'][$i][6] = '0';
                //set end day ranking
                $result['detail'][$i][7] = '0';
            }
            //detail caculate dif
            $result['detail'][$i][8] = intval($result['detail'][$i][7]) - intval($result['detail'][$i][6]);

            //detail register day
            $regisSumKeyCounter = CHtml::listData($regisAppKeyword, 'insert_date', 'sum_key_counter', 'keyword_app_id');

            if (isset($regisSumKeyCounter[$keywordApps[$i]->id])) {
                if (isset($regisSumKeyCounter[$keywordApps[$i]->id][$regdate])) {
                    $result['detail'][$i][5] = $regisSumKeyCounter[$keywordApps[$i]->id][$regdate];
                }else
                    $result['detail'][$i][5] = '0';
            }else
                $result['detail'][$i][5] = '0';

            ksort($result['detail'][$i]);
        }
        echo json_encode($result);
    }

    /**
     * parse data for ranking tab of app_compete page
     * @param Object $keywordApps 
     * @param array $result return result
     */
    private function parseAppData($keywordApps, $start, $end) {
        /* @var $appCode AppCode */
        for ($i = 0; $i < sizeof($keywordApps); $i++) {

            $app_id = $keywordApps[$i]->app_id;
            $reg = $keywordApps[$i]->appCode->insert_date;

            $app['reg'] = App::model()->getByDate2($app_id, $reg);
            $app['start'] = App::model()->getByDate2($app_id, $start);
            $app['end'] = App::model()->getByDate2($app_id, $end);


            $appCode = $keywordApps[$i]->appCode;

            $result['ranking'][$i][0] = $appCode->app_id;              //app id
            $result['ranking'][$i][1] = $appCode->app_specify_flag;    //flag

            $result['ranking'][$i][2] = $appCode->app_name;            //app name

            $result['ranking'][$i][3] = $appCode->insert_date;         //insert date

            $result['ranking'][$i][4] = $app['reg']->all_rank_paid;
            $result['ranking'][$i][5] = $app['start']->all_rank_paid;
            $result['ranking'][$i][6] = $app['end']->all_rank_paid;
            $result['ranking'][$i][7] = $result['ranking'][$i][6] - $result['ranking'][$i][5];



//            $regisAppKeyword = AppKeyword::model()->getByDate2($keywordApps[$i]->id, $registrationDate);
//            $regisSearchView = CHtml::listData($regisAppKeyword, 'insert_date', 'search_view_rank', 'keyword_app_id');
//
//            if (isset($regisSearchView[$keywordApps[$i]->id])) {
//                if (isset($regisSearchView[$keywordApps[$i]->id][$regdate])) {
//                    $result['summary'][$i][3] = $regisSearchView[$keywordApps[$i]->id][$regdate];
//                }else
//                    $result['summary'][$i][3] = '0';
//            }else
//                $result['summary'][$i][3] = '0';
//            ksort($result['summary'][$i]);
        }

        return $result;
    }

    private function addAttribute($app, $index, $property, $result, $i) {

        $result['ranking'][$i][$index[0]] = $app['reg'][$property];
        var_dump($app['reg'][$property]);
        return $result;
    }

    public function actionAppDetail($id) {
        $this->layout = 'column1';

        $model = $this->loadModel($id);
        $this->render('appdetail', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = AppCode::model()->with(
                        array(
                            'keywordApps' => false,
                        )
                )->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'app-code-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    protected function newKeyword($appCode) {
        /* @var $appCode AppCode */
        $keywordCode = new KeywordCode;
        
        if (isset($_POST['KeywordCode'])) {
            if(($id = $this->checkExisted($_POST['KeywordCode'])) == 0){
                
                $keywordCode->attributes = $_POST['KeywordCode'];
                if ($appCode->addKeywordCode($keywordCode) && $appCode->addRelation($keywordCode)) {
                    Yii::app()->user->setFlash('keywordCodeSubmitted', 'keyword has been added');
                }
                $this->refresh(); 
                
            }
            else{
                $keywordCode = KeywordCode::model()->findByPk($id);
                if($appCode->addRelation($keywordCode))
                    Yii::app()->user->setFlash('keywordCodeSubmitted', 'keyword has been added');
                
                $this->refresh();
            }
        }
        
        return $keywordCode;
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
    protected function getResultNumber($data) {
        $finder_1 = "\"resultCount\":";
        $finder_1_size = strlen($finder_1);
        $pos_1 = strpos($data, $finder_1) + $finder_1_size;

        $finder_2 = ",";
        $pos_2 = strpos($data, $finder_2);
        $substr = substr($data, $pos_1, $pos_2 - $pos_1);

        return intval($substr);
    }

    protected function getData_by_SearchAPI($country, $keyword, $ID) {
        $url = "http://ax.phobos.apple.com.edgesuite.net/WebObjects/MZStoreServices.woa/wa/wsSearch?country=" . $country . "&entity=software&term=" . urlencode($keyword) . "&limit=500";
        $curl = curl_init($url);
        if ($curl == FALSE)
            return FALSE;

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TRANSFERTEXT, true);

        $data = curl_exec($curl);
        if ($data == FALSE) {
            curl_close($curl);
            return FALSE;
        }
        curl_close($curl);

        $results_number = $this->getResultNumber($data);
        if ($results_number == 0)
            return FALSE;

        $exploder = "{\"kind\":";
        $results_array = explode($exploder, $data);

        for ($i = 1; $i <= $results_number; $i++) {
            $pos = strpos($results_array[$i], $ID);
            if ($pos == FALSE)
                continue;
            $ID_size = strlen($ID);
            if (substr($results_array[$i], $pos + $ID_size, 1) != "\"")
                continue;

            return array($results_array[$i], $i);
        }
    }

    protected function getRank($country, $keyword, $ID) {
        $data = $this->getData_by_SearchAPI($country, $keyword, $ID);
        if ($data == FALSE)
            return 0;

        $rank = $data[1];
        return $rank;
    }

    protected function getValue($data, $attribute) {
        $finder_1 = "\"" . $attribute . "\":";
        $finder_1_size = strlen($finder_1);
        $pos_1 = strpos($data, $finder_1);
        if ($pos_1 == FALSE)
            return FALSE;
        $pos_1 += $finder_1_size;

        $substr = substr($data, $pos_1, 1);
        if ($substr == "\"") {
            $pos_1++;
            $pos_2 = strpos($data, "\"", $pos_1);

            return substr($data, $pos_1, $pos_2 - $pos_1);
        } else if ($substr == "[") {
            $pos_1++;
            $pos_2 = strpos($data, "]", $pos_1);
            if ($pos_2 == $pos_1)
                return FALSE;
            $pos_1++;
            $result = array();
            while (1) {
                $pos_3 = strpos($data, "\"", $pos_1);
                array_push($result, substr($data, $pos_1, $pos_3 - $pos_1));
                $pos_1 = $pos_3 + 4;
                if ($pos_1 > $pos_2)
                    break;
            }
            return $result;
        }
        else {
            $pos_2 = strpos($data, ",", $pos_1);
            $pos_3 = strpos($data, "}", $pos_1);
            if ($pos_2 == FALSE && $pos_3 != FALSE)
                return substr($data, $pos_1, $pos_3 - $pos_1);
            else if ($pos_2 != FALSE && $pos_3 == FALSE)
                return substr($data, $pos_1, $pos_2 - $pos_1);
            else if ($pos_2 != FALSE && $pos_3 != FALSE)
                return $pos_2 < $pos_3 ? substr($data, $pos_1, $pos_2 - $pos_1) : substr($data, $pos_1, $pos_3 - $pos_1);
        }
    }

    protected function getDetailInfo($country, $keyword, $ID) {
        $search_result = $this->getData_by_SearchAPI($country, $keyword, $ID);
        if ($search_result == FALSE)
            return FALSE;

        $data = $search_result[0];
        $rank = $search_result[1];

        $package_id = $this->getValue($data, "bundleId");
        $app_name = $this->getValue($data, "trackName");
        $category = $this->getValue($data, "genres");
        $artist_url = $this->getValue($data, "artistViewUrl");
        $artist_name = $this->getValue($data, "artistName");
        $price = $this->getValue($data, "price");
        $current_version = $this->getValue($data, "version");
        $release_date = $this->getValue($data, "releaseDate");
        $supported_devices = $this->getValue($data, "supportedDevices");
        $size = ((int) ($this->getValue($data, "fileSizeBytes") / (1024 * 10.24))) / 100.0;
        $summary = $this->getValue($data, "description");
        $app_icon_60 = $this->getValue($data, "artworkUrl60");
        $app_icon_512 = $this->getValue($data, "artworkUrl512");
        $app_icon_100 = $this->getValue($data, "artworkUrl100");
        $rating = $this->getValue($data, "averageUserRating");
        $rating_count = $this->getValue($data, "userRatingCount");
        $screenshot = $this->getValue($data, "screenshotUrls");

        return array('package_id' => $package_id,
            'app_name' => $app_name,
            'category' => $category,
            'artist_url' => $artist_url,
            'artist_name' => $artist_name,
            'price' => $price,
            'current_version' => $current_version,
            'release_date' => $release_date,
            'supported_devices' => $supported_devices,
            'size' => $size,
            'summary' => $summary,
            'app_icon_60' => $app_icon_60,
            'app_icon_512' => $app_icon_512,
            'app_icon_100' => $app_icon_100,
            'rating' => $rating,
            'rating_count' => $rating_count,
            'screenshot' => $screenshot,
            'rank' => $rank
        );
    }

    protected function creat_by_SearchAPI($data, $model) {

        $countryid = $data['country_id'];
        $countryCode = CountryCode::model()->findByPk($countryid);
        $country = $countryCode->country_code;
        
        $package = $data['package_id'];
        $app_name = $data['app_name'];

        $search_result = $this->getDetailInfo($country, $app_name, $package);

        if ($search_result == FALSE)
            $this->render('test', array('para' => 'Create Unsuccessly !!!'));

        //$model = new AppCode();
        $model->country_id = $countryid;
        
        return $model->fill_attributes($search_result);
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        //if($model->fill_attributes($search_result)){
        //    $this->render('test', array('para' => 'Create Successly !!!'));
        //}
        //else
        //    $this->render('test', array('para' => 'Create Unsuccessly !!!'));
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   
    }

    public function actionUpdate_by_SearchAPI() {
        
        $models = AppCode::model()->findAll();

        foreach ($models as $model) {
            $countryCode = CountryCode::model()->findByPk($model->country_id);
            $country = $countryCode->country_code;

            $package = $model->package_id;
            $app_name = $model->app_name;

            $search_result = $this->getDetailInfo($country, $app_name, $package);

            if ($search_result == FALSE)
                continue;

            $model->fill_attributes($search_result);
            //$this->render('test', array('para' => $model->fill_attributes($search_result)));
            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            //if($model->fill_attributes($search_result))
            //    $this->render('test', array('para' => 'Create Successly !!!'));
            //else
            //    $this->render('test', array('para' => 'Create Unsuccessly !!!'));
            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        }
    }

//------------------------------------------------------------------------------------------------------------
// using RSS
//------------------------------------------------------------------------------------------------------------

    protected function exchangeFeedType($feedtype) {
        if ($feedtype == 1)
            return "toppaidapplications";
        else if ($feedtype == 2)
            return "topfreeapplications";
        else if ($feedtype == 3)
            return "newpaidapplications";
        else if ($feedtype == 4)
            return "newfreeapplications";
        else if ($feedtype == 5)
            return "topgrossingapplications";
    }

    protected function getRank_by_RSS($country, $genre, $ID, $isFree) {
        $ranks = array();
        for ($i = 1; $i <= 5; $i++) {
            if ($isFree && (($i == 1) || ($i == 3))) {
                array_push($ranks, 0);
                continue;
            }
            if (!$isFree && (($i == 2) || ($i == 4))) {
                array_push($ranks, 0);
                continue;
            }

            $url = $genre == 0 ? "https://itunes.apple.com/" . strtolower($country) . "/rss/" . $this->exchangeFeedType($i) . "/limit=300/xml" : "https://itunes.apple.com/" . strtolower($country) . "/rss/" . $this->exchangeFeedType($i) . "/limit=300/genre=" . $genre . "/xml";
            $curl = curl_init($url);
            if ($curl == FALSE)
                return FALSE;

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_TRANSFERTEXT, true);

            $data = curl_exec($curl);
            if ($data == FALSE) {
                curl_close($curl);
                return FALSE;
            }
            curl_close($curl);

            //str_replace("im:", "", $data);
            $exploder = "<entry>";
            $results_array = explode($exploder, $data);

            $r = 0;
            for ($j = 1; $j < count($results_array); $j++) {
                $pos = strpos($results_array[$j], $ID);
                if ($pos == FALSE)
                    continue;
                $ID_size = strlen($ID);
                if (substr($results_array[$j], $pos + $ID_size, 1) != "\"")
                    continue;

                $r = $j;
                break;
            }
            array_push($ranks, $r);
        }

        return $ranks;
    }

    public function actionCreat_by_RSS() {
        $models = AppCode::model()->findAll();

        foreach ($models as $model) {

            $countryCode = CountryCode::model()->findByPk($model->country_id);
            $country = $countryCode->country_code;

            $package = $model->package_id;

            $isFree = $model->price == 0 ? 1 : 0;

            $cate_numbers_array = $model->getRSSEnableArray();

            $rank_array = array();
            $ranks = $this->getRank_by_RSS($country, 0, $package, $isFree);
            if ($ranks == FALSE)
                continue;
            array_push($rank_array, $ranks);

            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            $cate_max = 6;
            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

            $mask = 1;
            for ($i = 0; $i < $cate_max; $i++) {
                if ($cate_numbers_array[$i] == 0) {
                    array_push($rank_array, array(0, 0, 0, 0, 0));
                    continue;
                }

                $ranks = $this->getRank_by_RSS($country, $cate_numbers_array[$i], $package, $isFree);
                if ($ranks == FALSE) {
                    $i = $cate_max;
                    $mask = 0;
                    continue;
                }
                array_push($rank_array, $ranks);
            }

            if ($mask == 0)
                continue;


            $model->creat_App_Model($rank_array);
        }
    }

}

