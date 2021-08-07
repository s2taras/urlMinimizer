<?php

namespace app\models\forms;

use app\models\UrlRecord;

/**
 * Class UrlRecordForm
 * @package backend\forms\task
 *
 * @property UrlRecord $model
 * @method   UrlRecord getModel()
 * @method   void setModel(UrlRecord $model, $setAttributes = true, $attributesNames = null)
 */
class UrlRecordForm extends BaseForm
{
    const DEFAULT_SHORT_URL_LENGTH = 6;

    /**
     * @var string
     */
    public $full_url;

    /**
     * @var string
     */
    public $expired_at;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['full_url',], 'required', 'on' => [self::SCENARIO_CREATE]],
            [['expired_at',], 'required', 'on' => [self::SCENARIO_CREATE, self::SCENARIO_UPDATE]],
            [['full_url'], 'url', 'on' => [self::SCENARIO_CREATE]],
            [['full_url', 'expired_at',], 'string', 'min' => 1, 'on' => [self::SCENARIO_CREATE]],
        ];
    }

    /**
     * @param bool $runValidation
     * @param null $attributes
     * @return bool
     */
    public function save($runValidation = true, $attributes = null)
    {
        //validate from attributes
        if ($runValidation && !$this->validate()) {
            return false;
        }

        if(self::SCENARIO_CREATE == self::getScenario()) {
            $attributes = [
                'full_url'   => $this->full_url,
                'short_url'  => $this->getUniqueShortUrl(),
                'expired_at' => $this->expired_at,
            ];
        } else {
            $attributes = [
                'expired_at' => $this->expired_at,
            ];
        }

        $this->model->setAttributes($attributes);

        return $this->model->save();
    }

    /**
     * Generate unique short url
     * @return string
     */
    protected function getUniqueShortUrl()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        do {
            $short_url = '';
            for ($i = 0; $i < self::DEFAULT_SHORT_URL_LENGTH; $i++) {
                $short_url .= $characters[mt_rand(0, strlen($characters) - 1)];
            }
        } while ($this->checkOnExists($short_url) == true);

        return 'https://' . $short_url;
    }

    /**
     * Check on existing short ulr in DB
     * @return bool
     */
    protected function checkOnExists($shortUrl)
    {
        return UrlRecord::find()->where(['short_url' => $shortUrl])->exists();
    }
}
