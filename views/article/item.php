<?php
use yii\helpers\Html;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<h3 align="center"><?= $article['title']?></h3>
<p><?= $article['summary'] ?></p>
<i><?= $article['content']?></i>
<p><?= $article->categories['name'] ?></p>
<p><?= $article->subcategories['name']?></p>
<?php if($article['active']) : ?>
    <p><?= 'Article is active' ?></p>
<?php else : ?>
<p><?= 'Article is not active'?></p>
<?php endif; ?>
<?= Html::a(' Edit', ['article/edit', 'id' => $article['id']], ['class' => 'btn btn-success']),
    Html::a('Delete', ['article/delete', 'id' => $article['id']], ['class' => 'btn btn-danger']) ?>



