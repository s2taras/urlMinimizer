<?php

namespace app\models\forms;

use app\models\UrlRecord;
use Yii;

/**
 * Class GoToForm
 * @package backend\forms\task
 */
class GoToForm extends BaseForm
{
    /**
     * Go to short url
     * @var string
     */
    public $go_to;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['go_to',], 'required'],
            [['go_to',], 'string', 'min' => 1],
            [['go_to'], 'exist', 'skipOnError' => true, 'targetClass' => UrlRecord::class, 'targetAttribute' => ['go_to' => 'short_url']],
            ['go_to', 'validateUrlTtl'],
        ];
    }

    /**
     * Validate bots list - check that bots are exist and have active status
     * @param string $attribute
     * @param array  $params
     */
    public function validateUrlTtl($attribute, $params)
    {
        $exists = UrlRecord::find()
            ->where(['short_url' => $this->{$attribute}])
            ->andWhere('expired_at > now()')
            ->exists();

        if (!$exists) {
            $this->addError($attribute,  'Url is expired');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'go_to' => Yii::t('app', 'Go to url'),
        ];
    }

    /**
     * Returns a list of available atomic actions.
     * @return string
     */
    public function goTo()
    {
        /** @var UrlRecord $url */
        $url = UrlRecord::findOne(['short_url' => $this->go_to]);
        $url->updateCounters(['counter' => 1]);

        return $url->full_url;
    }
}
