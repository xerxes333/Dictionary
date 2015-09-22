<?php

namespace app\modules\scheduler;

class Scheduler extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\scheduler\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
        $this->setAliases([
            '@scheduler-assets' => __DIR__ . '/assets'
        ]);
    }
}
