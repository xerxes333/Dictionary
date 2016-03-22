<?php
namespace app\modules\scheduler\assets;
use yii\web\AssetBundle;
class SchedulerAsset extends AssetBundle
{
    // the alias to your assets folder in your file system
    public $sourcePath = '@scheduler-assets';
    // finally your files.. 
    public $css = [
      // 'css/first-css-file.css',
      // 'css/second-css-file.css',
    ];
    public $js = [
      // 'js/first-js-file.js',
      // 'js/second-js-file.js',
      'js/app.js',
    ];
    // that are the dependecies, for makeing your Asset bundle work with Yii2 framework
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}