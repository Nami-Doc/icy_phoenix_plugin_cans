<?php
/**
*
* @package Icy Phoenix
* @version $Id$
* @copyright (c) 2008 Icy Phoenix
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

if (!defined('IN_ICYPHOENIX'))
{
	die('Hacking attempt');
}

$install_data = array(
	'1.0.0' => array(
		'sql' => array(
			// schema
			"CREATE TABLE `" . $table_prefix . "cans` (	
				`id` int(9) not null primary key auto_increment,
				`name` varchar(255) not null,
				`price` decimal(5,2) not null,
				`count` int(9) not null default 0
			);",
			"CREATE TABLE `" . $table_prefix . "cans_history` (
				`id` int(9) not null primary key auto_increment,
				`can_id` int(9),
				`date` int(9) COMMENT 'unix timestamp'
			);",

			// basic
			"INSERT INTO `" . $table_prefix . "cms_layout_special` (`page_id`, `name`, `filename`, `global_blocks`, `config_vars`, `view`, `groups`) VALUES ('cans', 'cans', 'cans.php', 0, '', 0, '');",
		),
	),
	'1.1.0' => array(
		'sql' => array(
			'ALTER TABLE `' . $table_prefix . 'cans_history` ADD COLUMN user_id int(9);',
		),
	),
	'1.2.0' => array(
		'sql' => array(
			'ALTER TABLE `' . $table_prefix . 'cans_history` ADD COLUMN count int(9) DEFAULT 1;',
		),
	),
	'1.3.0' => array(
		'sql' => array(
			'ALTER TABLE `' . $table_prefix . 'users` ADD COLUMN user_money int(9) DEFAULT 0;',
		),
	),
);

$uninstall_data = array(
	'sql' => array(
		// schema
		"DROP TABLE `" . $table_prefix . "cans`;",
		"DROP TABLE `" . $table_prefix . "cans_history`;",

		// basic
		"DELETE FROM `" . $table_prefix . "cms_layout_special` WHERE filename = 'cans.php';",
		"DELETE FROM `" . $table_prefix . "cms_nav_menu` WHERE menu_links = 'cans.php';",
		"ALTER TABLE `" . $table_prefix . "users` DROP COLUMN user_money;",
	),
);

?>