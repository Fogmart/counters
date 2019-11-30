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

$lang = Yii::$app->user->isGuest? 'ru' : $usr = Yii::$app->user->identity->lang;

$lang_arr = Yii::$app->params['lang'][$lang];
?>

<div class="wrap">


    <nav id="primary_nav_wrap" class='header'>
        <ul>
            <?php if (Yii::$app->user->isGuest) { ?>
                <li><span><a href="/site/login"><?=$lang_arr['in']?></a></span></li>
            <?php }else {
                if ($usr->isCompany) {
                ?>
                <li><span><?=$lang_arr['obj']?></span>
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
                                    <li>
                                        <a href="/uploadedfiles/addr/<?=$ua?>">
                                            <?=$lang_arr['arc']?>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>

                    </ul>
                </li>
                <?php } else { ?>
                    <li>
                        <span><a href="/user/home"><?=$lang_arr['home']?></a></span>
                    </li>
                <?php }?>
                <?php if (Yii::$app->user->can('admin') ){?>
                    <li>
                        <span>
                            <a href="/user"><?=$lang_arr['usr']?></a>

                        </span>
                    </li>
                    <li>
                        <span><a href="/counter"><?=$lang_arr['ctr']?></a></span>
                    </li>
                    <li>
                        <span><a href="/ftp">FTP</a></span>
                    </li>


                <?php }?>


<!--                <li><span>Архив</span>-->
<!--                    <ul></ul>-->
<!--                </li>-->

                <li><span><a href="/site/logout"><?=$lang_arr['exit']?> </a></span></li>
            <?php } ?>


        </ul>
        <select name="ulang" id="ulang" onchange="chnglang()">
            <option value="ru" <?=$lang=='ru'?'selected':'' ?> >ru</option>
            <option value="en" <?=$lang=='en'?'selected':'' ?>>en</option>

        </select>
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
<script>
    function chnglang() {
        $.post('/user/set-lang',{lang:$("#ulang").val()}, function (data) { document.location.reload() });
    }
</script>

</html>
<?php $this->endPage() ?>


