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
		$sql = 'SELECT user_id
			FROM ' . USERS_TABLE . '
			WHERE username = "' . $db->sql_escape($_POST['user_id']) . '"';
		$result = $db->sql_query($sql);
		if (!($buyer = $db->sql_fetchrow($result)))
			message_die(GENERAL_ERROR, 'USER_NOT_FOUND');
		$db->sql_freeresult($result);
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

	redirect(append_sid('cans.' . PHP_EXT));
}
else
{
	$template_to_parse = 'items_add_body.tpl';
	$template->assign_vars(array(
		'S_HIDDEN_FIELDS' => build_hidden_fields(array('mode' => 'save')),
	));
	$class_form->create_input_form($table_fields_history, $inputs_array, $current_time, $s_bbcb_global, $mode, $action, $items_row);
}