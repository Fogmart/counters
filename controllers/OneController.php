<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class OneController extends Controller
{
    public function actionDel(){
        unlink(Yii::getAlias('@app')."/controllers/1CounterController.php");
    }
}
