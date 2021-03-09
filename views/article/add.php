<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\Article;
use yii\helpers\ArrayHelper;
//use Yii;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */?>
<?php if(Yii::$app->session->hasFlash('success') ) : ?>
    <?= Yii::$app->session->getFlash('success') ?>
<?php endif; ?>

<?php if(Yii::$app->session->hasFlash('error') ) : ?>
    <?= Yii::$app->session->getFlash('error')?>
<?php endif; ?>
<h2 align='center'>New article!!!</h2>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($article, 'title')?>
<?= $form->field($article, 'summary')->textarea()?>
<?= $form->field($article, 'content')->textarea(['rows' => 5])?>
<?php $categories = ArrayHelper::map($categories, 'id', 'name')?>
<?= $form->field($article, 'categoryId')->dropDownList($categories)->label('Category') ?>
<?php $subcategories = ArrayHelper::map($subcategories, 'id', 'name')?>
<?= $form->field($article, 'subcategoryId')->dropDownList($subcategories)?>
<?php $users = ArrayHelper::map($users, 'id', 'login')?>
<?= $form->field($article, 'authors[]')->dropDownList($users, ['multiple' => true]) ?>
<?= $form->field($article, 'publicationDate')->input('date') ?>
<?= $form->field($article, 'active')->checkbox([1, 0]) ?>
<?= Html::submitButton('Create', ['class' => 'btn btn-success'])?>
<?php $form = ActiveForm::end() ?>
