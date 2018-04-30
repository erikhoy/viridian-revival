<?php

class Platform extends Db_object {
	protected static $db_table = "platforms";
	protected static $db_table_fields = array('id', 'name');
	public $id;
	public $name;
}