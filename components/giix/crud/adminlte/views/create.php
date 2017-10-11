<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>

use enpii\enpiiCms\libs\override\helpers\NpHtml as Html;
use enpii\enpiiCms\libs\override\web\NpView as View;
use <?= ltrim($generator->searchModelClass, '\\') ?> as <?= StringHelper::basename($generator->modelClass) ?>;


/* @var View $this */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$pageTitle = <?= $generator->generateString('Create ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>;
$this->setBrowserTitle($pageTitle, 0);

$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::camel2words(StringHelper::basename($generator->modelClass)).' Management') ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $pageTitle;

?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-create">

    <h3 class="page-title">
        <?= "<?= " ?> Html::encode(<?= $generator->generateString(Inflector::camel2words(StringHelper::basename($generator->modelClass)).' Management') ?>) ?>
    </h3>

    <?= "<?= " ?>$this->render('_form', [
        'model' => $model,
        'pageTitle' => $pageTitle,
    ]) ?>

</div>
