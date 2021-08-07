<?php

use yii\db\Migration;

/**
 * Class m210806_202343_init
 */
class m210806_202343_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE `url` (
                `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                `full_url` varchar(255)  NOT NULL DEFAULT '',
                `short_url` varchar(255) UNIQUE NOT NULL DEFAULT '',
                `counter` int(11) unsigned NOT NULL DEFAULT '0',
                `expired_at` datetime NULL DEFAULT NULL,
                `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `updated_at` datetime NULL DEFAULT NULL,
                PRIMARY KEY (`id`),
                KEY `url_short_url` (`short_url`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute("DROP TABLE IF EXISTS `url`;");
    }
}
