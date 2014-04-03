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

define('CANS_PLUGIN_PATH', PLUGINS_PATH . $config['plugins'][$plugin_name]['dir']);
define('CANS_ROOT_PATH', IP_ROOT_PATH . CANS_PLUGIN_PATH);
define('CANS_TPL_PATH', '../../' . CANS_PLUGIN_PATH . 'templates/');
define('CANS_ADM_TPL_PATH', '../../' . CANS_PLUGIN_PATH . 'adm/templates/');
define('CANS_PAGES_PATH', CANS_PLUGIN_PATH . 'pages/');

define('CANS_TABLE', $table_prefix . 'cans');
define('CANS_HISTORY_TABLE', $table_prefix . 'cans_history');

$cms_page['page_id'] = $plugin_name;
$cms_page['page_nav'] = (!empty($cms_config_layouts[$cms_page['page_id']]['page_nav']) ? true : false);
$cms_page['global_blocks'] = (!empty($cms_config_layouts[$cms_page['page_id']]['global_blocks']) ? true : false);
$cms_auth_level = (isset($cms_config_layouts[$cms_page['page_id']]['view']) ? $cms_config_layouts[$cms_page['page_id']]['view'] : AUTH_ALL);
check_page_auth($cms_page['page_id'], $cms_auth_level);

if (!class_exists('class_plugins')) include(IP_ROOT_PATH . 'includes/class_plugins.' . PHP_EXT);
if (empty($class_plugins)) $class_plugins = new class_plugins();
$class_plugins->setup_lang($config['plugins'][$plugin_name]['dir']);

if (!class_exists('class_form')) include(IP_ROOT_PATH . 'includes/class_form.' . PHP_EXT);
if (empty($class_form)) $class_form = new class_form();

if (!class_exists('class_db')) include(IP_ROOT_PATH . 'includes/class_db.' . PHP_EXT);
if (empty($class_db)) $class_db = new class_db();
$class_db->main_db_table = CANS_TABLE;
$class_db->main_db_item = 'id';
$class_db_history = new class_db();
$class_db_history->main_db_table = CANS_HISTORY_TABLE;
$class_db_history->main_db_item = 'id';

include CANS_ROOT_PATH . 'cans_array.' . PHP_EXT;

$template->assign_vars(array(
	'U_CAN' => append_sid('cans.' . PHP_EXT),
	'U_CAN_ADD' => append_sid('cans.' . PHP_EXT . '?page=add'),
));