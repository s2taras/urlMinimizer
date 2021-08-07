<?php

namespace app\controllers;

use app\models\forms\GoToForm;
use app\models\forms\UrlRecordForm;
use app\models\UrlRecord;
use Yii;
use app\models\UrlRecordSearch;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

/**
 * Class UrlController
 * @package app\controllers
 */
class UrlController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
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
        ];
    }

    /**
     * Lists of Urls with redirect form
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {
        $formModel = new GoToForm();
        if ($formModel->load(Yii::$app->request->post()) && $formModel->validate()) {
            return $this->redirect($formModel->goTo());
        }

        $searchModel = new UrlRecordSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
            'formModel'    => $formModel,
        ]);
    }

    /**
     * Creates a new UrlRecord model.
     * @return string|\yii\web\Response
     * @throws \yii\db\Exception
     */
    public function actionCreate()
    {
        $model = new UrlRecord();
        $formModel = new UrlRecordForm(['scenario' => UrlRecordForm::SCENARIO_CREATE]);
        $formModel->setModel($model);

        if ($formModel->load(Yii::$app->request->post()) && $formModel->save()) {
            return $this->redirect(['/url/index']);
        }

        return $this->render('create', [
            'formModel' => $formModel,
        ]);
    }

    /**
     * Updates an existing UrlRecord model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     * @throws \yii\db\Exception
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $formModel = new UrlRecordForm(['scenario' => UrlRecordForm::SCENARIO_UPDATE]);
        $formModel->setModel($model);

        if ($formModel->load(Yii::$app->request->post()) && $formModel->save()) {
            return $this->redirect(['/url/index']);
        }

        return $this->render('update', [
            'formModel' => $formModel,
        ]);
    }

    /**
     * Deletes an existing UrlRecord model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['/url/index']);
    }

    /**
     * Finds the UrlRecord model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UrlRecord the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UrlRecord::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

//    /**
//     * Displays minimize page.
//     *
//     * @return Response|string
//     */
//    public function actionMinimize()
//    {
//        $model = new ContactForm();
//        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
//            Yii::$app->session->setFlash('contactFormSubmitted');
//
//            return $this->refresh();
//        }
//        return $this->render('minimize', [
//            'model' => $model,
//        ]);
//    }
}
