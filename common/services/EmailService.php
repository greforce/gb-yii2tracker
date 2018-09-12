<?php
namespace common\services;

use Yii;

class EmailService extends \yii\base\Component
{
    public function send($to, $subject, $views, $data)
    {
        Yii::$app
            ->mailer
            ->compose($views, $data)
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . 'robot'])
            ->setTo($to)
            ->setSubject($subject)
            ->send();
    }
}
