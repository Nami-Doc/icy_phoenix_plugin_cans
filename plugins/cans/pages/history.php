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

$series = array();
$id = request_var('id', 0);
if ($id)
	$cans = array($class_db->get_item($id));
else
	$cans = $class_db->get_items(null, null, null, null);

foreach ($cans as $can)
{
	$class_can = new class_can($can);
	$history_data = array();
	foreach ($class_can->get_history() as $row)
	{
		// prepare graph data
		$d = '' . ($row['date'] * 1000);
		if (empty($history_data[$d]))
			$history_data[$d] = 1;
		else
			$history_data[$d] += $row['count'];
		
		// assign templates vars
		$template->assign_block_vars('cans.history', array(
			'U_USER' => $row['user_id'] ? colorize_username($row['user_id'], $row['username'], $row['user_color'], $row['user_active']) : '',
			'DATE' => date('d/m/Y', $row['date']),
			'COUNT' => $row['count'],
		));
	}
	ksort($history_data); // really, that should never be needed
	$series[] = array(
		'name' => $can['name'],
		'data' => associative_array_to_tuples($history_data),
	);
}
$template->assign_var('SERIES', json_encode($series));

$template->js_include[] = '../../plugins/cans/templates/common/js/highcharts.js';