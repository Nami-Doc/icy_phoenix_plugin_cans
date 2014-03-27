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

// @TODO confirm (26/03/2014)

$sql = 'DELETE FROM ' . CANS_TABLE . '
	WHERE id = ' . request_var('id', 0);
$db->sql_query($sql);
redirect('cans.' . PHP_EXT);