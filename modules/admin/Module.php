<?php

namespace app\modules\admin;
use Yii;
use yii\filters\AccessControl;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    // public $layout = '/admin';
    public $controllerNamespace = 'app\modules\admin\controllers';
    public $layout = '/admin';
    //Yii::$app->setLayoutPath('@app/modules/admin/views/layouts');
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        // путь к директории layouts модуля
        //Yii::$app->setLayoutPath('@app/modules/admin/views/layouts');
        // файл "admin.php"
        //Yii::$app->layout = '/admin';
    }

    public function behaviors()
    {
        return [
            'access'    =>  [
                'class' =>  AccessControl::className(),
                'denyCallback'  =>  function($rule, $action)
                {
                    throw new \yii\web\NotFoundHttpException();
                },
                'rules' =>  [
                    [
                        'allow' =>  true,
                        'matchCallback' =>  function($rule, $action)
                        {
                            return Yii::$app->user->identity->isAdmin;
                        }
                    ]
                ]
            ]
        ];
    }
}
