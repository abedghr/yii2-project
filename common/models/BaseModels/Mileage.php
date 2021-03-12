<?php

namespace common\models\BaseModels;

use common\components\BaseActiveRecord;
use common\models\Mileage as ModelsMileage;
use Yii;

/**
 * This is the model class for table "mileage".
 *
 * @property int $id
 * @property string $v_mileage
 *
 * @property UsedVehicles[] $usedVehicles
 */
class Mileage extends BaseActiveRecord
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

    /**
     * Gets query for [[UsedVehicles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsedVehicles()
    {
        return $this->hasMany(UsedVehicles::className(), ['v_mileage' => 'id']);
    }
}
