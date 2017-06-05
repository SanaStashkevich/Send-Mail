<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "images".
 *
 * @property integer $id
 * @property integer $id_contact
 * @property string $path
 *
 * @property Contacts $idContact
 */
class Images extends \yii\db\ActiveRecord
{
   public $imageFiles;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_contact', 'path'], 'required'],
            [['id_contact'], 'integer'],
            [['path'], 'string', 'max' => 255],
            [['id_contact'], 'exist', 'skipOnError' => true, 'targetClass' => Contacts::className(), 'targetAttribute' => ['id_contact' => 'id']],
            [['imageFiles'], 'file', 'maxFiles' => 5, 'message' => 'Вы можете загрузить не более 5 изображений'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ИД',
            'id_contact' => 'Ид контакта',
            'path' => 'Путь к файлу',
     //       'fimages' => 'Добавить фото(до 5 шт)'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdContact()
    {
        return $this->hasOne(Contacts::className(), ['id' => 'id_contact']);
    }

    public function upload()
    {
        if ($this->validate()) { 
            foreach ($this->imageFiles as $file) {
                $file->saveAs('uploads/'. $file->baseName.'.'.$file->extention);
            }
            return true;
        } else {
            return false;
        }
    }
}
