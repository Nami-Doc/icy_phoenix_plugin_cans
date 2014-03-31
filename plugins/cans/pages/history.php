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

// This page was made with extensibility in mind
// Adding the ability to view history for several products
//  should be very easy.
$id = request_var('id', 0);
$sql = 'SELECT *
	FROM ' . CANS_TABLE . '
	WHERE id = ' . $id;
$result = $db->sql_query($sql);
$series = array();
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
$history_data = array();
while ($row = $db->sql_fetchrow($result))
{
	// prepare graph data
	$d = '' . ($row['date'] * 1000);
	if (empty($history_data[$d]))
		$history_data[$d] = 1;
	else
		$history_data[$d]++;
	
	// assign templates vars
	$template->assign_block_vars('cans.history', array(
		'U_USER' => $row['user_id'] ? colorize_username($row['user_id'], $row['username'], $row['user_color'], $row['user_active']) : '',
		'DATE' => date('d/m/Y', $row['date']),
	));
}
$db->sql_freeresult($result);
ksort($history_data); // really, that should never be needed
$series[] = array(
	'name' => $can['name'],
	'data' => associative_array_to_tuples($history_data),
);

$template->assign_var('SERIES', json_encode($series));

$template->js_include[] = '../../plugins/cans/templates/common/js/highcharts.js';

// transforms an associative array to a list of tuples
// can also apply a transform fn
function associative_array_to_tuples($array, $f = null)
{
	$ret = array();
	foreach ($array as $k => $v)
		// convert to float for json_encode (int overflows)
		$ret[] = array((float) $k, $v);
	return $ret;
}