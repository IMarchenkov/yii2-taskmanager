<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\data\ActiveDataProvider;
use app\models\tables\Tasks;
use app\models\tables\Users;
use yii\caching\DbDependency;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
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
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
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
//    public function actionIndex()
//    {
//        return $this->render('index');
//    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {

            $userId = Yii::$app->user->id;
            $key = 'tasks_current_task_' . $userId;

            $cache = Yii::$app->cache;

            $dataProvider = $cache->get($key);

            if (!$dataProvider) {

                $dataProvider = new ActiveDataProvider([
                    'query' => Tasks::findCurrentTasks(),
                    'pagination' => [
                        'pageSize' => 5
                    ],
                ]);

                $dependency = new DbDependency();
                $dependency->sql = "SELECT COUNT(*) FROM tasks";

                $dataProvider->prepare();

                $cache->set($key, $dataProvider, 3600, $dependency);
            }

            return $this->render('index', [
                'dataProvider' => $dataProvider,
            ]);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
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
        return $this->render('about');
    }

    public function actionSignup()
    {
        // Создать модель и указать ей, что используется сценарий регистрации
        $model = new Users(['scenario' => Users::SCENARIO_SIGNUP]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/']);
        }

        // Вывести форму
        return $this->render('signup', [
            'model' => $model
        ]);
    }

    public function actionSetlanguage()
    {
        $session = Yii::$app->session;

        $language = $session->get('langauge');
        if ($language == 'ru-Ru')
            $language = 'en-En';
        else
            $language = 'ru-Ru';

        $session->set('langauge', $language);

        return $this->goBack(Yii::$app->request->referrer);
    }
}
