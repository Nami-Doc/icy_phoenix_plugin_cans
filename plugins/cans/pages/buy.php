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
$mode = 'buy';
if (isset($_POST['submit']))
	$mode = 'save';
$template->assign_var('MODE', $mode);

$can = $class_db->get_item($id);
$template->assign_block_vars('cans', array(
	'ID' => $can['id'],
	'NAME' => $can['name'],
	'PRICE' => $can['price'],
	'COUNT' => $can['count'],
));
$template->assign_vars(array(
	'U_CAN_BUY' => append_sid('cans.' . PHP_EXT . '?page=buy&amp;id=' . $id),
));

if ($mode == 'save')
{
	if ($can['count'] < 1)
		message_die(sprintf($lang['CAN_NO_MORE'], $can['NAME']), GENERAL_ERROR);

	if (!empty($_POST['user']))
	{
		$sql = 'SELECT user_id
			FROM ' . USERS_TABLE . '
			WHERE username = "' . $db->sql_escape($_POST['user']) . '"';
		$result = $db->sql_query($sql);
		if (!($buyer = $db->sql_fetchrow($result)))
			message_die(GENERAL_ERROR, 'USER_NOT_FOUND');
		$db->sql_freeresult($result);
	}
	else $buyer = null;

	$class_db->update_item($id, array('count' => ($can['count']-$_POST['number'])));

	$history = array(
		'can_id' => $id,
		'user_id' => $buyer ? $buyer['user_id'] : 0 ,
		'date' => strtotime('12:00:00'),
	);
	$class_db_history->insert_item($history);

	redirect(append_sid('cans.' . PHP_EXT));
}