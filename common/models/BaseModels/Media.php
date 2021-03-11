<?php

namespace common\models\BaseModels;

use common\components\BaseActiveRecord;
use common\models\Media as ModelsMedia;
use Yii;

/**
 * This is the model class for table "media".
 *
 * @property int $id
 * @property int|null $v_id
 * @property string|null $v_media
 *
 * @property Vehicles $v
 */
class Media extends BaseActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'media';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['v_id'], 'integer'],
            [['v_media'], 'string', 'max' => 500],
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
            'v_media' => 'V Media',
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
