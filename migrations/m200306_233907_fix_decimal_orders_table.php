<?php

use yii\db\Migration;

/**
 * Class m200306_233907_fix_decimal_orders_table
 */
class m200306_233907_fix_decimal_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%orders}}','latitude', $this->decimal(10,7));
        $this->alterColumn('{{%orders}}','longitude', $this->decimal(10,7));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%orders}}','latitude', $this->decimal(0));
        $this->alterColumn('{{%orders}}','longitude', $this->decimal(0));
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200306_233907_fix_decimal_orders_table cannot be reverted.\n";

        return false;
    }
    */
}
