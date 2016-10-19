<?php

namespace backend\controllers;
use Yii;
use backend\models\Company;
use app\models\User;
use backend\models\Branches;
use backend\models\Department;

class DashboardController extends \yii\web\Controller
{
    public function actionIndex()
    {
        
        $dashboard_widget = [
            'company_count' => Company::find()->count(),
            'department_count' => Department::find()->count(),
            'branch_count' => Branches::find()->count(),
            'user_count' => User::find()->where("timestampdiff(DAY,from_unixtime(created_at,'%Y-%m-%d'),CURDATE()) < 7")->count()
        ];
        return $this->render('index',[
            'dashboard_widget' => (Object)$dashboard_widget
        ]);
    }

}
