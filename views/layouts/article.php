<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\ArticleAsset;

ArticleAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">


<div id="container">
    <head>
    <meta charset="<?= Yii::$app->charset ?>">
    <a href="."><img id="logo" src="images/logo.jpg" alt="Widget News" /></a>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
        <?= $content ?>
<footer class="footer">
    <div id="footer">
                Простая PHP CMS &copy; 2017. Все права принадлежат всем. ;) <a href="admin.php">Site Admin</a>
    </div>
</footer>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
