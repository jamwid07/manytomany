<?php

namespace app\controllers;

use app\models\Category;
use app\models\Relation;
use app\models\Review;
use app\models\ReviewSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

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
    public function actionIndex()
    {
		$searchModel = new ReviewSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('@app/views/review/index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
    }

	public function actionView($id)
	{
		return $this->render('@app/views/review/view', [
			'model' => $this->findModel($id),
		]);
	}

	public function actionCreate()
	{
		$model = new Review();

		if ($model->load(Yii::$app->request->post())) {

			$cats = Yii::$app->request->post('relation');
			$model->save();
			foreach ($cats as $key => $cat) {
				$rel = new Relation();
				$rel->review_id = $model->id;
				$rel->category_id = $cat;
				$rel->save();
			};
			return $this->redirect(['view', 'id' => $model->id]);
		}

		$category = Category::getAllCategories();

		return $this->render('@app/views/review/create', [
			'model' => $model,
			'category' => $category
		]);
	}

	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		}

		return $this->render('@app/views/review/update', [
			'model' => $model,
		]);
	}

	public function actionDelete($id)
	{
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}


	/**
	 * @param $id
	 * @return null|Review
	 * @throws NotFoundHttpException
	 */
	protected function findModel($id)
	{
		if (($model = Review::findOne($id)) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('The requested page does not exist.');
	}


	/**     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
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
}
