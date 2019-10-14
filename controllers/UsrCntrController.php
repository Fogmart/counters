<?php

namespace app\controllers;

use app\models\Counter;
use app\models\UsrCntr;
use Yii;

class UsrCntrController extends \yii\web\Controller
{
    public function actionAdd(){
        $post = Yii::$app->request->post();
        $u = new UsrCntr();
        $u->usrid = $post["usrid"];
        $u->num = $post["num"];
        $u->type = $post["type"];

        $u->save();
    }

    public function actionCnfrm(){
        $post = Yii::$app->request->post();
        $u = UsrCntr::find()->where(['id'=>$post['id']])->one();
        $u->confirm();
    }
}
