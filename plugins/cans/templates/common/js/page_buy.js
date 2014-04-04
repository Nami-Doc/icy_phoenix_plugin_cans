$(function () {
	var vals = {};

	function fetchMoney() {
		var _self = this,
			val = this.value;
		if (vals.hasOwnProperty(val))
		{
			$user_money.html(vals[val]);
			return;
		}
		if (!val)
			return;

		$user_money.html('...');
		$.get('cans.php', {page: 'ajax', mode: 'money', username: val }, function (data) {
			vals[val] = data;
			$user_money.html(vals[_self.value] || ''); // in case it changed
		});
	}

	var $user_id = $('#user_id_jqui')
		.keyup(fetchMoney)
		.on('autocompleteselect', function (event, ui) {
			event.target.value = ui.item.value;
			fetchMoney.call(event.target);
		});

	var $user_money = $('<span>')
		.insertAfter($user_id);
	$('<span>&euro;</span>').insertAfter($user_money)
	.after(
		$('<div><input type="checkbox" name="use_acc">Utiliser le compte</div>')
	);
});