<?php
use yii\helpers\Html;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//print "This is fantastic!";
$this->title = "Article!";

if (!empty($articles)):
    foreach($articles as $article) : ?>
    <ul id="headlines">
        <li class='<?php echo $article['id']?>'>
            <h2>
                <span class="pubDate">
                    <?php echo $article['publicationDate']?>
                </span class='title'>
                    <?= Html::a($article['title'], ['article/item', 'id' => $article['id']]) ?>
                <span class="category">
                    category
                    <?= Html::a($article->categories['name'], ['article/index']) ?>
                    </br>
                    subcategory
                    <?= Html::a($article->subcategories['name'], ['article/index']) ?>
                    </br>
                        author(s)
                    <?php
                        if (!empty($article->authors)) {
                            foreach ($article->authors as $author) {
                                echo Html::a($author['login'], '/'), " ";
                            }
                        }else echo "This article has not author!";
                    ?>
                </span>
            </h2>
            <p class="summary"><?php echo mb_strimwidth($article['summary'], 0, 50) . '...'?></p>
            <?= Html::a('Показать полностью', ['article/item', 'id' => $article['id']], ['class' => 'showContent']) ?>
        </li>
    </ul>
<?php endforeach; ?>
<?= Html::a('New article', ['article/add']) ?>
<?php endif; ?>
