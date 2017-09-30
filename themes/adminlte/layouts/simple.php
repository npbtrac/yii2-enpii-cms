<?php
/**
 * Created by PhpStorm.
 * Author: npbtrac@yahoo.com
 * Date time: 9/29/17 2:58 PM
 */

use yii\helpers\Html;
use enpii\enpiiCms\libs\override\web\NpView as View;

\yii\web\JqueryAsset::register($this);
\yii\bootstrap\BootstrapAsset::register($this);
\yii\jui\JuiAsset::register($this);
\enpii\enpiiCms\assets\fontawesome\FontAwesomeAsset::register($this);
\enpii\enpiiCms\assets\ionicons\IoniconsAsset::register($this);
\enpii\enpiiCms\assets\adminlte\AdminLteAsset::register($this);
\enpii\enpiiCms\assets\icheck\IcheckAsset::register($this);

/* @var View $this */
/* @var string $content */

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= $this->title ?></title>
    <meta name="description"
          content="<?= $this->description ?>"/>

    <meta name="keywords"
          content="<?= $this->keywords ?>"/>

    <?php $this->head() ?>
    <style>

    </style>
</head>
<body class="<?= $this->getBodyClass() ?> hold-transition simple">
<?php $this->beginBody() ?>
<div class="main-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
</div>


<?= \enpii\enpiiCms\libs\override\widgets\NpBootstrapAlertWidget::widget() ?>

<?= $content ?>

<?= $this->render('_footer') ?>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
