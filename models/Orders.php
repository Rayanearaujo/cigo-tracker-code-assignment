<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property string $first_name
 * @property string|null $last_name
 * @property string|null $email
 * @property string $phone_number
 * @property string $order_type
 * @property string $order_status
 * @property float|null $order_value
 * @property string $scheduled_date
 * @property string $street_address
 * @property string $city
 * @property string $state
 * @property string|null $zip_code
 * @property string $country
 * @property float $latitude
 * @property float $longitude
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'first_name',
                    'phone_number',
                    'order_type',
                    'order_status',
                    'scheduled_date',
                    'street_address',
                    'city',
                    'state',
                    'country',
                    'latitude',
                    'longitude'
                ],
                'required'
            ],
            [['order_value', 'latitude', 'longitude'], 'number'],
            [['scheduled_date'], 'safe'],
            [['first_name', 'last_name', 'email', 'street_address'], 'string', 'max' => 255],
            [['phone_number', 'order_type', 'zip_code', 'country'], 'string', 'max' => 50],
            [['city', 'state'], 'string', 'max' => 100],
        ];
    }

    public function formName()
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'phone_number' => 'Phone Number',
            'order_type' => 'Order Type',
            'order_value' => 'Order Value',
            'order_status' => 'Order Status',
            'scheduled_date' => 'Scheduled Date',
            'street_address' => 'Street Address',
            'city' => 'City',
            'state' => 'State',
            'zip_code' => 'Zip Code',
            'country' => 'Country',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
        ];
    }
}

class OrderStatus
{
    const PENDING = 'pending';
    const ASSIGNED = 'assigned';
    const ON_ROUTE = 'on_route';
    const DONE = 'done';
    const CANCELLED = 'cancelled';

    public static function attributeLabels()
    {
        return [
            OrderStatus::PENDING => 'Pending',
            OrderStatus::ASSIGNED => 'Assigned',
            OrderStatus::ON_ROUTE => 'On Route',
            OrderStatus::DONE => 'Done',
            OrderStatus::CANCELLED => 'Cancelled'
        ];
    }
}
