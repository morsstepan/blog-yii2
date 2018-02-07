<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="container">
    <h1>Edit Profile</h1>
    <hr>
    <div class="row">
        <!-- left column -->
        <div class="col-md-3">
            <div class="text-center">
                <img src="<?= $model->getImage(); ?>" class="avatar img-circle" alt="avatar">
                <h6>Upload a photo...</h6>

                <input type="file" class="form-control">
            </div>
        </div>


        <!-- edit form column -->
        <div class="col-md-9 personal-info">
            <h3>Personal info</h3>

            <form class="form-horizontal" role="form">

                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'patronymic')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>




                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                    <?= Html::submitButton('Cancel', ['class' => 'btn btn-danger']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </form>
        </div>
    </div>
</div>
<hr>