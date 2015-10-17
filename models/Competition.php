<?php

namespace app\models;

use yii;
use yii\db\ActiveRecord;
use yii\imagine\Image;
use yii\web\UploadedFile;

class Competition extends ActiveRecord {
    public static function tableName() {
        return 'competition';
    }

    public function rules () {
        return [
            [['title', 'creator_id'], 'required'],
            [['title'], 'string', 'max' => 100],
            [['creator_id'], 'number'],
            [['date_add', 'date_upd', 'date_start', 'date_end'], 'date', 'format' => 'yyyy-MM-dd HH:mm:ss'],
            [['date_add', 'date_upd'], 'default', 'value' => function() { return date('Y-m-d H:i:s'); }],

            [['title'], 'required', 'message' => 'Введите название конкурса', 'on' => 'create'],
            [['description'], 'required', 'message' => 'Введите описание', 'on' => 'create'],
            [['description'], 'string', 'min' => 100, 'tooShort' => 'Описание должно быть не менее 100 символов', 'on' => 'create'],
            [['poster'], 'image', 'mimeTypes' => 'image/bmp, image/png, image/jpg, image/jpeg', 'maxSize' => 524288, 'tooBig' => 'Файл превышает допустимый размер (500 Kb)', 'wrongMimeType' => 'Файл не картинка', 'on' => 'create'],
        ];
    }

    public function attributeLabels() {
        switch ($this->scenario) {
            case 'create' : return [
                'poster' => 'Картинка',
                'title' => 'Название конкурса',
                'description' => 'Описание'
            ];
            default: return [

            ];
        }
    }

    public static function getPosterSizes () {
        return [
            [50, 50],
            [100, 100]
        ];
    }

    public static function posterPath() {
        return Yii::getAlias('@webroot/images/competitions');
    }

    public function getPosterUrl($size = array()) {
        if (empty($size)) {
            if (!file_exists(Competition::posterPath() . '/' . $this->poster . '.png')) {
                return Yii::getAlias("@web/images/competitions/default.png");
            }

            return Yii::getAlias("@web/images/competitions/{$this->poster}.png");
        } else {
            if (!in_array($size, Competition::getPosterSizes())) {
                throw new \InvalidArgumentException('Wrong size');
            }

            if (!file_exists(Competition::posterPath() . "/{$this->poster}_{$size[0]}_{$size[1]}.png")) {
                return Yii::getAlias("@web/images/competitions/default.png");
            }

            return Yii::getAlias("@web/images/competitions/{$this->poster}_{$size[0]}_{$size[1]}.png");
        }
    }

    public function createPoster($uploadedPoster) {
        $fileName = $this->poster ? $this->poster : Yii::$app->security->generateRandomString(16);

        $uploadedPoster->saveAs(Competition::posterPath() . '/' . $fileName);

        foreach (Competition::getPosterSizes() as $size) {
            Image::thumbnail(Competition::posterPath() . '/' . $fileName, $size[0], $size[1])->save(Competition::posterPath() . "/{$fileName}_{$size[0]}_{$size[1]}.png");
        }

        Image::getImagine()->open(Competition::posterPath() . '/' . $fileName)->save(Competition::posterPath() . '/' . $fileName . '.png');
        unlink(Competition::posterPath() . '/' . $fileName);

        $this->poster = $fileName;
    }

    public function create() {
        if ($this->validate()) {
            if ($newPoster = UploadedFile::getInstance($this, 'poster')) {
                $this->createPoster($newPoster);
            }

            $this->scenario = 'default';

            $this->save();
        }

        return $this;
    }
}