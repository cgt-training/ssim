<?php 
 namespace common\components;
use Yii;
use yii\base\Component;
use yii\web\Response;

class Helper extends Component{

    public function JsonResponse($data){
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }
}
