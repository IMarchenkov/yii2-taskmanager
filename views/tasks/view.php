<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\widgets\Documents;

/* @var $this yii\web\View */
/* @var $model app\models\tables\Tasks */

$this->title = $model->name;

if (!$listView) {
    $this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
}
\yii\web\YiiAsset::register($this);
?>
<div class="tasks-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (!$listView): ?>
        <p><?= Html::a('Back to Calendar', ['index']) ?></p>
    <?php endif; ?>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?php if ($listView) {
            echo Html::a('View', ['view', 'id' => $model->id], [
                'class' => 'btn btn-success',
            ]);
        } ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'date',
            'date_end',
            'description:ntext',
            'user_id',
        ],
    ]) ?>

    <?= Documents::widget([
        'documents' => $model->documents
    ]); ?>

</div>
