<?php
namespace local_lonet;

defined('MOODLE_INTERNAL') || die();

class wallet {
	public static function get_balance($userid) {
		global $DB;
		$transaction = $DB->get_record_sql('
			SELECT wt.balance
			FROM {lonet_order_transaction} wt
			WHERE wt.userid = ' . $userid . '
			ORDER BY wt.createdat DESC
			LIMIT 1
		');
		return number_format(($transaction ? $transaction->balance : 0), 2);
	}
}
