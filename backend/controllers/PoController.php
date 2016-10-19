<?php

namespace backend\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;
use app\models\Model;
use app\base\Controller;
use app\models\Po;
use backend\models\PoSearch;
use app\models\PoItem;
use yii\data\ActiveDataProvider;

class PoController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $searchModel = new PoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $data =[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ];

        if(Yii::$app->request->isAjax){
            return $this->renderAjax('index',$data);
        }
        else{
            return $this->render('index',$data);
        }
    }

   public function actionCreate()
    {
        $modelPo = new Po;
        $modelPoItem = [new PoItem];

        if ($modelPo->load(Yii::$app->request->post())) {

            $modelPoItem = Model::createMultiple(PoItem::classname());
            $modelPoItem = Model::loadMultiple($modelPoItem, Yii::$app->request->post('PoItem'));

            foreach($modelPoItem as $each){
                $each->po_id = $modelPo->po_no;
            }

            // validate person and po item models
            $valid = $modelPo->validate();
            $valid = Model::validateMultiple($modelPoItem) && $valid;


            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelPo->save(false)) {
                        foreach ($modelPoItem as $indexHouse => $modelHouse) {

                            if ($flag === false) {
                                break;
                            }

                            if (!($flag = $modelHouse->save(false))) {
                                break;
                            }

                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['index', 'id' => $modelPo->id]);
                    } else {
                        $transaction->rollBack();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'modelPo' => $modelPo,
            'modelPoItem' => (empty($modelPoItem)) ? [new House] : $modelPoItem,
        ]);
    }
}