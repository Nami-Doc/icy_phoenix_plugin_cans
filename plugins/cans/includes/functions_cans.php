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