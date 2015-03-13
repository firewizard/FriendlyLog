<?php

/**
 * @package Mandagreen_FriednlyLog
 * @version 1.0.0
 */

/** @var Mage_Core_Model_Resource_Setup $installer */
$installer = $this;
$installer->startSetup();

$table = $installer->getTable('mgfriendlylog/friendlylog_queue');
$installer->run("
CREATE TABLE IF NOT EXISTS {$table}(
  log_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  subject VARCHAR(255),
  group_name VARCHAR(32) NOT NULL DEFAULT 'general',
  details TEXT,
  date_added DATETIME,
  PRIMARY KEY (log_id),
  KEY (group_name)
) ENGINE=MYISAM");

$installer->endSetup();
