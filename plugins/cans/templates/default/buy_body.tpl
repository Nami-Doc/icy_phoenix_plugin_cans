<!-- INCLUDE overall_header.tpl -->

{IMG_THL}{IMG_THC}<span class="forumlink">{L_PLUGIN_CANS}</span>{IMG_THR}
<!-- BEGIN cans -->
<form action="{U_CAN_BUY}" method="POST">
	<table class="forumlinenb" width="100%" cellspacing="0" cellpadding="0">
		<tr>
			<td class="row1" width="20%"><span class="gen"><b>{L_CAN_NAME}</b></span></td>
			<td class="row2" width="80%"><span class="gen">{cans.NAME}</td>
		</tr>
		<tr>
			<td class="row1" width="20%"><span class="gen"><b>{L_CAN_PRICE}</b></span></td>
			<td class="row2" width="80%"><span class="gen">{cans.PRICE}</td>
		</tr>
		<tr>
			<td class="row1" width="20%"><span class="gen"><b>{L_CAN_COUNT}</b></span></td>
			<td class="row2" width="80%"><span class="gen">{cans.COUNT}</td>
		</tr>
		<tr>
			<td class="row1" width="20%"><span class="gen"><b>{L_USERNAME}</b></span></td>
			<td class="row2" width="80%"><span class="gen"><input name="user" placeholder="login_l" /><br/>
										<i>({L_CAN_EMPTY_FOR_ANONYMOUS})</i></td>
		</tr>
		<tr>
			<td class="row1" width="20%"><span class="gen"><b>{L_NUMBER}</b></span></td>
			<td class="row2" width="80%"><span class="gen"><input name="number" value="1" /><br/></td>
		</tr>
		<tr>
			<td class="row1" colspan="2" style="float: center"><input type="submit" name="submit" value="{L_SUBMIT}" /></td>
		</tr>
	</table>
</form>
<!-- END cans -->

<!-- INCLUDE overall_footer.tpl -->