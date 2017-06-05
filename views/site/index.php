<?php

use yii\widgets\ActiveForm;
use yii\bootstrap\Html;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="body-wrapper">
    
    <?php if (yii::$app->session->hasFlash('success')) {?>
        <div class="alert alert-success">
            <?= yii::$app->session->getFlash('success'); ?>
        </div>
    <?php } ?>
     <?php if (yii::$app->session->hasFlash('success1')) {?>
        <div class="alert alert-success">
            <?= yii::$app->session->getFlash('success1'); ?>
        </div>
    <?php } ?>
     <?php if (yii::$app->session->hasFlash('success2')) {?>
        <div class="alert alert-success">
            <?= yii::$app->session->getFlash('success2'); ?>
        </div>
    <?php } ?>
    <div class="container">
        <div class="row">
            <div class="col-md-1">
                
            </div>
            <div class="col-md-10">
                <div class=" row">
                    <div class="center"> <h1>Подать заявку</h1></div>
                    <?php $form = ActiveForm::begin([
//                        'id' => 'form-contact',
                        'enableAjaxValidation' => false,
                        'options' => ['enctype' => 'multipart/form-data','style'=>'background: grey;  padding: 20px 20px;']
                         
                    ]); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'name', ['template' => "{input}{error}"])->label(false)->textInput(array('placeholder' => 'Имя')) ?>
                            </div>
                            <div class=" col-md-6">
                                <?= $form->field($model, 'email', ['inputOptions'=>['placeholder'=>'E-mail', 'class' => 'form-control']])->label(false)->input('email') ?>
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'age', ['inputOptions'=>['placeholder'=>'Возраст (полных лет)', 'class' => 'form-control']])->label(false) ?>
                            </div>
                            <div class=" col-md-6">
                                <?= $form->field($model, 'height', ['inputOptions'=>['placeholder'=>'Рост', 'class' => 'form-control']])->label(false) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'weight', ['inputOptions'=>['placeholder'=>'Вес', 'class' => 'form-control']])->label(false) ?>
                            </div>
                            <div class=" col-md-6">
                                <?= $form->field($model, 'city', ['inputOptions'=>['placeholder'=>'Город проживания', 'class' => 'form-control']])->label(false) ?>
                            </div>
                        </div>
                        <div class="row">
                             <div class="col-md-12">
                            <?php 
                                $model->equip_rent = 0;
                                $model->level_lang = 0;
                            ?>
                            <?= $form->field($model, 'equip_rent', ['inputOptions'=>['class' => 'checkbox-inline check-equip',
                                'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                                ]])->radioList([
                                0 => 'нет',
                                1 => 'да, только камера',
                                2 => 'да, компьютер и камера',
                                ], array('class'=>'check-equip'))->label('Нужна ли техника в аренду',array('class' => 'lable pull-left'))?>
                                 </div>
                            <div class="col-md-12">
                                <?= $form->field($model, 'level_lang', ['inputOptions'=>['class' => 'checkbox-inline check-lang',
                                'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                                ]])->radioList([
                                0 => 'без знания',
                                1 => 'базовый',
                                2 => 'средний',
                                3 => 'высокий',
                                4 => 'превосходный',
                                ])->label('Знание английского', array('class' => 'lable pull-left'))?>
                            </div>
                      </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p class="add_photo">Добавить фото(до 5 шт)</p>
                            </div>
                            <div class="col-md-3">
                                <?= Html::button('Загрузить фото', ['class' => 'btn btn-default uploadButton']) ?>
                                <?= $form->field($image, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*','id'=>'add-photos'])->label(false) ?>
                            </div>
                            <div class="col-md-6">
                                <div class="prev"></div>
                            </div>
                            <div class="ajax-respond"></div>
                        </div>
                        <div class="form-group">
                            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary btn-lg center-block']) ?>
                        </div>
                    <?php ActiveForm::end(); ?>
                    </div>
               </div>
            </div>
            <div class="col-md-1">
                
            </div>
        </div>
    </div>    

</div>
