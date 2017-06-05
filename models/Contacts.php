<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contacts".
 *
 * @property integer $id
 * @property string $name
 * @property integer $age
 * @property integer $height
 * @property integer $weight
 * @property string $email
 * @property string $city
 * @property integer $equip_rent
 * @property integer $level_lang
 *
 * @property Images[] $images
 */
class Contacts extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contacts';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'age', 'height', 'weight', 'email', 'city', 'equip_rent', 'level_lang'], 'required','message' => 'Поле должно быть заполнено'],
            [['name', 'email', 'city'], 'string', 'max' => 160,'message' => 'Длина поля не должна превышать 160 символов.'],
            ['email','email','message' => 'Не корректный e-mail'],
            [['name', 'email', 'city'], 'filter', 'filter' => 'trim', 'skipOnArray'=> true],
            ['equip_rent', 'in','range' => [0,1,2]],
            ['level_lang', 'in', 'range' => [0,1,2,3,4]],
            ['weight', 'integer', 'min' =>1, 'max' =>350 ,'message' => 'Вес должен быть в промежутке от 1 до 350 кг.'],
            ['height', 'integer', 'min' =>1, 'max' =>250 ,'message' => 'Рост должен быть в промежутке от 1 до 250 см.'],
            ['age', 'integer', 'min' =>1, 'max' =>150, 'message' => 'Возрат должен быть в промежутке от 1 до 150 лет'],
         
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ИД',
            'name' => 'Имя',
            'age' => 'Возраст',
            'height' => 'Рост',
            'weight' => 'Вес',
            'email' => 'E-mail',
            'city' => 'Город проживания',
            'equip_rent' => 'Нужна ли техника в аренду',
            'level_lang' => 'Знание английского',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Images::className(), ['id_contact' => 'id']);
    }
    
    public function sendMail($email, $arr) {

        if ($this->validate()) {

            $message  = Yii::$app->mailer->compose('email');
                $message->setFrom('testsana111@gmail.com');
                $message->setTo([Yii::$app->params['adminEmail'], $email]);
                if (isset( $arr)) 
                {
                    foreach($arr as $v)
                    {
                        $message->attach($v);
                    }
                }
                $message->setSubject('Данные с формы заявки');
                $message->send();
            return true;
        }
        return false; 
    }
    
    
}
