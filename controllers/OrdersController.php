<?php

namespace app\controllers;

use Exception;
use Yii;
use app\models\Orders;
use app\models\OrdersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'update' => ['POST'],
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionGetAll()
    {
        return json_encode(Orders::find()->asArray()->all());
    }

    public function actionGetOne($id)
    {
        return json_encode(Orders::findOne($id)->toArray());
    }

    /**
     * Creates a new Orders model.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Orders();

        try {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return json_encode(['status' => 'ok', 'order_id' => $model->id]);
            }
        } catch (Exception $exception) {
            return json_encode(['status' => 'error', 'message' => $exception->getMessage()]);
        }

        return json_encode([
            'status' => 'error',
            'errors' => $model->getErrorSummary(true),
            'post' => $model->load(Yii::$app->request->post())
        ]);
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        try {
            $receivedData = Yii::$app->request->post();
            unset($receivedData['Order']['id']);
            foreach ($receivedData['Order'] as $property => $value) {
                $model->$property = $value;
            }
            $model->update($receivedData);
            return json_encode(['status' => 'ok']);
        } catch (Exception $exception) {
            return json_encode(['status' => 'error', 'message' => $exception->getMessage()]);
        }

        return json_encode([
            'status' => 'error',
            'errors' => $model->getErrorSummary(true),
            'post' => $model->load(Yii::$app->request->post())
        ]);
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     */
    public function actionDelete($id)
    {
        try {
            $this->findModel($id)->delete();
            return json_encode(['status' => 'ok']);
        } catch (Exception $exception) {
            return json_encode(['status' => 'error', 'message' => $exception->getMessage()]);
        }
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param  integer  $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
