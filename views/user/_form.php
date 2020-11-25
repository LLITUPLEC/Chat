<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form ActiveForm */
?>


<div class="user-form">

    <?php $form = ActiveForm::begin([
//        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-4\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-4 control-label'],
        ],
    ]); ?>

    <div class="col" style="display: flex">
        <div  class="col-lg-6">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?php  //Отображаем поля только при СОЗДАНИИ нового работника
            if (Yii::$app->request->pathInfo == 'user/create') {
                echo $form->field($model, 'password')->passwordInput();
            };
            ?>

            <?= $form->field($model, 'first_name')->textInput() ?>
            <?= $form->field($model, 'last_name')->textInput() ?>
            <?= $form->field($model, 'third_name')->textInput() ?>
            <?= $form->field($model, 'email')->textInput() ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'date_birth')->textInput(['type' => 'date']) ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
