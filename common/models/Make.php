<?php

namespace common\models;

use common\models\BaseModels\Make as BaseModelsMake;
use Yii;

/**
 * This is the model class for table "make".
 *
 * @property int $id
 * @property string $m_name
 * @property string $make_logo
 *
 * @property Models[] $models
 */
class Make extends BaseModelsMake
{
    const SCENARIO_CREATE = "create";
    const SCENARIO_UPDATE = "update";
    public $imageFile;
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
            [['m_name'], 'required'],
            [['m_name'], 'string', 'max' => 255],
            [['imageFile'],'file','extensions' => 'jpg,png,jpeg', 'skipOnEmpty' => false,'on'=>self::SCENARIO_CREATE],
            [['imageFile'],'file','extensions' => 'jpg,png,jpeg', 'skipOnEmpty' => true , 'on'=>self::SCENARIO_UPDATE],
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
        return $this->hasMany(Models::class, ['make_v_id' => 'id']);
    }
}
