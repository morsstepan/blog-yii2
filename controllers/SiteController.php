<?php

namespace app\controllers;

use app\models\Article;
use app\models\Category;
use app\models\ImageUpload;
use app\models\Tag;
use app\models\User;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['POST'],

                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $data = Article::getAllArticles();
        $popular = Article::getPopular();
        $recent = Article::getRecent();
        $categories = Category::getAllCategories();
        return $this->render('index', [
            'articles' => $data['articles'],
            'pagination' => $data['pagination'],
            'popular' => $popular,
            'recent' => $recent,
            'categories' => $categories
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        $id = Yii::$app->request->get('id');
        $article = Article::findOne(12);
        $user = User::findOne($id);
        $popular = Article::getPopular();
        $recent = Article::getRecent();
        $categories = Category::getAllCategories();

        return $this->render('about', [
            'user' => $user,
            'popular' => $popular,
            'recent' => $recent,
            'categories' => $categories,
            'article' => $article
        ]);
    }

    public function actionView()
    {
        $id = Yii::$app->request->get('id');
        $article = Article::findOne($id);
        $tags = $article->tags;
        $popular = Article::getPopular();
        $recent = Article::getRecent();
        $categories = Category::getAllCategories();
        //$tags = ArrayHelper::map($article->tags, 'id', 'title');
        $article->viewedCounter();
        return $this->render('single', [
            'article' => $article,
            'tags' => $tags,
            'popular' => $popular,
            'recent' => $recent,
            'categories' => $categories
        ]);
    }

    public function actionCategory()
    {
        $id = Yii::$app->request->get('id');
        $data = Category::getArticlesByCategory($id);
        $popular = Article::getPopular();
        $recent = Article::getRecent();
        $categories = Category::getAllCategories();
        return $this->render('category', [
            'articles' => $data['articles'],
            'pagination' => $data['pagination'],
            'popular' => $popular,
            'recent' => $recent,
            'categories' => $categories

        ]);
    }

    public function actionEdit()
    {
        $user = User::findOne(Yii::$app->user->id);
        $model = new ImageUpload;
        $file = UploadedFile::getInstance($user, 'photo');
        //var_dump($user);
        $userPhoto = $user->photo;
        //$res = $model->uploadImage($file, $userPhoto);
        //var_dump($res); die;
        if ($user->load(Yii::$app->request->post()) && $user->save())
        {
            if ($user->saveImage($model->uploadImage($file, $userPhoto)))
            {
                $user->updatePassword($user->new_password);
                return $this->redirect(['about', 'id' => $user->id]);
            }
        }
        return $this->render('edit', [
            'model' => $user
        ]);
    }

    public function actionSetImage()
    {
        var_dump('here'); die;
    }

    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
