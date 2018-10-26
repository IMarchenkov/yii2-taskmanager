<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \app\models\tables\Users;

/* @var $this yii\web\View */
/* @var $model app\models\tables\Tasks */
/* @var $form yii\widgets\ActiveForm */
$this->registerJs(
    "$('#tasks-date').on('change', function(){
        var date = $('#tasks-date').val();
            if($('#tasks-date_end').val() < date){
                 $('#tasks-date_end').val(date);
                 $('#tasks-date_end').attr('value', date);
            }
        });"
);
?>

<div class="tasks-form">
    <?php $form = ActiveForm::begin(); ?>

    <?php $users = Users::find()->select(['id', 'username'])->all(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->widget(\yii\jui\DatePicker::class, [
        'model' => $model,
        'attribute' => 'date',
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd'
    ]); ?>

    <?= $form->field($model, 'date_end')->widget(\yii\jui\DatePicker::class, [
        'model' => $model,
        'attribute' => 'date_end',
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd'
    ]); ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'user_id')->dropDownList(\yii\helpers\ArrayHelper::map($users, 'id', 'username')) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
