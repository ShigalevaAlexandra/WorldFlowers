<?php

namespace app\controllers;

use app\models\Orders;
use app\models\Carts;
use app\models\Users;
use app\models\Products;
use app\models\OrdersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
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
     * Lists all Orders models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Orders model.
     * @param int $id_order Id Order
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_order)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_order),
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $password = Yii::$app->request->post('password');
        $model = Users::find()->where(['id_user' => Yii::$app->user->identity->id])
        ->andWhere(['password' => $password])->one();

        if($model) {
            $cart = Carts::find()->where(['user_id' => Yii::$app->user->identity->id])
            ->andWhere(['order_id' => null]);
    
            if (!$cart) {
                return json_encode(['success' => false, 'message' => 'Корзина пуста']);
            } else {
                $model = new Orders();
    
                if ($model->save(false)) {
                    Yii::$app->db->createCommand()->update('carts', ['order_id'=>$model->id_order], "`user_id` = ".Yii::$app->user->identity->id." AND `order_id` = 0;")->execute();
                    
                    return json_encode(['success' => true, 'message' => 'Заказ успешно оформлен']);
                } else {
                    return json_encode(['success' => false, 'message' => 'Не удалось оформить заказ']);
                }
            }
        }
        else {
            return json_encode(['success' => false, 'message' => 'Не удалось оформить заказ']);
        }
    }

    public function actionRemove()
    {
        $order_id = Yii::$app->request->post('select_id');
        $count_prod = Yii::$app->request->post('count_prod');
        $cart_prod = Yii::$app->request->post('cart_prod');

        $model = Orders::findOne(['id_order' => $order_id]);
    
        if ($model) {

            $cart = Carts::find()->where(['product_id' => $cart_prod])
            ->andWhere(['order_id' => $order_id])->one();

            if($cart) {
                $cart->order_id = 0;
                $cart->save(false);
            }
            
            return json_encode(['success' => true, 'message' => 'Заказ удален']);
        } else {
                return json_encode(['success' => false, 'message' => 'Не удалось удалить заказ']);
        }
    } 
    


    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_order Id Order
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_order)
    {
        $model = $this->findModel($id_order);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_order' => $model->id_order]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_order Id Order
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_order)
    {
        $this->findModel($id_order)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_order Id Order
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_order)
    {
        if (($model = Orders::findOne(['id_order' => $id_order])) !== null) {
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

    public function actionPersonal()
    {
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('personal', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
