<?php

namespace app\assets;

use yii\web\AssetBundle;

class TasksAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '@web/css/tasks/style.css',
    ];
    public $js = [
        '@web/js/tasks/script.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}