<?php
namespace app\models\forms;

use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * Class BaseForm
 * @package app\models\forms
 */
class BaseForm extends Model
{
    //scenarios
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    /**
     * @var ActiveRecord
     */
    public $model;

    /**
     * @return ActiveRecord
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param $model
     * @param bool $setAttributes
     * @param null $attributesNames
     */
    public function setModel($model,$setAttributes = true, $attributesNames = null)
    {
        $this->model = $model;
        if($setAttributes){
            $this->setAttributes($this->model->getAttributes($attributesNames));
        }
    }
}
