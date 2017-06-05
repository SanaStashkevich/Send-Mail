<?php

namespace app\controllers;

use Yii;
//use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Contacts;
use app\models\Images;
use app\controllers\UploadedFile;

class SiteController extends Controller
{
 
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            
        ];
    }

    public function actionIndex()
    {
        $model = new Contacts();
        $image = new Images();
        $path = array ();
        $message = array();
         
        if($model->load(Yii::$app->request->post()) && $model->validate() 
                && $model->save())
        {
            Yii::$app->session->setFlash('success', 'Данные успешно сохранены в базу.');
            
            if($image->load(Yii::$app->request->post())) {
                $image->imageFiles = \yii\web\UploadedFile::getInstances($image, 'imageFiles');                 
                foreach ($image->imageFiles as $file) {
                    $name = md5(microtime() . rand(0, 9999));
                    $file->saveAs('uploads/'. $name.'.'.$file->extension, false);
                    $img = new Images();
                    $img->id_contact = $model->id;
                    $img->path = Yii::getAlias('@webroot/uploads/'.$name.'.'.$file->extension);
                    $path[] = $img->path;
                    $img->save();
                    $img->link('idContact', $model);
                     Yii::$app->session->setFlash('success1', 'Данные успешно сохранены в таблицу Images.');
                    }
                } 
                
            Yii::$app->mailer->getView()->params['name'] =  $model->name;
            Yii::$app->mailer->getView()->params['age'] =  $model->age;
            Yii::$app->mailer->getView()->params['weight'] =  $model->weight;
            Yii::$app->mailer->getView()->params['email'] =  $model->email;
            Yii::$app->mailer->getView()->params['height'] =  $model->height;
            Yii::$app->mailer->getView()->params['city'] =  $model->city;
            switch ($model->equip_rent)
            {
                case 0:
                    Yii::$app->mailer->getView()->params['equip_rent'] = 'нет';
                    break;
                case 1:
                    Yii::$app->mailer->getView()->params['equip_rent']= 'да, только камера';
                    break;
                default:
                   Yii::$app->mailer->getView()->params['equip_rent']= 'да, компьютер и камера';
                
            }
            
            switch ($model->level_lang)
            {
                case 0:
                    Yii::$app->mailer->getView()->params['level_lang']= 'без знания';
                    break;
                case 1:
                    Yii::$app->mailer->getView()->params['level_lang']= 'базовый';
                    break;
                case 2:
                    Yii::$app->mailer->getView()->params['level_lang']= 'средний';
                    break;
                case 3:
                    Yii::$app->mailer->getView()->params['level_lang']= 'высокий';
                    break;
                default:
                   Yii::$app->mailer->getView()->params['level_lang']= 'превосходный';    
                
            }
            
             
            if ($model->sendMail( $model->email, $path))    
            {
                 Yii::$app->session->setFlash('success2', 'Данные успешно отправленны на указаный Email.');
            }  
            return $this->refresh();
        }
        
        
        return $this->render('index', [
            'model' => $model,
            'image' => $image,
        ]);
    }
      

}
