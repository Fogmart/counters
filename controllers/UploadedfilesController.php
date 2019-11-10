<?php

namespace app\controllers;

use app\models\Addr;
use app\models\Counter;
use app\models\CtTypes;
use app\models\Ftp;
use Yii;
use app\models\Uploadedfiles;
use app\models\UploadedfilesSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UploadedfilesController implements the CRUD actions for Uploadedfiles model.
 */
class UploadedfilesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions'=>['index', 'delete','create','update', 'view', 'tst'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions'=>['load-ftp'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]

                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Uploadedfiles models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UploadedfilesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Uploadedfiles model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Uploadedfiles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {


        if (Yii::$app->request->isPost) {
            date_default_timezone_set('UTC');

            foreach ($_FILES as $f) {
                Uploadedfiles::saveFiles($f);
            }
            return $this->actionIndex();
        }

        $model = new Uploadedfiles();
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Uploadedfiles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Uploadedfiles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Uploadedfiles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Uploadedfiles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Uploadedfiles::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionLoadFtp()
    {
        foreach (Ftp::getLst() as $ftp){
            $conn_id = ftp_connect($ftp->ip);
            if (ftp_login($conn_id, $ftp->user_name, $ftp->user_pass)) {
                $contents = ftp_nlist($conn_id, ".");
                foreach ($contents as $c) {
                    if (in_array($c, array("./.", "./.."))) continue;
                    $fname = str_replace("./", "", $c);
                    if (!Uploadedfiles::isLoaded($fname)) {
                        $local_file = str_replace("./", "../csv/", $c);
                        ftp_get($conn_id, $local_file, $c, FTP_ASCII);
                    }
                }
            }
        }
        $dir = "../csv/";
        $cdir = scandir($dir);
        $files = [];
        foreach ($cdir as $value) {
            if (!in_array($value,array(".", ".."))){
                $files[] = $value;
            }
        }

        foreach ($files as $file){
            Uploadedfiles::saveFile($file, $dir.$file);
        }
    }

}
