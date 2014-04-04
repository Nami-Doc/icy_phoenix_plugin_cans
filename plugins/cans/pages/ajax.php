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

switch (request_var('mode', ''))
{
	case 'money':
		$sql = 'SELECT user_money FROM ' . USERS_TABLE . '
			WHERE username = "' . $db->sql_escape($_GET['username']) . '"
			LIMIT 1';
		$result = $db->sql_query($sql);
		if ($row = $db->sql_fetchrow($result))
			exit($row['user_money']);
		else
			exit('');
	break;
}