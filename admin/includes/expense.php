<?php

class Expense extends Db_object {
	protected static $db_table = "expenses";
	protected static $db_table_fields = array('id', 'cost', 'date', 'description', 'payee');
	public $id;
	public $cost;
	public $date;
	public $description;
	public $payee;
}