<?php
/**
*
* @package Icy Phoenix
* @version $Id$
* @copyright (c) 2008 Icy Phoenix
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

class class_can
{
	public $data;

	public function __construct($data)
	{
		global $class_db;

		if (is_array($data))
			$this->data = $data;
		else // $data is actually $id
			$this->data = $class_db->get_item($data);

		$this->assign_template();
	}

	private function assign_template()
	{
		global $template;

		$template->assign_block_vars('cans', array(
			'ID' => $this->data['id'],
			'NAME' => $this->data['name'],
			'PRICE' => $this->data['price'],
			'COUNT' => $this->data['count'],
			'U_BUY' => append_sid('cans.' . PHP_EXT . '?page=buy&amp;id=' . $this->data['id']),
			'U_EDIT' => append_sid('cans.' . PHP_EXT . '?page=cans&amp;mode=input&amp;action=edit&amp;id=' . $this->data['id']),
			'U_DELETE' => append_sid('cans.' . PHP_EXT . '?page=cans&amp;mode=delete&amp;id=' . $this->data['id']),
			'U_HISTORY' => append_sid('cans.' . PHP_EXT . '?page=history&amp;id=' . $this->data['id']),
		));
	}

	/**
	 * @return array History array
	 */
	public function get_history()
	{
		global $db;

		$sql = 'SELECT ch.*, u.username, u.user_color, u.user_active
			FROM ' . CANS_HISTORY_TABLE . ' ch
				LEFT JOIN ' . USERS_TABLE . ' u ON u.user_id = ch.user_id
			WHERE ch.can_id = ' . $this->data['id'];
		$result = $db->sql_query($sql);
		$rows = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$rows[] = $row;
		}
		$db->sql_freeresult($result);
		return $rows;
	}
}