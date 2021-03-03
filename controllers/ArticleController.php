<?php

namespace app\controllers;

/* 
 * Article Controller
 * 
 * 
 */
use yii\web\Controller;
use app\models\Article;
use app\models\Category;
use app\models\Subcategory;
use Yii;

class ArticleController extends Controller
{
    
   public function actionIndex(){
       
       $this->layout = 'article';
       $articles = Article::find()->with('categories', 'subcategories', 'authors')->all();
       return $this->render('index', 
               ['articles' => $articles,
                   ]);
   } 
   
   public function actionItem(){

       $id = isset($_GET['id']) ? $_GET['id'] : null;
       $article = Article::findOne($id);
       return $this->render('item', ['article' => $article]);
   }

   public function actionAdd(){

       $this->view->title = 'New article';

       $article = new Article();
       $categories = Category::find()->all();
       $subcategories = Subcategory::find()->all();
       if ($article->load(Yii::$app->request->post())){
           if($article->validate() ){
               Yii::$app->session->setFlash('success', 'Success');
               $article->save();
               return $this->refresh();
           }else {
               Yii::$app->session->setFlash('error', 'Error');
           }

       }
       return $this->render('add', ['article' => $article, 'categories' => $categories, 'subcategories' => $subcategories]);
   }

   public function actionEdit(){

       $id = isset($_GET['id']) ? $_GET['id'] : null;
       $article = Article::findone($id);
       $categories = Category::find()->all();
       $subcategories = Subcategory::find()->all();

       if ($article->load(Yii::$app->request->post())){
           if($article->validate() ){
               Yii::$app->session->setFlash('success', 'Success');
               $article->save();
               return $this->goBack(['article/index']);
           }else {
               Yii::$app->session->setFlash('error', 'Error');
           }
       }
       return $this->render('edit', ['article' => $article, 'categories' => $categories, 'subcategories' => $subcategories]);
   }

   public function actionDelete(){

       $id = isset($_GET['id']) ? $_GET['id'] : null;
       $article = Article::findOne($id);
       $article->delete($id);
       $articles = Article::find()->with()->all();
       return $this->goBack(['article/index'], ['articles' => $articles]);
   }
    
    
}

