<?php

namespace app\controllers;

use app\models\Products;
use app\models\ProductsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Yii;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
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
     * Lists all Products models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Products model.
     * @param int $id_product Id Product
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_product)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_product),
        ]);
    }

    public function upload()
    {
        if ($this->validate()) {
            $path = 'productsImages/' . Yii::$app->getSecurity()->generateRandomString(10) . '.' . $this->photo->extension;
            $this->photo->saveAs($path);
            return $path;
        } else {
            return false;
        }
    }

    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Products();

        if ($this->request->isPost) {
            $model->load($this->request->post());
            $model->photo=UploadedFile::getInstance($model,'photo');
            $file_name='productsImages/' . \Yii::$app->getSecurity()->generateRandomString(50). '.' . $model->photo->extension;
            $model->photo->saveAs(\Yii::$app->basePath .'/web/'. $file_name);

            if ($model->save(false)) {
                Yii::$app->db->createCommand()->update('products', ['photo'=>$file_name], "id_product = {$model->id_product}")->execute();
                return $this->redirect(["view","id_product"=> $model->id_product]);
            }
            } else {
                $model->loadDefaultValues();
            }
            
            return $this->render('create', [
                'model' => $model,
            ]);
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_product Id Product
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_product)
    {
        $model = $this->findModel($id_product);

        if ($this->request->isPost) {

            $model->load($this->request->post());
            $model->photo=UploadedFile::getInstance($model,'photo');
            $file_name='productsImages/' . \Yii::$app->getSecurity()->generateRandomString(50). '.' . $model->photo->extension;
            $model->photo->saveAs(\Yii::$app->basePath .'/web/'. $file_name);
            $model->photo=$file_name;
            $model->save(false);
            
            return $this->redirect(['view', 'id_product' => $model->id_product]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    } 


    /**
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_product Id Product
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_product)
    {
        $this->findModel($id_product)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_product Id Product
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_product)
    {
        if (($model = Products::findOne(['id_product' => $id_product])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionCatalog()
    {
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('catalog', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
