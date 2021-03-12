<?php

namespace common\models\BaseModels;

use common\components\BaseActiveRecord;
use common\models\Vehicles as ModelsVehicles;
use Yii;

/**
 * This is the model class for table "vehicles".
 *
 * @property int $id
 * @property string $v_name
 * @property int $v_make_id
 * @property int $v_model_id
 * @property string $manufacturing_year
 * @property string $main_image
 * @property float $price
 * @property int $user_id
 * @property string $type
 * @property string $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Comments[] $comments
 * @property Media[] $media
 * @property NewVehicles[] $newVehicles
 * @property UsedVehicles[] $usedVehicles
 * @property User $user
 * @property Make $vMake
 * @property Models $vModel
 */
class Vehicles extends BaseActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vehicles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['v_name', 'v_make_id', 'v_model_id', 'manufacturing_year', 'main_image', 'price', 'user_id', 'created_at', 'updated_at'], 'required'],
            [['v_make_id', 'v_model_id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['main_image'], 'string'],
            [['price'], 'number'],
            [['v_name', 'manufacturing_year', 'type', 'status'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['v_make_id'], 'exist', 'skipOnError' => true, 'targetClass' => Make::className(), 'targetAttribute' => ['v_make_id' => 'id']],
            [['v_model_id'], 'exist', 'skipOnError' => true, 'targetClass' => Models::className(), 'targetAttribute' => ['v_model_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'v_name' => 'V Name',
            'v_make_id' => 'V Make ID',
            'v_model_id' => 'V Model ID',
            'manufacturing_year' => 'Manufacturing Year',
            'main_image' => 'Main Image',
            'price' => 'Price',
            'user_id' => 'User ID',
            'type' => 'Type',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['vehicle_id' => 'id']);
    }

    /**
     * Gets query for [[Media]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedia()
    {
        return $this->hasMany(Media::className(), ['v_id' => 'id']);
    }

    /**
     * Gets query for [[NewVehicles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNewVehicles()
    {
        return $this->hasOne(NewVehicles::className(), ['v_id' => 'id']);
    }

    /**
     * Gets query for [[UsedVehicles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsedVehicles()
    {
        return $this->hasOne(UsedVehicles::className(), ['v_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[VMake]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVMake()
    {
        return $this->hasOne(Make::className(), ['id' => 'v_make_id']);
    }

    /**
     * Gets query for [[VModel]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVModel()
    {
        return $this->hasOne(Models::className(), ['id' => 'v_model_id']);
    }
}
