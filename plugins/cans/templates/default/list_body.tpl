<!-- INCLUDE overall_header.tpl -->

{IMG_THL}{IMG_THC}<span class="forumlink">{L_PLUGIN_CANS}

<a href="{U_HISTORY}"><img title="{L_CAN_HISTORIC}" src="{IMG_CMS_ICON_REPORT}" /></a>
</span>{IMG_THR}<table class="forumlinenb" width="100%" cellspacing="0" cellpadding="0">
<tr>
	<th>{L_CAN_NAME}</th>
	<th>{L_CAN_PRICE}</th>
	<th>{L_CAN_STOCK}</th>
	<th>{L_ACTIONS}</th>
</tr>
<!-- BEGIN cans -->
<tr>
	<td>{cans.NAME}</td>
	<td>{cans.PRICE}€</td>
	<td>{cans.COUNT}</td>
	<td>
		<a<!-- IF cans.COUNT != 0 --> href="{cans.U_BUY}"<!-- ENDIF -->><img title="{L_CAN_BUY}" <!-- IF cans.COUNT == 0 -->style="opacity: 0"<!-- ENDIF --> src="{IMG_CMS_ICON_DOLLAR}" /></a>
		<a href="{cans.U_EDIT}"><img title="{L_EDIT}" src="{IMG_CMS_ICON_EDIT}" /></a>
		<a href="{cans.U_DELETE}" onclick="return confirm('{L_CONFIRM}');"><img title="{L_DELETE}" src="{IMG_CMS_ICON_DELETE}" /></a>
		<a href="{cans.U_HISTORY}"><img title="{L_CAN_HISTORIC}" src="{IMG_CMS_ICON_REPORT}" /></a>
	</td>
</tr>
<!-- END cans -->
<tr>
	<th colspan="4">
		<form action="{U_ADD_ACTION}" method="POST">
			<button>{L_CAN_ADD}</button>
		</form>
	</th>
</tr>
</table>
<div class="gen">
	<input type="text" name="user_id_jqui" id="user_id_jqui" size="50" class="post ui-autocomplete-input" placeholder="{L_CAN_SEARCH_BANK}">
</div>

<!-- INCLUDE overall_footer.tpl -->