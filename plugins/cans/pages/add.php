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
	$row = $class_db->get_item($db);
	$s_hidden_fields = '<input type="hidden" name="id" value="' . $id . '" />';

	$template->assign_vars(array(
		'CAN_NAME' => $row['name'],
		'CAN_PRICE' => $row['price'],
		'CAN_COUNT' => $row['count'],

		'S_HIDDEN_FIELDS' => $s_hidden_fields,
	));

	$template_to_parse = 'items_add_body.tpl';
}

$template->assign_vars(array(
	'S_FORM_ACTION' => append_sid('cans.' . PHP_EXT . '?page=add'),
));