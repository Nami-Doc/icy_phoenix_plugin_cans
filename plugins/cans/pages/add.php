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

$class_db->main_db_table = CANS_TABLE;
$class_db->main_db_item = 'id';

$mode = request_var('mode', 'add');
if (isset($_POST['submit']))
	$mode = 'save';
$id = request_var('id', 0);

if ($mode == 'save')
{
	$data = array(
		'name' => $_POST['name'],
		'price' => abs(doubleval($_POST['price'])),
		'count' => abs(intval($_POST['count'])),
	);

	if ($id)
		$class_db->update_item($id, $data);
	else
		$class_db->insert_item($data);
	redirect(append_sid('cans.' . PHP_EXT));
}
if ($mode == 'edit' && $id)
{
	$sql = 'SELECT *
		FROM ' . CANS_TABLE . '
		WHERE id = ' . $id;
	$result = $db->sql_query($sql);
	if (!($row = $db->sql_fetchrow($result)))
		message_die(GENERAL_ERROR, "Can't find can");
	$db->sql_freeresult($result);

	$s_hidden_fields = '';
	$s_hidden_fields .= '<input type="hidden" name="id" value="' . $id . '" />';

	$template->assign_vars(array(
		'CAN_NAME' => $row['name'],
		'CAN_PRICE' => $row['price'],
		'CAN_COUNT' => $row['count'],

		'S_HIDDEN_FIELDS' => $s_hidden_fields,
	));
}

$template->assign_vars(array(
	'S_FORM_ACTION' => append_sid('cans.' . PHP_EXT . '?page=add'),
));