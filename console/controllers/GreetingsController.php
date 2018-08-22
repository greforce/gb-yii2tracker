<?php
namespace console\controllers;

use yii\console\Controller;

/**
 * Test controller
 */
class GreetingsController extends Controller
{

    public function actionIndex()
    {
        echo 'Hello world, yii2 advanced greets you!' . PHP_EOL;
    }

}
