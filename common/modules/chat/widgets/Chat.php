<?php
namespace common\modules\chat\widgets;

use Yii;
use common\modules\chat\widgets\assets\ChatAsset;

class Chat extends \yii\bootstrap\Widget
{
    public function init()
    {
        ChatAsset::register($this->view);
    }

    public function run()
    {
        return $this->render('chat');
    }
}
