<?php

namespace frontend\controllers;

class InitialController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
