<!-- INCLUDE overall_header.tpl -->

<form action="{U_FORM_ACTION}" method="post" name="add_new_report">
{IMG_THL}{IMG_THC}<span class="forumlink">{L_PLUGIN_CANS}</span>{IMG_THR}<table class="forumlinenb" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="row1" width="20%"><span class="gen"><b>{L_CAN_NAME}</b></span></td>
		<td class="row2" width="80%"><span class="gen"><input type="text" name="name" value="{CAN_NAME}"></td>
	</tr>
	<tr>
		<td class="row1" width="20%"><span class="gen"><b>{L_CAN_PRICE}</b></span></td>
		<td class="row2" width="80%"><span class="gen"><input type="text" name="price" value="{CAN_PRICE}"></td>
	</tr>
	<tr>
		<td class="row1" width="20%"><span class="gen"><b>{L_CAN_COUNT}</b></span></td>
		<td class="row2" width="80%"><span class="gen"><input type="text" name="count" value="{CAN_COUNT}"></td>
	</tr>
	<tr>
		<td class="row1" colspan="2" style="float: center"><input type="submit" name="submit" value="{L_SUBMIT}" /></td>
	</tr>
	{S_HIDDEN_FIELDS}
</table>
</form>


<!-- INCLUDE overall_footer.tpl -->