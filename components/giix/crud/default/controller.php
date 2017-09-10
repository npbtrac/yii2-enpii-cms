<?php
/**
 * This is the template for generating a CRUD controller class file.
 */

use yii\db\ActiveRecordInterface;
use yii\helpers\StringHelper;


/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$controllerClass = StringHelper::basename($generator->controllerClass);
$modelClass = StringHelper::basename($generator->modelClass);
$searchModelClass = StringHelper::basename($generator->searchModelClass);
if ($modelClass === $searchModelClass) {
    $searchModelAlias = $searchModelClass . 'Search';
}

/* @var $class ActiveRecordInterface */
$class = $generator->modelClass;
$pks = $class::primaryKey();
$urlParams = $generator->generateUrlParams();
$actionParams = $generator->generateActionParams();
$actionParamComments = $generator->generateActionParamComments();

echo "<?php\n";
?>

namespace <?= StringHelper::dirname(ltrim($generator->controllerClass, '\\')) ?>;

use Yii;
use <?= ltrim($generator->modelClass, '\\') ?>;
<?php if (!empty($generator->searchModelClass)): ?>
use <?= ltrim($generator->searchModelClass, '\\') . (isset($searchModelAlias) ? " as $searchModelAlias" : "") ?>;
<?php else: ?>
use yii\data\ActiveDataProvider;
<?php endif; ?>
use <?= ltrim($generator->baseControllerClass, '\\') ?>;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use enpii\enpiiCms\helpers\ArrayHelper;
use enpii\enpiiCms\helpers\DateTimeHelper;
use enpii\enpiiCms\helpers\CommonHelper;

/**
 * <?= $controllerClass ?> implements the CRUD actions for <?= $modelClass ?> model.
 */
class <?= $controllerClass ?> extends <?= StringHelper::basename($generator->baseControllerClass) . "\n" ?>
{
    public function behaviors()
    {
        $parentOneBehaviors = parent::behaviors();
        $thisOneBehaviors = [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
        return ArrayHelper::merge($parentOneBehaviors, $thisOneBehaviors);
    }

    /**
     * Lists all <?= $modelClass ?> models.
     * @return mixed
     */
    public function actionIndex()
    {
<?php if (!empty($generator->searchModelClass)): ?>
        $searchModel = new <?= isset($searchModelAlias) ? $searchModelAlias : $searchModelClass ?>();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
<?php else: ?>
        $dataProvider = new ActiveDataProvider([
            'query' => <?= $modelClass ?>::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
<?php endif; ?>
    }

    /**
     * Displays a single <?= $modelClass ?> model.
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return mixed
     */
    public function actionView(<?= $actionParams ?>)
    {
        return $this->render('view', [
            'model' => $this->findModel(<?= $actionParams ?>),
        ]);
    }

    /**
     * Create a new <?= $modelClass ?> model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new <?= $modelClass ?>();

        if ($model->load(Yii::$app->request->post())) {
            $model->is_deleted = 0;
            $model->created_at = DateTimeHelper::toDbFormat();
            $model->updated_at = DateTimeHelper::toDbFormat();

            $model->status = User::_STATUS_PUBLISHED;
            if ($model->status == User::_STATUS_PUBLISHED) {
                $model->published_at = DateTimeHelper::toDbFormat();
            }

            if ($model->save()) {
                Yii::$app->session->addFlash('success', <?= $generator->generateString('Data created successfully.') ?>);
                return $this->redirect(['view', <?= $urlParams ?>]);
            } else {
                Yii::$app->session->addFlash('error', <?= $generator->generateString('Data created unsuccessfully. Please recheck the input.') ?>);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing <?= $modelClass ?> model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return mixed
     */
    public function actionUpdate(<?= $actionParams ?>)
    {
        $model = $this->findModel(<?= $actionParams ?>);

        if ($model->load(Yii::$app->request->post())) {
            $model->updated_at = DateTimeHelper::toDbFormat();

            if ($model->status == <?= $modelClass ?>::_STATUS_PUBLISHED) {
                $model->published_at = DateTimeHelper::toDbFormat();
            }

            if ($model->save()) {
                Yii::$app->session->addFlash('success', <?= $generator->generateString('Data updated successfully.') ?>);
            } else {
                Yii::$app->session->addFlash('error', <?= $generator->generateString('Data updated unsuccessfully. Please recheck the input.') ?>);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing <?= $modelClass ?> model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return mixed
     */
    public function actionDelete(<?= $actionParams ?>)
    {
        if ($this->findModel($id)->putToTrash()) {
            Yii::$app->session->addFlash('success', <?= $generator->generateString('Data deleted successfully.') ?>);
        } else {
            Yii::$app->session->addFlash('error', <?= $generator->generateString('Data deleted unsuccessfully.') ?>);
        }

        $queryParams = Yii::$app->request->getQueryParams();
        $indexUrlQueryParams = ArrayHelper::merge([0 => 'index'], $queryParams);

        return $this->redirect($indexUrlQueryParams);
    }

    /**
     * Finds the <?= $modelClass ?> model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return <?=                   $modelClass ?> the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(<?= $actionParams ?>)
    {
<?php
if (count($pks) === 1) {
    $condition = '$id';
} else {
    $condition = [];
    foreach ($pks as $pk) {
        $condition[] = "'$pk' => \$$pk";
    }
    $condition = '[' . implode(', ', $condition) . ']';
}
?>
        if (($model = <?= $modelClass ?>::findOne(<?= $condition ?>)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(<?= $generator->generateString('The requested item does not exist.') ?>);
        }
    }

    /**
    * Bulk action on selected items
    * @return \yii\web\Response
    */
    public function actionBulk()
    {
        $action = Yii::$app->request->post('bulk-option');
        $selection = (array)Yii::$app->request->post('selection');

        $queryParams = Yii::$app->request->getQueryParams();
        $indexUrlQueryParams = ArrayHelper::merge([0 => 'index'], $queryParams);

        if (count($selection) > 0) {
            $arrIDSuccess = [];
            $arrIDFail = [];

            foreach ($selection as $id) {
                $result = false;
                if ($action == 'delete') {
                    $strAction = <?= $generator->generateString('Execute Bulk Deletion.') ?>;
                    $result = $this->findModel($id)->putToTrash();
                }
                if ($result) {
                    $arrIDSuccess[] = $id;
                } else {
                    $arrIDFail[] = $id;
                }
            }

            $strAction = empty($strAction) ? '' : $strAction . ' ';

            if (count($arrIDSuccess) > 0) {
                Yii::$app->session->addFlash('success',
                $strAction . <?= $generator->generateString('Total {num} item(s) successfully affected: {items}.',
    ['num' => 'count($arrIDSuccess)', 'items' => "implode(', ', \$arrIDSuccess)"]) ?>);
            }

            if (count($arrIDFail) > 0) {
                Yii::$app->session->addFlash('error', $strAction . <?= $generator->generateString('Total {num} item(s) failed: {items}.',
    ['num' => 'count($arrIDFail)', 'items' => "implode(', ', \$arrIDFail)"]) ?>);
            }

        } else {
            Yii::$app->session->addFlash('warning', <?= $generator->generateString('No items selected') ?>);
        }

        return $this->redirect($indexUrlQueryParams);
    }
}
