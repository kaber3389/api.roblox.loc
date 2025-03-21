<?php

use yii\db\Migration;

class m250321_084312_user_jwt_refresh_token extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250321_084312_user_jwt_refresh_token cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250321_084312_user_jwt_refresh_token cannot be reverted.\n";

        return false;
    }
    */
}
