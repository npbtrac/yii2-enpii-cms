<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this enpii\enpiiCms\libs\NpView */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$pageTitle = <?= $generator->generateString('View {modelClass}', ['modelClass' => $generator->generateString(Inflector::camel2words(StringHelper::basename($generator->modelClass)))]) ?> . ' ID: ' . $model-><?= $generator->getNameAttribute() ?>;
$this->setBrowserTitle($pageTitle, 0);

$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::camel2words(StringHelper::basename($generator->modelClass)).' Management') ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'ID: ' . $model-><?= $generator->getNameAttribute() ?>, 'url' => ['view', <?= $urlParams ?>]];
$this->params['breadcrumbs'][] = <?= $generator->generateString('View') ?>;

?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-view">

    <h3 class="page-title"><?= "<?= " ?> Html::encode(<?= $generator->generateString(Inflector::camel2words(StringHelper::basename($generator->modelClass)).' Management') ?>) ?></h3>

    <div class="caption font-green-sharp bold uppercase">
        <span class="caption-subject bold uppercase"><?= "<?= " ?>Html::encode($pageTitle) ?></span>
    </div>

    <p>
        <?= "<?= " ?>Html::a(<?= $generator->generateString('Update') ?>, ['update', <?= $urlParams ?>], ['class' => 'btn btn-primary']) ?>
        <?= "<?= " ?>Html::a(<?= $generator->generateString('Delete') ?>, ['delete', <?= $urlParams ?>], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => <?= $generator->generateString('Are you sure you want to delete?') ?>,
                'method' => 'post',
            ],
        ]) ?>

        <?= "<?= " ?>Html::a('<i class="fa fa-plus"></i> <span class="hidden-480">'.
            <?= $generator->generateString('Create ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>,
            ['create'],
            ['class' => 'btn blue btn-outline pull-right']) ?>
    </p>

    <?= "<?= " ?>DetailView::widget([
        'model' => $model,
        'attributes' => [
<?php
if (($tableSchema = $generator->getTableSchema()) === false) {
    foreach ($generator->getColumnNames() as $name) {
        echo "            '" . $name . "',\n";
    }
} else {
    foreach ($generator->getTableSchema()->columns as $column) {
        $format = $generator->generateColumnFormat($column);
        echo "            '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
    }
}
?>
        ],
    ]) ?>

</div>
