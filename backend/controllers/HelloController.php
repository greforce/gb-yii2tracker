<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;


/**
 * Hello controller
 */
class HelloController extends Controller
{

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

}
