<?php 
 namespace common\components;
use Yii;
use yii\base\Component;
use yii\web\Response;

class Helper extends Component{

/**
* return json encoded response data
*@param array $data
*@return json data 
*/

    public function JsonResponse($data){
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }

/**
* return rendered html for alert box
*@param array $data
*@return html 
*/
    public function renderErrors($data){
        $messages = "";
        foreach($data as $each){
            $messages .= implode(',',$each).'<br/>';
        }

        if($messages != ""){
            return '<div class="alert alert-danger">'.$messages.'</div>';
        }
    }


/**
* return formated date 
*@param string $date
*@return string date
*/
    public function formatToDefaultDate($date){
        return date('Y-m-d',strtotime($date));
    }
}
