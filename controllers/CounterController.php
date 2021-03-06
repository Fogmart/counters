<?php

namespace app\controllers;

use Yii;
use app\models\Counter;
use app\models\CounterSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CounterController implements the CRUD actions for Counter model.
 */
class CounterController extends LangController
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
                        'actions'=>['view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions'=>['index', 'delete','create','update'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],

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
     * Lists all Counter models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CounterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Counter model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        date_default_timezone_set('UTC');
        $c = $this->findModel($id);
        if(Yii::$app->request->isPost) {
            $begdt = Yii::$app->request->post("begdt");
            $begdt = explode(".",$begdt);
            $c->begdt = mktime(0, 0, 0, $begdt[1], $begdt[0], $begdt[2]);

            $enddt = Yii::$app->request->post("enddt");
            $enddt = explode(".",$enddt);
            $c->enddt = mktime(0, 0, 0, $enddt[1], $enddt[0], $enddt[2]);
        } else {
            $c->begdt = strtotime(date('Y-m-01'));
            $c->enddt = strtotime(date('Y-m-d'));
        }



        return $this->render('view', [
            'model' => $c,
        ]);
    }

    /**
     * Creates a new Counter model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Counter();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Counter model.
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
     * Deletes an existing Counter model.
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
     * Finds the Counter model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Counter the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Counter::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


}
