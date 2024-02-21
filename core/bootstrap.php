<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'app/Controllers/PostController.php';
require_once 'db/DBPDO.php';
require_once 'db/DbFactory.php';
require_once 'app/Models/Post.php';
require_once 'app/Models/Comment.php';
require_once 'helpers/functions.php';
require_once 'config/app.config.php';
require_once 'core/Router.php';