<?php

namespace common\models\BaseModels;

use common\components\BaseActiveRecord;
use common\models\City as ModelsCity;
use Yii;

/**
 * This is the model class for table "city".
 *
 * @property int $id
 * @property string|null $city_name
 *
 * @property UsedVehicles[] $usedVehicles
 */
class City extends BaseActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city_name' => 'City Name',
        ];
    }

    /**
     * Gets query for [[UsedVehicles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsedVehicles()
    {
        return $this->hasMany(UsedVehicles::className(), ['v_city' => 'id']);
    }
}
