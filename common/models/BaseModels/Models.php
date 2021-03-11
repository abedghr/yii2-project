<?php

namespace common\models\BaseModels;

use common\components\BaseActiveRecord;
use common\models\Models as ModelsModels;
use Yii;

/**
 * This is the model class for table "models".
 *
 * @property int $id
 * @property int $make_v_id
 * @property string $model_name
 * @property string|null $model_description
 * @property string $model_logo
 *
 * @property Make $makeV
 * @property Vehicles[] $vehicles
 */
class Models extends BaseActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'models';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['make_v_id', 'model_name', 'model_logo'], 'required'],
            [['make_v_id'], 'integer'],
            [['model_description', 'model_logo'], 'string'],
            [['model_name'], 'string', 'max' => 255],
            [['make_v_id'], 'exist', 'skipOnError' => true, 'targetClass' => Make::className(), 'targetAttribute' => ['make_v_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'make_v_id' => 'Make V ID',
            'model_name' => 'Model Name',
            'model_description' => 'Model Description',
            'model_logo' => 'Model Logo',
        ];
    }

    /**
     * Gets query for [[MakeV]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMakeV()
    {
        return $this->hasOne(Make::className(), ['id' => 'make_v_id']);
    }

    /**
     * Gets query for [[Vehicles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVehicles()
    {
        return $this->hasMany(Vehicles::className(), ['v_model_id' => 'id']);
    }
}
