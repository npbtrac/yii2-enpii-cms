<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yii\helpers\Html;

/* @var $this enpii\enpiiCms\libs\NpView */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$pageTitle = <?= $generator->generateString('Update {modelClass}', ['modelClass' => $generator->generateString(Inflector::camel2words(StringHelper::basename($generator->modelClass)))]) ?> . ' ID: ' . $model-><?= $generator->getNameAttribute() ?>;
$this->setBrowserTitle($pageTitle, 0);

$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::camel2words(StringHelper::basename($generator->modelClass)).' Management') ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model-><?= $generator->getNameAttribute() ?>, 'url' => ['view', <?= $urlParams ?>]];
$this->params['breadcrumbs'][] = <?= $generator->generateString('Update') ?>;

?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-update">

    <h3 class="page-title">
        <?= "<?= " ?> Html::encode(<?= $generator->generateString(Inflector::camel2words(StringHelper::basename($generator->modelClass)).' Management') ?>) ?>
    </h3>

    <?= "<?= " ?>$this->render('_form', [
        'model' => $model,
        'pageTitle' => $pageTitle,
    ]) ?>

</div>
