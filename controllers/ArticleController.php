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
use app\models\Author;
use app\models\OurUser;
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
       $users = OurUser::find()->all();
       if ($article->load(Yii::$app->request->post())) {
           if ($article->validate()) {
               $article->save();
               Yii::$app->session->setFlash('success', 'Success');
               $id = Yii::$app->db->getLastInsertID();
               $article = Yii::$app->request->post('Article');
               if (!empty($article['authors'])) {
                   foreach ($article['authors'] as $item) {
                       $author = new Author;
                       $author->article_id = $id;
                       $author->author = $item;
                       $author->save();
                   }
               }
               return $this->refresh();
           } else {
               Yii::$app->session->setFlash('error', 'Error');
           }
       }
       return $this->render('add', ['article' => $article, 'categories' => $categories, 'subcategories' => $subcategories, 'users' => $users]);
   }

   public function actionEdit($id){

       $article = Article::findone($id);
       $categories = Category::find()->all();
       $subcategories = Subcategory::find()->all();
       $users = OurUser::find()->all();

       if ($article->load(Yii::$app->request->post())){
           if($article->validate() ){
               $article->save();
               Yii::$app->session->setFlash('success', 'Success');
               $article = Yii::$app->request->post('Article');
               Author::deleteAll(['article_id' => $id]);
               if (!empty($article['authors'])){
                foreach ($article['authors'] as $item){
                   $author = new Author;
                   $author->article_id = $id;
                   $author->author = $item;
                   $author->save();
               }
                }
               return $this->goBack(['article/index']);
           }else {
               Yii::$app->session->setFlash('error', 'Error');
           }
       }
       return $this->render('edit', ['article' => $article, 'categories' => $categories, 'subcategories' => $subcategories, 'users' => $users]);
   }

   public function actionDelete($id){

       $article = Article::findOne($id);
       $article->delete($id);
       $articles = Article::find()->with()->all();
       return $this->goBack(['article/index'], ['articles' => $articles]);
   }
    
    
}

