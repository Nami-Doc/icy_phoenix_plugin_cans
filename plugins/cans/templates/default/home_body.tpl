<!-- INCLUDE overall_header.tpl -->

{IMG_THL}{IMG_THC}<span class="forumlink">{L_PLUGIN_CANS}</span>{IMG_THR}<table class="forumlinenb" width="100%" cellspacing="0" cellpadding="0">
<tr>
	<th>{L_CAN_NAME}</th>
	<th>{L_CAN_PRICE}</th>
	<th>{L_CAN_COUNT}</th>
	<th>{L_ACTIONS}</th>
</tr>
<!-- BEGIN cans -->
<tr>
	<td>{cans.NAME}</td>
	<td>{cans.PRICE}€</td>
	<td>{cans.COUNT}</td>
	<td>
		<!-- IF cans.COUNT -->
		<form action="{U_CAN}">
			<input type="hidden" name="page" value="buy" />
			<input type="hidden" name="id" value="{cans.ID}" />
			<button>{L_CAN_BUY}</button>
		</form>
		<!-- ELSE -->
		<button disabled>{L_CAN_NO_STOCK}</button>
		<!-- ENDIF -->
		<a href="{cans.S_EDIT}"><img src="{IMG_CMS_ICON_EDIT}" /></a>
		<a href="{cans.S_DELETE}"><img src="{IMG_CMS_ICON_DELETE}" /></a>
	</td>
</tr>
<!-- END cans -->
<tr>
	<th colspan="4">
		<form action="{U_CAN_ADD}" method="POST">
			<button>{L_CAN_ADD}</button>
		</form>
	</th>
</tr>
</table>

<!-- INCLUDE overall_footer.tpl -->