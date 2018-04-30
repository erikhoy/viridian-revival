<?php

class Measurement extends Db_object {
	protected static $db_table = "measurements";
	protected static $db_table_fields = array('id', 'weight', 'length', 'width', 'height', 'product_id');
	public $id;
	public $weight;
	public $length;
	public $width;
	public $height;
	public $product_id;

	public static function get_measurements($id) {
		global $database;

		$sql = "SELECT * FROM measurements";
		$sql .= " WHERE product_id = " . $id;

		return self::find_by_query($sql);
	}
}