<?php

namespace common\models;

use common\models\BaseModels\UsedVehicles as BaseModelsUsedVehicles;
use Yii;

/**
 * This is the model class for table "usedVehicles".
 *
 * @property int $id
 * @property int $v_id
 * @property int $v_city
 * @property int $v_mileage
 * @property string $v_year
 *
 * @property City $vCity
 * @property Vehicles $v
 */
class UsedVehicles extends BaseModelsUsedVehicles
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usedVehicles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['v_city', 'v_year'], 'required'],
            [['v_id', 'v_city', 'v_mileage'], 'integer'],
            [['v_year'], 'string', 'max' => 10],
            [['v_city'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['v_city' => 'id']],
            [['v_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vehicles::className(), 'targetAttribute' => ['v_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'v_id' => 'V ID',
            'v_city' => 'V City',
            'v_mileage' => 'V Mileage',
            'v_year' => 'V Year',
        ];
    }

    /**
     * Gets query for [[VCity]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVCity()
    {
        return $this->hasOne(City::className(), ['id' => 'v_city']);
    }
    public function getVMileage()
    {
        return $this->hasOne(Mileage::className(), ['id' => 'v_mileage']);
    }

    /**
     * Gets query for [[V]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getV()
    {
        return $this->hasOne(Vehicles::className(), ['id' => 'v_id']);
    }
}
