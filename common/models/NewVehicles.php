<?php

namespace common\models;

use common\models\BaseModels\NewVehicles as BaseModelsNewVehicles;
use Yii;

/**
 * This is the model class for table "newVehicles".
 *
 * @property int $id
 * @property int $v_id
 * @property string $v_engine
 * @property string $video_url
 * @property string|null $v_year
 *
 * @property Vehicles $v
 */
class NewVehicles extends BaseModelsNewVehicles
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    public $imageFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'newVehicles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['v_engine', 'video_url','v_year'], 'required'],
            [['v_id'], 'integer'],
            [['v_engine'], 'string', 'max' => 255],
            [['video_url'], 'string', 'max' => 500],
            [['v_year'], 'string', 'max' => 10],
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
            'v_engine' => 'V Engine',
            'video_url' => 'Video Url',
            'v_year' => 'V Year',
        ];
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
