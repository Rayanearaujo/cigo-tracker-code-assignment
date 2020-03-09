<?php

use yii\db\Migration;

/**
 * Class m200306_220445_add_status_column_in_orders_table
 */
class m200306_220445_add_status_column_in_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%orders}}', 'order_status',
            $this->string(32)->after('order_type'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%orders}}', 'order_status');
    }
}
