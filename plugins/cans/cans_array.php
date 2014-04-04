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

$item_id = 'id';
$item_id_history = 'id';

$current_time = time();

$table_fields = array(
	'id' => array(
		'lang_key' => '',
		'type' => 'HIDDEN',
	),

	'name' => array(
		'lang_key' => 'CAN_NAME',
		'type' => 'VARCHAR',
		'default' => '',
	),
	'price' => array(
		'lang_key' => 'CAN_PRICE',
		'type' => 'FLOAT',
		'number_format' => array(
			'decimals' => 2,
		),
		'default' => '0.00',
		// todo display_func => euro sigle
	),
	'count' => array(
		'lang_key' => 'CAN_COUNT',
		'type' => 'INT',
		'default' => 1,
	),
);

$table_fields_history = array(
	'id' => array(
		'lang_key' => '',
		'type' => 'HIDDEN',
	),
	'can_id' => array(
		'lang_key' => '',
		'type' => 'HIDDEN',
	),
	'date' => array(
		'lang_key' => '',
		'type' => 'HIDDEN',
	),

	'count' => array(
		'lang_key' => 'CAN_COUNT',
		'type' => 'INT',
		'default' => 1,
	),
	'user_id' => array(
		'lang_key' => 'Username',
		'is_user_id' => true,
		'type' => 'USERNAME_INPUT_JQUI',
	),

	// fake stuff
	'can_js_stuff' => array(
		'input_extra' => array(
			'type' => 'FUNCTION',
			'get_func' => 'display_current_can',
		),
	),
);

foreach ($table_fields as $k => $v)
{
	$table_fields[$k]['admin_level'] = (isset($table_fields[$k]['admin_level']) ? $table_fields[$k]['admin_level'] : AUTH_ADMIN);
	$table_fields[$k]['input_level'] = (isset($table_fields[$k]['input_level']) ? $table_fields[$k]['input_level'] : AUTH_ADMIN);
	$table_fields[$k]['edit_level'] = (isset($table_fields[$k]['edit_level']) ? $table_fields[$k]['edit_level'] : AUTH_ADMIN);
	$table_fields[$k]['view_level'] = (isset($table_fields[$k]['view_level']) ? $table_fields[$k]['view_level'] : AUTH_ADMIN);
	$table_fields[$k]['default'] = (isset($table_fields[$k]['default']) ? $table_fields[$k]['default'] : 0);
}

foreach ($table_fields_history	 as $k => $v)
{
	$table_fields_history[$k]['admin_level'] = (isset($table_fields_history[$k]['admin_level']) ? $table_fields_history[$k]['admin_level'] : AUTH_ADMIN);
	$table_fields_history[$k]['input_level'] = (isset($table_fields_history[$k]['input_level']) ? $table_fields_history[$k]['input_level'] : AUTH_ADMIN);
	$table_fields_history[$k]['edit_level'] = (isset($table_fields_history[$k]['edit_level']) ? $table_fields_history[$k]['edit_level'] : AUTH_ADMIN);
	$table_fields_history[$k]['view_level'] = (isset($table_fields_history[$k]['view_level']) ? $table_fields_history[$k]['view_level'] : AUTH_ADMIN);
	$table_fields_history[$k]['default'] = (isset($table_fields_history[$k]['default']) ? $table_fields_history[$k]['default'] : 0);
}