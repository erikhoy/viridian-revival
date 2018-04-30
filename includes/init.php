<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
//defined('SITE_ROOT') ? null : define('SITE_ROOT', DS . /*'Applications' . DS . 'XAMPP' . DS . 'xamppfiles' . DS . 'htdocs' . DS .*/ 'viridian_revival');
a1defined('SITE_ROOT') ? null : define('SITE_ROOT', DS . 'Applications' . DS . 'XAMPP' . DS . 'xamppfiles' . DS . 'htdocs' . DS . 'viridian_revival');
defined('IMAGES_PATH') ? null : define('IMAGES_PATH', DS . 'viridian_revival' . DS . 'admin' . DS . 'images');
defined('ROOT_PATH') ? null : define('ROOT_PATH', DS . 'viridian_revival');
defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', ROOT_PATH . DS . 'admin' . DS . 'includes');

require_once(INCLUDES_PATH.DS."database.php");
require_once(INCLUDES_PATH.DS."db_object.php");
require_once(INCLUDES_PATH.DS."functions.php");
require_once(INCLUDES_PATH.DS."new_config.php");
require_once(INCLUDES_PATH.DS."paginate.php");
require_once(INCLUDES_PATH.DS."product.php");
require_once(INCLUDES_PATH.DS."session.php");
require_once(INCLUDES_PATH.DS."user.php");
require_once(INCLUDES_PATH.DS."review.php");
require_once(INCLUDES_PATH.DS."description.php");
require_once(INCLUDES_PATH.DS."image.php");
require_once(INCLUDES_PATH.DS."status.php");
require_once(INCLUDES_PATH.DS."bin.php");
require_once(INCLUDES_PATH.DS."platform.php");
require_once(INCLUDES_PATH.DS."measurement.php");
?>