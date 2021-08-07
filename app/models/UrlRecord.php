<?php

namespace app\models;

use DateTime;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * @property integer  $id
 * @property string   $full_url
 * @property string   $short_url
 * @property integer  $counter
 * @property DateTime $expired_at
 * @property DateTime $created_at
 * @property DateTime $updated_at
 *
 * Class UrlRecord
 * @package app\models
 */
class UrlRecord extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'url';
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => function(){ return date('Y-m-d H:i:s');},
            ],
        ];
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['id', 'counter',], 'number'],
            ['full_url', 'required'],
            [['full_url', 'short_url',], 'string', 'max' => 255],
            [['created_at', 'updated_at', 'expired_at'], 'safe'],
        ];
    }
}
