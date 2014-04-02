<?php
/**
*
* @package Icy Phoenix
* @version $Id$
* @copyright (c) 2008 Icy Phoenix
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
*
* @Extra credits for this file
* OOHOO < webdev@phpbb-tw.net >
* Stefan2k1 and ddonker from www.portedmods.com
* CRLin from http://mail.dhjh.tcc.edu.tw/~gzqbyr/
* Lopalong
*
*/

if (!defined('IN_ICYPHOENIX'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'PLUGIN_CANS' => 'E-Canette',
	'CAN_NAME' => 'Nom',
	'CAN_PRICE' => 'Prix',
	'CAN_COUNT' => 'Stock',
	'CAN_NO_STOCK' => 'Plus de stock',
	'CAN_NO_MORE' => '<b>%s</b> : plus de stock',
	'CAN_BUY' => 'Acheter',
	'CAN_ADD' => 'Ajouter un produit',
	'ACTIONS' => 'Actions',
	'CAN_EMPTY_FOR_ANONYMOUS' => 'leave empty for anonymous users',
));

?>