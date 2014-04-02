<?php
/**
*
* @package Icy Phoenix
* @version $Id$
* @copyright (c) 2008 Icy Phoenix
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

define('IN_ICYPHOENIX', true);
if (!defined('IP_ROOT_PATH')) define('IP_ROOT_PATH', './');
if (!defined('PHP_EXT')) define('PHP_EXT', substr(strrchr(__FILE__, '.'), 1));
include(IP_ROOT_PATH . 'common.' . PHP_EXT);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();
// End session management

$plugin_name = 'cans';
$cms_page['page_id'] = $plugin_name;

if (empty($config['plugins'][$plugin_name]['enabled']) || empty($config['plugins'][$plugin_name]['dir']))
{
	message_die(GENERAL_MESSAGE, 'PLUGIN_DISABLED');
}

if (!$user->data['session_logged_in'])
{
	$redirect_append = '?redirect=' . urlencode('cans.' . PHP_EXT) . '&admin=1';
	redirect(append_sid(IP_ROOT_PATH . CMS_PAGE_LOGIN . $redirect_append, true));
}

define('THIS_FILE', basename(__FILE__));
include(IP_ROOT_PATH . PLUGINS_PATH . $config['plugins'][$plugin_name]['dir'] . 'common.' . PHP_EXT);
include(CANS_PLUGIN_PATH . 'main.' . PHP_EXT);
