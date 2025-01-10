<?php defined('COREPATH') or exit('No direct script access allowed'); ?>

WARNING - 2025-01-04 04:27:17 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-01-04 04:28:54 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-01-04 04:29:08 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-01-04 10:11:57 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-01-04 10:11:58 --> 23000 - SQLSTATE[23000]: Integrity constraint violation: 1048 Column 'email' cannot be null with query: "INSERT INTO `users` (`name`, `email`, `password`, `is_admin`, `created_at`, `updated_at`) VALUES ('John Doe', null, null, null, null, null)" in C:\xampp\htdocs\fuelphp\fuel\core\classes\database\pdo\connection.php on line 235
WARNING - 2025-01-04 10:20:37 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-01-04 10:22:33 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-01-04 10:22:46 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-01-04 10:46:51 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-01-04 10:47:12 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-01-04 10:47:13 --> Compile Error - Cannot declare class Model_Prefecture, because the name is already in use in C:\xampp\htdocs\fuelphp\fuel\app\classes\model\hotel.php on line 58
WARNING - 2025-01-04 10:48:06 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-01-04 10:49:26 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-01-04 11:03:16 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-01-04 11:09:42 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2025-01-04 11:13:23 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-01-04 11:13:23 --> 0 - Task "prefecture_seeder" does not exist. Did you mean "fromdb"? in C:\xampp\htdocs\fuelphp\fuel\packages\oil\classes\refine.php on line 77
WARNING - 2025-01-04 11:14:32 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-01-04 11:14:32 --> 0 - Task "seeder" does not exist. Did you mean "session"? in C:\xampp\htdocs\fuelphp\fuel\packages\oil\classes\refine.php on line 77
WARNING - 2025-01-04 11:19:15 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-01-04 11:19:15 --> 0 - Task "seeder" does not exist. Did you mean "session"? in C:\xampp\htdocs\fuelphp\fuel\packages\oil\classes\refine.php on line 77
WARNING - 2025-01-04 11:23:12 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-01-04 11:23:12 --> 0 - Task "prefecture" does not exist. Did you mean "migrate"? in C:\xampp\htdocs\fuelphp\fuel\packages\oil\classes\refine.php on line 77
WARNING - 2025-01-04 11:23:24 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-01-04 11:23:24 --> 0 - Task "seeders" does not exist. Did you mean "session"? in C:\xampp\htdocs\fuelphp\fuel\packages\oil\classes\refine.php on line 77
WARNING - 2025-01-04 11:29:54 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-01-04 11:29:54 --> Error - Class '\Fuel\Tasks\Prefecture' not found in C:\xampp\htdocs\fuelphp\fuel\packages\oil\classes\refine.php on line 91
WARNING - 2025-01-04 11:30:10 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-01-04 11:30:10 --> Error - Class 'Fuel\Tasks\DateTime' not found in C:\xampp\htdocs\fuelphp\fuel\app\tasks\prefecture.php on line 28
WARNING - 2025-01-04 11:30:53 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-01-04 11:30:53 --> Error - Class 'Fuel\Tasks\Model_Prefecture' not found in C:\xampp\htdocs\fuelphp\fuel\app\tasks\prefecture.php on line 356
WARNING - 2025-01-04 11:31:14 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-01-04 11:31:14 --> 4096 - Object of class DateTime could not be converted to string in C:\xampp\htdocs\fuelphp\fuel\core\classes\database\connection.php on line 656
WARNING - 2025-01-04 11:33:32 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2025-01-04 12:40:42 --> 22007 - SQLSTATE[22007]: Invalid datetime format: 1292 Incorrect datetime value: 'Sat Jan  4 12:40:42 2025' for column 'created_at' at row 1 with query: "INSERT INTO `prefectures` (`name_jp`, `name_en`, `file_path`, `created_at`, `updated_at`) VALUES ('北海道', 'hokkaido', 'prefecture/hokkaido.png', 'Sat Jan  4 12:40:42 2025', 'Sat Jan  4 12:40:42 2025')" in /Applications/MAMP/htdocs/fuelphp/fuel/core/classes/database/pdo/connection.php on line 235
ERROR - 2025-01-04 12:40:42 --> 22007 - SQLSTATE[22007]: Invalid datetime format: 1292 Incorrect datetime value: 'Sat Jan  4 12:40:42 2025' for column 'created_at' at row 1 in /Applications/MAMP/htdocs/fuelphp/fuel/core/classes/database/pdo/connection.php on line 206
ERROR - 2025-01-04 14:13:09 --> Compile Error - Cannot declare class Controller_Welcome, because the name is already in use in /Applications/MAMP/htdocs/fuelphp/fuel/app/classes/controller/client/home.php on line 12
ERROR - 2025-01-04 14:13:36 --> Error - The requested view could not be found: template.php in /Applications/MAMP/htdocs/fuelphp/fuel/core/classes/view.php on line 492
ERROR - 2025-01-04 14:38:14 --> Error - The requested view could not be found: client/hotel.php in /Applications/MAMP/htdocs/fuelphp/fuel/core/classes/view.php on line 492
ERROR - 2025-01-04 14:43:43 --> Notice - Undefined variable: hotels in /Applications/MAMP/htdocs/fuelphp/fuel/app/views/client/hotel/index.php on line 6
ERROR - 2025-01-04 14:48:20 --> Notice - Undefined variable: hotels in /Applications/MAMP/htdocs/fuelphp/fuel/app/views/client/hotel/index.php on line 6
ERROR - 2025-01-04 14:48:40 --> Notice - Undefined variable: hotels in /Applications/MAMP/htdocs/fuelphp/fuel/app/views/client/hotel/index.php on line 6
ERROR - 2025-01-04 14:48:41 --> Notice - Undefined variable: hotels in /Applications/MAMP/htdocs/fuelphp/fuel/app/views/client/hotel/index.php on line 6
ERROR - 2025-01-04 14:48:41 --> Notice - Undefined variable: hotels in /Applications/MAMP/htdocs/fuelphp/fuel/app/views/client/hotel/index.php on line 6
ERROR - 2025-01-04 14:48:42 --> Notice - Undefined variable: hotels in /Applications/MAMP/htdocs/fuelphp/fuel/app/views/client/hotel/index.php on line 6
ERROR - 2025-01-04 14:51:15 --> Notice - Undefined variable: hotels in /Applications/MAMP/htdocs/fuelphp/fuel/app/views/client/hotel/index.php on line 6
ERROR - 2025-01-04 15:27:02 --> Error - Property "name_js" not found for Model_Hotel. in /Applications/MAMP/htdocs/fuelphp/fuel/packages/orm/classes/model.php on line 1261
ERROR - 2025-01-04 15:27:23 --> Notice - Undefined variable: hotel in /Applications/MAMP/htdocs/fuelphp/fuel/app/views/client/hotel/index.php on line 9
ERROR - 2025-01-04 15:27:26 --> Error - Property "name_js" not found for Model_Prefecture. in /Applications/MAMP/htdocs/fuelphp/fuel/packages/orm/classes/model.php on line 1261
ERROR - 2025-01-04 15:27:27 --> Error - Property "name_js" not found for Model_Prefecture. in /Applications/MAMP/htdocs/fuelphp/fuel/packages/orm/classes/model.php on line 1261
ERROR - 2025-01-04 16:41:51 --> Error - Property "name" not found for Model_Prefecture. in /Applications/MAMP/htdocs/fuelphp/fuel/packages/orm/classes/model.php on line 1261
ERROR - 2025-01-04 16:47:00 --> Error - Property "name" not found for Model_Prefecture. in /Applications/MAMP/htdocs/fuelphp/fuel/packages/orm/classes/model.php on line 1261
ERROR - 2025-01-04 16:47:49 --> Error - Property "name" not found for Model_Prefecture. in /Applications/MAMP/htdocs/fuelphp/fuel/packages/orm/classes/model.php on line 1261
