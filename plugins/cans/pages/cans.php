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
	$items_row = array();
	if ($action == 'edit')
	{
		$items_row = $class_db->get_item($id);
		if (!$items_row)
			message_die(GENERAL_ERROR, 'CAN_NOT_FOUND');
	}

	$template->assign_vars(array(
		'S_HIDDEN_FIELDS' => build_hidden_fields(array('mode' => 'save')),
	));
	$class_form->create_input_form($table_fields, $inputs_array, $current_time, $s_bbcb_global, $mode, $action, $items_row);

	$template_to_parse = 'items_add_body.tpl';
}
else if ($mode == 'delete')
{
	// @TODO confirm (26/03/2014)
	$class_db->delete_item($id);
	redirect('cans.' . PHP_EXT);
}
else
{
	$template_file = 'list_body.tpl';
	foreach ($class_db->get_items(null, null, null, null) as $row)
	{
		new class_can($row); // actually assigns template vars
	}
}

$template->assign_vars(array(
	'U_ADD_ACTION' => append_sid('cans.' . PHP_EXT . '?mode=input&amp;action=add'),
	'U_HISTORY' => append_sid('cans.' . PHP_EXT . '?page=history'),
));