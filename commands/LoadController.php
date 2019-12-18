<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\Ftp;
use yii\console\Controller;
use yii\console\ExitCode;


class LoadController extends Controller
{

    public function actionIndex()
    {
        Ftp::LoadData();
        return ExitCode::OK;
    }
}
