<?php

class Description extends Db_object {
	protected static $db_table = "descriptions";
	protected static $db_table_fields = array('id', 'body', 'product_id');
	public $id;
	public $body;
	public $product_id;

	public static function find_description_by_product_id($product_id) {
		global $database;

		$sql = "SELECT * FROM " . self::$db_table;
		$sql .= " WHERE product_id = " . $product_id;

		return self::find_by_query($sql);
	}
}