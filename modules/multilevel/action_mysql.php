<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NVholding <contact@nvholding.vn>
 * @Copyright (C) 2021 NVholding. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Sat, 17 Jul 2021 08:08:05 GMT
 */

if (!defined('NV_MAINFILE'))
    die('Stop!!!');

$sql_drop_module = [];

$array_table = [
    'city',
    'district',
    'ward',
    'street',
];

$table = $db_config['prefix'] . '_' . $lang . '_' . $module_data;
$result = $db->query('SHOW TABLE STATUS LIKE ' . $db->quote($table . '_%'));
while ($item = $result->fetch()) {
    $name = substr($item['name'], strlen($table) + 1);
    if (preg_match('/^' . $db_config['prefix'] . '\_' . $lang . '\_' . $module_data . '\_/', $item['name']) and (preg_match('/^([0-9]+)$/', $name) or in_array($name, $array_table) or preg_match('/^bodyhtml\_([0-9]+)$/', $name))) {
        $sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $item['name'];
    }
}

$result = $db->query("SHOW TABLE STATUS LIKE '" . $db_config['prefix'] . "\_" . $lang . "\_comment'");
$rows = $result->fetchAll();
if (sizeof($rows)) {
    $sql_drop_module[] = 'DELETE FROM ' . $db_config['prefix'] . '_' . $lang . "_comment WHERE module='" . $module_name . "'";
}

$sql_create_module = $sql_drop_module;

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_city (
	city_id mediumint(8) NOT NULL AUTO_INCREMENT,
	title varchar(250) NOT NULL DEFAULT '',
	alias varchar(250) NOT NULL DEFAULT '',
	weight mediumint(8) unsigned NOT NULL DEFAULT '0',
	status tinyint(1) unsigned NOT NULL DEFAULT '0',
	area tinyint(1) unsigned NOT NULL DEFAULT '0',
	important tinyint(1) unsigned NOT NULL DEFAULT '0',
	type varchar(30) NOT NULL,
	PRIMARY KEY (city_id),
	UNIQUE KEY alias (alias)
) ENGINE=MyISAM";
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (
	district_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
	city_id mediumint(8) unsigned NOT NULL DEFAULT '0',
	title varchar(250) NOT NULL DEFAULT '',
	alias varchar(250) NOT NULL DEFAULT '',
	type varchar(30) NOT NULL,
	location varchar(30) NOT NULL,
	weight mediumint(8) unsigned NOT NULL DEFAULT '0',
	status tinyint(1) unsigned NOT NULL DEFAULT '0',
	PRIMARY KEY (district_id),
	UNIQUE KEY alias_city_id (alias)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_ward (
	ward_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
	district_id mediumint(8) unsigned NOT NULL DEFAULT '0',
	city_id mediumint(8) unsigned NOT NULL DEFAULT '0',
	title varchar(250) NOT NULL DEFAULT '',
	alias varchar(250) NOT NULL DEFAULT '',
	type varchar(30) NOT NULL,
	location varchar(30) NOT NULL,
	weight mediumint(8) unsigned NOT NULL DEFAULT '0',
	status tinyint(1) unsigned NOT NULL DEFAULT '0',
	PRIMARY KEY (ward_id),
	UNIQUE KEY alias_district_id_city_id (alias)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_street (
	street_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
	city_id mediumint(8) unsigned NOT NULL DEFAULT '0',
	district_id mediumint(8) unsigned NOT NULL DEFAULT '0',
	title varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
	type varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
	location varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
	weight mediumint(8) unsigned NOT NULL DEFAULT '0',
	status tinyint(1) unsigned NOT NULL DEFAULT '0',
	PRIMARY KEY (street_id),
	UNIQUE KEY city_id_district_id_title (city_id,district_id,title)
) ENGINE=MyISAM";


//cấu hình hoa hồng

$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'f0', '15')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'f1', '10')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'f2', '1')";


$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'auto_postcomm', '1')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'allowed_comm', '-1')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'view_comm', '6')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'setcomm', '4')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'activecomm', '1')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'emailcomm', '0')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'adminscomm', '')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'sortcomm', '0')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'captcha', '1')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'perpagecomm', '5')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'timeoutcomm', '360')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'allowattachcomm', '0')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'alloweditorcomm', '0')";
