<!-- INCLUDE overall_header.tpl -->

{IMG_THL}{IMG_THC}<span class="forumlink"><a href="{U_CAN}">{L_PLUGIN_CANS}</a></span>{IMG_THR}
<!-- BEGIN cans -->
<h2>{cans.NAME}</h2>
<table class="forumlinenb" width="100%" cellspacing="0" cellpadding="0">
<tr>
	<th>{L_USERNAME}</th>
	<th>{L_CAN_COUNT}</th>
	<th>{L_DATE}</th>
</tr>
<!-- BEGIN history -->
<tr>
	<td>
		<!-- IF cans.history.U_USER != '' -->
		{cans.history.U_USER}
		<!-- ELSE -->
		{L_ANONYMOUS}
		<!-- ENDIF -->
	</td>
	<td>{cans.history.COUNT}</td>
	<td>{cans.history.DATE}</td>
</tr>
<!-- END history -->
</table>
<!-- END cans -->

<div id="history_chart"></div>
<script>
$(function () {
$('#history_chart').highcharts({
	title: {
		text: '{L_PLUGIN_CANS}',
		x: -20
	},
	xAxis: {
		allowDecimals: false,
		type: 'datetime'
	},
	yAxis: {
		title: {
			text: 'Sells'
		}
	},
	series: {SERIES}

});
});
</script>

<!-- INCLUDE overall_footer.tpl -->