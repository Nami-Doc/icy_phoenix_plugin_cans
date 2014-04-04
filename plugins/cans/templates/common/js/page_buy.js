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
		$.get('cans.php', {page: 'ajax',
			mode: 'money',
			username: val }, function (data)
		{
			vals[val] = data;
			$user_money.html(vals[_self.value] || '');
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
		$('<div><input type="checkbox" name="use_acc">Debiter sur ce compte (si non cocher, payer comptant)</div>')
	);

	var $input_number = $('[name=count]');
	var $total_price = $('<span>').html('Prix total : ' + can.price + ' &euro;').insertAfter($input_number);
});