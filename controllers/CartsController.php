<?php

namespace app\controllers;

use app\models\Carts;
use app\models\CartsSearch;
use app\models\Products;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

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
        $product_id = Yii::$app->request->post('product_id');
        $items = Yii::$app->request->post('count');
        $product = Products::findOne($product_id);

        if (!$product || $product->count <= 0) {
            return json_encode(['success' => false, 'message' => 'Товар недоступен']);
        }

        $product->count -= $items;
        $product->save(false);

        $model = Carts::find()->where(['user_id' => Yii::$app->user->identity->id])
        ->andWhere(['product_id' => $product_id])->one();

        if ($model) {
            $model->count += $items;
            $model->save(false);
            return json_encode(['success' => true, 'message' => 'Товар добавлен в корзину']);
        }

        $model = new Carts();
        $model->user_id = Yii::$app->user->identity->id;
        $model->product_id = $product->id_product;
        $model->count = $items;

        if ($model->save(false)) {
            return json_encode(['success' => true, 'message' => 'Товар добавлен в корзину']);
        }

        return json_encode(['success' => false, 'message' => 'Не удалось добавить товар в корзину']);
    }

    public function actionRemove()
    {
        $product_id = Yii::$app->request->post('select_id');
        $product = Products::findOne($product_id);
    
        if (!$product) {
            return json_encode(['success' => false, 'message' => 'Товар не найден']);
        }    

        $model = Carts::find()->where(['user_id' => Yii::$app->user->identity->id])
        ->andWhere(['product_id' => $product_id])->one();
    
        if ($model) {
            if ($model->count > 1) {
                $model->count -= 1;
                $model->save(false);
            
                $product->count += 1;
                $product->save(false);
            
                return json_encode(['success' => true, 'message' => 'Товар успешно удален из корзины']);
            } else {
                $model->delete();
            
                $product->count += 1;
                $product->save(false);
            
                return json_encode(['success' => true, 'message' => 'Товар успешно удален из корзины']);
            }
        }
    
        return json_encode(['success' => false, 'message' => 'Товар не найден в корзине']);
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

    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect(['site/login']);
            return false;
        } else
            return true;
            
        if ($action->id=='create') $this->enableCsrfValidation=false;
            return parent::beforeAction($action); 
    }
}
