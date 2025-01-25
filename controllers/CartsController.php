<?php

namespace app\controllers;

use app\models\Carts;
use app\models\CartsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CartsController implements the CRUD actions for Carts model.
 */
class CartsController extends Controller
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

    /**
     * Lists all Carts models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CartsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Carts model.
     * @param int $id_cart Id Cart
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_cart)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_cart),
        ]);
    }

    /**
     * Creates a new Carts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Carts();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_cart' => $model->id_cart]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Carts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_cart Id Cart
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_cart)
    {
        $model = $this->findModel($id_cart);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_cart' => $model->id_cart]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Carts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_cart Id Cart
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_cart)
    {
        $this->findModel($id_cart)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Carts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_cart Id Cart
     * @return Carts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_cart)
    {
        if (($model = Carts::findOne(['id_cart' => $id_cart])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
