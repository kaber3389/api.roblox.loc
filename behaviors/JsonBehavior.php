<?php

namespace app\behaviors;

use Yii;
use yii\base\Behavior;
use yii\web\Controller;
class JsonBehavior extends Behavior
{
    public function events()
    {
        return [
            Controller::EVENT_BEFORE_ACTION => 'parseJson',
        ];
    }

    public function parseJson($event)
    {
        $request = Yii::$app->request;

        if ($request->getContentType() === 'application/json') {
            $rawData = $request->getRawBody();
            $data = json_decode($rawData, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                $_POST = $data;
            }
        }
    }
}