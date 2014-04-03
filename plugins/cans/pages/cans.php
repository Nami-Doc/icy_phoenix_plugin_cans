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

$mode = request_var('mode', 'list');
if (isset($_POST['submit']))
	$mode = 'save';
$id = request_var('id', 0);

$inputs_array = array();
$input_allowed = $edit_allowed = $admin_allowed = true;
include IP_ROOT_PATH . 'includes/common_forms.' . PHP_EXT;

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
else if ($mode == 'input')
{
	if ($id)
	{
		$row = $class_db->get_item($db);
		$s_hidden_fields = '<input type="hidden" name="id" value="' . $id . '" />';

		$template->assign_vars(array(
			'CAN_NAME' => $row['name'],
			'CAN_PRICE' => $row['price'],
			'CAN_COUNT' => $row['count'],

			'S_HIDDEN_FIELDS' => $s_hidden_fields,
		));
	}
	$class_form->create_input_form($table_fields, $inputs_array, $current_time, $s_bbcb_global, $mode, $action, $items_row);

	$template_to_parse = 'items_add_body.tpl';
}
else if ($mode == 'delete')
{
	// @TODO confirm (26/03/2014)

	$sql = 'DELETE FROM ' . CANS_TABLE . '
		WHERE id = ' . request_var('id', 0);
	$db->sql_query($sql);
	redirect('cans.' . PHP_EXT);
}
else
{
	$mode = 'list';

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
			'U_BUY' => append_sid('cans.' . PHP_EXT . '?page=cans&amp;id=' . $row['id']),
			'U_EDIT' => append_sid('cans.' . PHP_EXT . '?page=cans&amp;mode=input&amp;id=' . $row['id']),
			'U_DELETE' => append_sid('cans.' . PHP_EXT . '?page=cans&amp;mode=delete&amp;id=' . $row['id']),
			'U_HISTORY' => append_sid('cans.' . PHP_EXT . '?page=history&amp;id=' . $row['id']),
		));
	}
	$db->sql_freeresult($result);
}

$template->assign_vars(array(
	'U_FORM_ACTION' => append_sid('cans.' . PHP_EXT . '?page=add'),
	'U_HISTORY' => append_sid('cans.' . PHP_EXT . '?page=history'),
	'MODE' => $mode,
));