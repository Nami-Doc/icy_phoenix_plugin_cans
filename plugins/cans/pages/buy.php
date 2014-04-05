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

$id = request_var('id', 0);
$mode = request_var('mode', 'buy');
$inputs_array = array();

$class_can = new class_can($id);

if ($mode == 'save')
{
	$count = empty($_POST['count']) || !is_numeric($_POST['count']) ? 1 : $_POST['count'];
	if ($class_can->data['count'] - $count < 0)
		message_die(GENERAL_ERROR, sprintf($lang['CAN_NO_MORE'], $class_can->data['name']));

	if (!empty($_POST['user_id']))
	{
		$buyer = find_user($_POST['user_id']);
		if (!empty($_POST['use_acc']))
		{
			$price = floatval($class_can->data['price']) * intval($count);
			if ($buyer['user_money'] < $price)
				message_die(GENERAL_ERROR, 'CAN_NO_MONEY');
			$buyer['user_money'] = floatval($buyer['user_money']) - $price;
			$sql = 'UPDATE ' . USERS_TABLE . '
				SET user_money = user_money - ' . $price . '
				WHERE user_id = ' . $buyer['user_id'];
			$db->sql_query($sql);
		}
	}
	else $buyer = null;

	$class_db->update_item($id, array('count' => $class_can->data['count'] - $count));

	$history = array(
		'can_id' => $id,
		'user_id' => $buyer ? $buyer['user_id'] : 0,
		'date' => strtotime('12:00:00'),
		'count' => $count,
	);
	$class_db_history->insert_item($history);

	if (empty($_POST['use_acc']))
		redirect(append_sid('cans.' . PHP_EXT));
	else
		message_die(GENERAL_MESSAGE, sprintf($lang['CAN_USER_INVOICED'], $buyer['username'], round($price, 2), $buyer['user_money']) .
			'<br />' . sprintf($lang['RETURN_PAGE'], '<a href="cans.' . PHP_EXT . '">', '</a>'));
}
else
{
	$template_to_parse = 'items_add_body.tpl';
	$template->assign_vars(array(
		'S_HIDDEN_FIELDS' => build_hidden_fields(array('mode' => 'save')),
	));
	$template->js_include[] = '../../plugins/cans/templates/common/js/page_buy.js';
	$class_form->create_input_form($table_fields_history, $inputs_array, $current_time, $s_bbcb_global, $mode, $action, $items_row);
}

function find_user($id)
{
	global $db;
	$sql = 'SELECT *
		FROM ' . USERS_TABLE . '
		WHERE user_id = ' . intval($id);
	$result = $db->sql_query($sql);
	if (!($data = $db->sql_fetchrow($result)))
		message_die(GENERAL_ERROR, 'USER_NOT_FOUND');
	$db->sql_freeresult($result);
	return $data;
}

function display_current_can()
{
	global $class_can, $lang;

	return '<script>can = ' . json_encode($class_can->data) . ';</script>' . $lang['CAN_NO_APPROX'];
}

function display_can_stock()
{
	global $class_can;

	return $class_can->data['count'];
}