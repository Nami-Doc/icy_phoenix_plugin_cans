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

$template->assign_vars(array(
	'U_CAN' => append_sid('cans.' . PHP_EXT),
	'U_CAN_ADD' => append_sid('cans.' . PHP_EXT . '?page=add'),
));

$sql = 'SELECT *
	FROM ' . CANS_TABLE;
$result = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($result))
{
	$template->assign_block_vars('cans', array(
		'ID' => $row['id'],
		'NAME' => $row['name'],
		'PRICE' => $row['price'],
		'COUNT' => $row['count'],
		'S_EDIT' => append_sid('cans.' . PHP_EXT . '?page=add&amp;mode=edit&amp;id=' . $row['id']),
		'S_DELETE' => append_sid('cans.' . PHP_EXT . '?page=delete&amp;id=' . $row['id']),
	));
}
$db->sql_freeresult($result);