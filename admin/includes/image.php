<?php

class Image extends Db_object {
	protected static $db_table = "images";
	protected static $db_table_fields = array('id', 'image_url', 'product_id');
	public $id;
	public $image_url;
	public $product_id;

	public static function find_image_by_product_id($product_id) {
		global $database;

		$sql = "SELECT * FROM " . self::$db_table;
		$sql .= " WHERE product_id = " . $product_id;

		return self::find_by_query($sql);
	}
}

