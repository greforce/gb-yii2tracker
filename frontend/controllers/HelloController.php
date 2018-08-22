<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

/**
 * Test controller
 */
class HelloController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

}
