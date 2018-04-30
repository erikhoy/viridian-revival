<?php

class Status extends Db_object {
	protected static $db_table = "statuses";
	protected static $db_table_fields = array('id', 'name');
	public $id;
	public $name;
}