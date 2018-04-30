<?php
class Review extends Db_object {
	
	protected static $db_table = "testimonials";
	protected static $db_table_fields = array('id', 'author', 'body', 'product_id', 'stars');
	public $id;
	public $author;
	public $body;
	public $product_id;
	public $stars;

	public static function create_review($product_id, $author="John Doe", $review="") {
		if(!empty($product_id) && !empty($author) && !empty($review)) {
			$comment = new Comment();
			$comment->product_id 	= (int)$product_id;
			$comment->author 		= $author;
			$comment->review 		= $review;
			return $comment;
		} else {
			return false;
		}
	}

	public static function find_the_reviews($product_id=0) {
		global $database;

		$sql =  "SELECT * FROM " . self::$db_table;
	 	$sql .= " WHERE product_id=". $database->escape_string($product_id);
		$sql .= " ORDER BY product_id ASC";

		return self::find_by_query($sql);
	}

	public static function get_homepage_reviews() {
		global $database;

		$sql = "SELECT * FROM " . self::$db_table;
		$sql .= " LIMIT 5";

		return self::find_by_query($sql);
	}
}
?>