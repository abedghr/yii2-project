<?php

namespace common\models;

use common\models\BaseModels\Mileage as BaseModelsMileage;
use Yii;

/**
 * This is the model class for table "mileage".
 *
 * @property int $id
 * @property string $v_mileage
 */
class Mileage extends BaseModelsMileage
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mileage';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['v_mileage'], 'required'],
            [['v_mileage'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'v_mileage' => 'V Mileage',
        ];
    }
}
