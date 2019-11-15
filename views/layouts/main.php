<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody();
$usr = Yii::$app->user->identity;
?>

<div class="wrap">
    <nav id="primary_nav_wrap">
        <ul>
            <?php if (Yii::$app->user->isGuest) { ?>
                <li><span><a href="/site/login">Вход</a></span></li>
            <?php }else {
                if ($usr->isCompany) {
                ?>
                <li><span>Объект</span>
                    <ul>
                        <?php foreach ( $usr->usrAddrs as $ua ) {
                            ?>
                            <li><span><?=$ua?></span>
                                <ul>
                                    <?php foreach ( \app\models\Addr::getApartments($ua) as $a )
                                        if ($a->apartment) { ?>
                                        <li><span><?=$a->apartment?></span>
                                            <ul>
                                                <?php foreach ( $a->counters as $c ) { ?>
                                                    <li><span>
                                                            <a href="/counter/<?=$c->id?>">
                                                                <?=$c->typeN->name?>
                                                            </a>
                                                        </span>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>

                    </ul>
                </li>
                <?php } else { ?>
                    <li>
                        <span><a href="/user/home">Моя страница</a></span>
                    </li>
                <?php }?>
                <?php if (Yii::$app->user->can('admin') ){?>
                    <li>
                        <span>
                            <a href="/user">Пользователи</a>

                        </span>
                    </li>
                    <li>
                        <span><a href="/ftp">FTP</a></span>
                    </li>

                <?php }?>


<!--                <li><span>Архив</span>-->
<!--                    <ul></ul>-->
<!--                </li>-->

                <li><span><a href="/site/logout">Выход </a></span></li>
            <?php } ?>


        </ul>
    </nav>



    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>




<footer class="footer">
    <div class="container">

    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
