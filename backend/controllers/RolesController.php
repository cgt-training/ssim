<?php

namespace backend\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;
use app\models\Model;
use app\base\Controller;
use app\models\AuthItem;
use app\models\AuthItemChild;
use app\models\AuthItemSearch;
use yii\data\ActiveDataProvider;

class RolesController extends \yii\web\Controller
{

    /**
     * Lists all User  roles, return auth item models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new AuthItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $data =[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ];

        return $this->render('index',$data);
    }       

  /**
    * Creates a new User model.
    * If creation is successful, the browser will be redirected to the 'index' page.
    * @return mixed
    */

   public function actionCreate()
    {
        $modelAuthItem = new AuthItem;
        $modelAuthItemChild = [new AuthItemChild];

        if ($modelAuthItem->load(Yii::$app->request->post())) {

            //create multiple instances of auth item child model
            $modelAuthItemChild = Model::createMultiple(AuthItemChild::classname());
            //load post data in all instances of auth item child model
            $modelAuthItemChild = Model::loadMultiple($modelAuthItemChild, Yii::$app->request->post('AuthItemChild'));

            // set type attribute for auth item model and validate
            $modelAuthItem->type = 1;
            $valid = $modelAuthItem->validate();

            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelAuthItem->save(false)) {
                        foreach ($modelAuthItemChild as $index => $each) {

                            if ($flag === false) {
                                break;
                            }

                            //save new permission in auth item model
                            $modelAuthPermission = new AuthItem();
                            $modelAuthPermission->name = $each->permission_name;
                            $modelAuthPermission->description = $each->permission_desc;
                            $modelAuthPermission->type = 2;
                            $modelAuthPermission->save();

                            //save auth item child model
                            $each->parent = $modelAuthItem->name;
                            $each->child = $each->permission_name;

                            if (!($flag = $each->save(false))) {
                                break;
                            }

                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['index']);
                    } else {
                        $transaction->rollBack();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'modelAuthItem' => $modelAuthItem,
            'modelAuthItemChild' => (empty($modelAuthItemChild)) ? [new AuthItemChild] : $modelAuthItemChild,
        ]);
    }
}
