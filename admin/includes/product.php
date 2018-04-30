<?php
class Product extends Db_object {
	protected static $db_table = "products";
	protected static $db_table_fields = array('id', 'name', 'purchase_date', 'purchase_price', 'platform_id', 'status_id', 'list_price', 'sold_price', 'shipping', 'actual_shipping', 'source', 'bin_id', 'sold_date', 'delivered_date');
	public $id;
	public $name;
	public $purchase_date;
	public $purchase_price;
	public $platform_id;
	public $status_id;
	public $list_price;
	public $sold_price;
	public $shipping;
	public $actual_shipping;
	public $source;
	public $bin_id;
	public $sold_date;
	public $delivered_date;
	public $upload_directory = "images";
	public $custom_errors = array();
	public $upload_errors = array(
		UPLOAD_ERR_OK			=> "There is no error",
		UPLOAD_ERR_INI_SIZE		=> "The uploaded file exceeds the upload_max_filesize...",
		UPLOAD_ERR_FORM_SIZE	=> "The uploaded file exceeds the MAX_FILE_SIZE...",
		UPLOAD_ERR_PARTIAL		=> "The uploaded file was only partially uploaded.",
		UPLOAD_ERR_NO_FILE		=> "No file was uploaded.",
		UPLOAD_ERR_NO_TMP_DIR	=> "Missing a temporary folder.",
		UPLOAD_ERR_CANT_WRITE	=> "Failed to write file to disk.",
		UPLOAD_ERR_EXTENSION	=> "A PHP extension stopped the file upload."
	);

	//This is passing $_FILES['uploaded_file'] as an argument
	public function set_file($file) {

		if(empty($file) || !$file || !is_array($file)) {
			$this->errors[] = "There was no file uploaded here";
			return false;
		} elseif ($file['error'] != 0) {
			$this->errors[] = $this->upload_errors_array[$file['error']];
			return false;
		} else {
			$this->filename = basename($file['name']);
			$this->tmp_path = $file['tmp_name'];
			$this->type 	= $file['type'];
			$this->size 	= $file['size'];
		}
	}

	public function picture_path() {
		return $this->upload_directory.DS.$this->filename;
	}

	public function save() {
		if($this->id) {
			$this->update();
		} else {
			if(!empty($this->errors)) {
				return false;
			}

			if(empty($this->filename) || empty($this->tmp_path)) {
				$this->errors[] = "The file was not available.";
				return false;
			}

			$target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->filename;

			if(file_exists($target_path)) {
				$this->errors[] = "The file {$this->filename} already exists";
				return false;
			}

			if(move_uploaded_file($this->tmp_path, $target_path)) {
				if($this->create()) {
					unset($this->tmp_path);
					return true;
				}
			} else {
				$this->errors[] = "The folder probably has insufficient permissions.";
				return false;
			}
		}
	}

	public function delete_photo() {
		if($this->delete()) {
			$target_path = SITE_ROOT . DS . 'admin' . DS . $this->picture_path();
			return unlink($target_path) ? true : false;
		} else {
			return false;
		}
	}

	public function reviews() {
		return Review::find_the_reviews($this->id);
	}

	public static function display_sidebar_data($id) {
		$product = Product::find_by_id($id);

		$output = "<a class='thumbnail' href='#'><img width='100' src='{$product->picture_path()}'></a>";
		$output .= "<p>{$photo->filename}</p>";
		$output .= "<p>{$photo->type}</p>";
		$output .= "<p>{$photo->size}</p>";

		echo $output;
	}

	public static function get_total_sales() {
		global $database;
		$sales = 0;

		$sql = "SELECT * FROM " . self::$db_table ;
		$sql .= " WHERE status_id >= 3";
		$sql .= " && status_id != 7";

		$products = self::find_by_query($sql);
		foreach($products as $product) {
			$sales += $product->sold_price;
		}
		return $sales;
	}

	public function get_sales_by_month_and_year($month_start, $month_finish, $year) {
		global $database;
		$sales = 0;

		$sql = "SELECT * FROM " . self::$db_table ;
		$sql .= " WHERE status_id >=3";
		if($month_finish == 13) {
			$next_year = $year+1;
			$sql .= " && sold_date >= '".$year."-".$month_start."-1'";
			$sql .= " && sold_date < '".$next_year."-1-1'";
		} else {
			$sql .= " && sold_date >= '".$year."-".$month_start."-1'";
			$sql .= " && sold_date < '".$year."-".$month_finish."-1'";
		}

		$products = self::find_by_query($sql);
		foreach($products as $product) {
			$sales += ($product->sold_price + $product->shipping);
		}
		return $sales;
	}

	public function get_expenses_by_month_and_year($month_start, $month_finish, $year) {
		global $database;
		$expenses = 0;

		$sql = "SELECT * FROM " . self::$db_table ;
		$sql .= " WHERE status_id >=3";
		if($month_finish == 13) {
			$next_year = $year+1;
			$sql .= " && purchase_date >= '".$year."-".$month_start."-1'";
			$sql .= " && purchase_date < '".$next_year."-1-1'";
		} else {
			$sql .= " && purchase_date >= '".$year."-".$month_start."-1'";
			$sql .= " && purchase_date < '".$year."-".$month_finish."-1'";
		}

		$products = self::find_by_query($sql);
		foreach($products as $product) {
			$transaction_fee = self::get_transaction_fee($product->platform_id);
			$listing_fee = self::get_listing_fees($product->platform_id);
			$expense = ($product->purchase_price + $product->actual_shipping + $listing_fee + $transaction_fee);
			$expenses += $expense;
		}
		return $expenses;
	}

	public function find_homepage_products() {
		global $database;

		$sql = "SELECT * FROM images";
		$sql .= " WHERE image_url != ''";
		$sql .= " ORDER BY RAND()";
		$sql .= " LIMIT 10";

		return self::find_by_query($sql);

	}

	public function find_products_by_status($status_id, $page, $items_per_page, $items_total_count) {
		global $database;

		$paginate = new Paginate($page, $items_per_page, $items_total_count);

		$sql = "SELECT * FROM " . self::$db_table;
		$sql .= " WHERE status_id = " . $status_id;
		$sql .= " ORDER BY name ASC";
		$sql .= " LIMIT {$items_per_page}";
	    $sql .= " OFFSET {$paginate->offset()}";
		
		return self::find_by_query($sql);
	}

	public function get_transaction_fee($platform_id) {
		//Etsy
		if($platform_id == 1) {
			return .035;
		//Poshmark
		} elseif($platform_id == 2) {
			return .1;
		//Ebay
		} elseif($platform_id == 3) {
			return .1;
		//Nextdoor
		} elseif($platform_id == 4) {
			return 0;
		}
	}

	public function get_listing_fees($platform_id) {
		//Etsy
		if($platform_id == 1) {
			return .2;
		//Poshmark
		} elseif($platform_id == 2) {
			return 0;
		//Ebay
		} elseif($platform_id == 3) {
			return 0;
		//Nextdoor
		} elseif($platform_id == 4) {
			return 0;
		}
	}

	public function get_profit_margin($id) {
		$product = Product::find_by_id($id);
		$total_cost = $product->purchase_price + self::get_listing_fees($product->platform_id) + self::get_transaction_fee($product->platform_id) + $product->actual_shipping;
		$total_revenue = $product->sold_price + $product->shipping;
        $profit = $total_revenue - $total_cost;
        return ($profit / $total_cost) * 100;
	}

	public static function search_products($name) {
		global $database;

		$sql = "SELECT * FROM products";
		$sql .= " WHERE name LIKE '%{$name}%'";

		return self::find_by_query($sql);
	}
}

?>