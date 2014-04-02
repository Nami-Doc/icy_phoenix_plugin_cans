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
$sql = 'SELECT *
	FROM ' . CANS_TABLE . '
	WHERE id = ' . $id;
$result = $db->sql_query($sql);
if (!($can = $db->sql_fetchrow($result)))
	message_die(GENERAL_ERROR, "Can't find can");
$db->sql_freeresult($result);
$template->assign_block_vars('cans', array(
	'ID' => $can['id'],
	'NAME' => $can['name'],
	'PRICE' => $can['price'],
	'COUNT' => $can['count'],
));

$sql = 'SELECT ch.*, u.username, u.user_color, u.user_active
	FROM ' . CANS_HISTORY_TABLE . ' ch
		LEFT JOIN ' . USERS_TABLE . ' u ON u.user_id = ch.user_id
	WHERE ch.can_id = ' . $id;
$result = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($result))
{
	$template->assign_block_vars('cans.history', array(
		'U_USER' => $row['user_id'] ? colorize_username($row['user_id'], $row['username'], $row['user_color'], $row['user_active']) : '',
		'DATE' => date('Y/m/d', $row['date']),
	));
}
$db->sql_freeresult($result);