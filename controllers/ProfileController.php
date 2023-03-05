<?php

namespace app\controllers;

use app\models\Language;
use app\models\Profile;
use app\models\Purchases;
use app\models\ProfileSearch;
use app\models\UploadProfileAvatar;
use app\models\User;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProfileController implements the CRUD actions for Purchases model.
 */
class ProfileController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        if (Yii::$app->user->id > 0) {
            Yii::$app->language = Profile::findOne(["userId" => Yii::$app->user->id])->language->language;
        }

        return true; // or false to not run the action
    }

    /**
     * Lists all Purchases models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProfileSearch();
        $profile = Profile::findOne(["userId" => Yii::$app->user->id]);
        $balance = User::findOne(["id" => Yii::$app->user->id])->balance;
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'profile' => $profile,
            'balance' => $balance
        ]);
    }

    /**
     * Displays a single Purchases model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Purchases model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Purchases();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Purchases model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionUpdateprofile()
    {
        $profile = Profile::findOne(["userId" => Yii::$app->user->id]);
        $model = $this->findProfile($profile->id);
        $uploadAvatar = new UploadProfileAvatar();
        $languages = Language::find()->select([ 'language','id' ])->indexBy('id')->column();

        if ($this->request->isPost && $model->load($this->request->post()) && $uploadAvatar->load($this->request->post())) {
            if ($uploadAvatar->imageFile) {
                $uploadAvatar->imageFile = UploadedFile::getInstance($uploadAvatar, "imageFile");
                $model->avatar = $uploadAvatar->imageFile->baseName.".".$uploadAvatar->imageFile->extension;
                $uploadAvatar->upload();
            }
            if ($model->save(false)) {
                return $this->redirect("/profile");
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('updateMyProfile', [
            'model' => $model,
            "uploadAvatar" => $uploadAvatar,
            "languages" => $languages
        ]);


    }

    /**
     * Deletes an existing Purchases model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Purchases model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Purchases the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Purchases::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    protected function findProfile($id)
    {
        if (($model = Profile::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}