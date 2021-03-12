<?php

namespace common\models\BaseModels;

use common\components\BaseActiveRecord;
use common\models\Make as ModelsMake;
use Yii;

/**
 * This is the model class for table "make".
 *
 * @property int $id
 * @property string $m_name
 * @property string $make_logo
 *
 * @property Models[] $models
 * @property Vehicles[] $vehicles
 */
class Make extends BaseActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'make';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['m_name', 'make_logo'], 'required'],
            [['m_name'], 'string', 'max' => 255],
            [['make_logo'], 'string', 'max' => 500],
            [['m_name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'm_name' => 'M Name',
            'make_logo' => 'Make Logo',
        ];
    }

    /**
     * Gets query for [[Models]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getModels()
    {
        return $this->hasMany(Models::className(), ['make_v_id' => 'id']);
    }

    /**
     * Gets query for [[Vehicles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVehicles()
    {
        return $this->hasMany(Vehicles::className(), ['v_make_id' => 'id']);
    }
}
