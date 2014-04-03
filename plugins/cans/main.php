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

$page = isset($_GET['page']) ? $_GET['page'] : '';
if (strpos($page, '/') !== false || !file_exists(CANS_PAGES_PATH . $page . '.' . PHP_EXT))
	$page = 'cans';

$template_file = "{$page}_body.tpl";
$template_to_parse = null;
include CANS_PAGES_PATH . $page . '.' . PHP_EXT;

if ($template_to_parse)
	full_page_generation($template_to_parse, $lang['PLUGIN_CANS']);
else
	full_page_generation($class_plugins->get_tpl_file(CANS_TPL_PATH, $template_file), $lang['PLUGIN_CANS']);