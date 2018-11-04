<?php

use yii\helpers\Html;
use app\assets\TasksAsset;

/* @var $this yii\web\View */
/* @var $model app\models\tables\Tasks */

$this->title = 'Update Tasks: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

TasksAsset::register($this);
?>
<div class="tasks-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelFile' => $modelFile
    ]) ?>

</div>
