<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\tables\Tasks */
/* @var $model app\models\tables\Files */

$this->title = 'Create Tasks';
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelFile' => $modelFile
    ]) ?>
</div>
