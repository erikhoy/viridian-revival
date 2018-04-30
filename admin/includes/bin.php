<?php

class Bin extends Db_object {
	protected static $db_table = "bins";
	protected static $db_table_fields = array('id', 'name');
	public $id;
	public $name;
}