<?php

namespace app\controllers;

use app\models\Nft;
use app\models\MarketSearch;
use app\models\Profile;
use app\models\Purchases;
use app\models\UploadNftPicture;
use app\models\User;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * MarketController implements the CRUD actions for Nft model.
 */
class MarketController extends Controller
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
     * Lists all Nft models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MarketSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Nft model.
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
     * Creates a new Nft model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Nft();
        $uploadImage = new UploadNftPicture();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $uploadImage->imageFile = UploadedFile::getInstance($uploadImage, "imageFile");
                $model->image = $uploadImage->imageFile->baseName.".".$uploadImage->imageFile->extension;
                $model->ownerId = Yii::$app->user->id;
                if ($uploadImage->upload() && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            "uploadImage" => $uploadImage
        ]);
    }

    /**
     * Updates an existing Nft model.
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

    /**
     * Deletes an existing Nft model.
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

    public function actionBuy($id)
    {
        $nftData = Nft::findOne(['id' => $id]);
        $userData = User::findOne(['id' => Yii::$app->user->id]);
        $ownerData = User::findOne(["id" => $nftData->ownerId]);
        $purchase = new Purchases();

        $userBalance = $userData->balance;
        $ownerBalance = $ownerData->balance;

        if ($userData->balance >= $nftData->price) {
            $userData->balance = $userBalance - $nftData->price;
            $ownerData->balance = $ownerBalance + $nftData->price;

            if ($userData->update(false) && $ownerData->update(false)) {
                $purchase->nftId = $nftData->id;
                $purchase->userId = $userData->id;
                if ($purchase->save(false)) {
                    Yii::$app->session->setFlash("Success", "Transaction Successfull");
                    return $this->redirect("/profile");
                }
            }
        } else {
            Yii::$app->session->setFlash("Error", Yii::t("app", "Insuficien balance"));
            return $this->redirect("/market/view?id=".$id);
        }
    }

    /**
     * Finds the Nft model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Nft the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Nft::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
