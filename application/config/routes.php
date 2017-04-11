<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home_ctrl/dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

////////////////////////////////////////
//              View Zone             //
////////////////////////////////////////

/*---------- get new post link ----------*/
$route['sweepFacebookPost/(:num)/(:num)'] = 'data_ctrl/sweepFacebookPost/$1/$2';

/*---------- update post link ----------*/
$route['updateFacebookPost/(:num)'] = 'data_ctrl/updateFacebookPost/$1';

/*---------- update page link ----------*/
$route['updateTrackingPage'] = 'data_ctrl/updateTrackingPage';

/*---------- update all interval , temp ----------*/
$route['update'] = 'data_ctrl/tempUpdateAll';
$route['crontab-data-crawler'] = 'data_ctrl/contabDataCrawler';

////////////////////////////////////////
//              View Zone             //
////////////////////////////////////////

$route['login'] = 'validation_ctrl/index';
$route['logout'] = 'validation_ctrl/logout';
/*---------- dashboard ----------*/
$route['dashboard'] = 'home_ctrl/dashboard';

/*---------- dashboard ----------*/
$route['postAnalytic/(:num)/(:num)'] = 'home_ctrl/postAnalytic/$1/$2';
$route['ajaxAnalyticPost'] = 'home_ctrl/ajaxAnalyticPost';
/*---------- post graph  ----------*/
$route['postGraph'] = 'home_ctrl/postGraph';

/*---------- post table  ----------*/
$route['postList'] = 'home_ctrl/postList';
$route['ajaxPostList'] = 'home_ctrl/ajaxPostList';

/*---------- page table  ----------*/
$route['showPageTable'] = 'home_ctrl/showPageTable';
$route['ajaxPageTable'] = 'home_ctrl/ajaxPageTable';

/*---------- growth table  ----------*/
$route['growthPage'] = 'home_ctrl/growthPage';
$route['getGrowthPage'] = 'home_ctrl/getGrowthPage';

/*---------- edit page  ----------*/
$route['editPageList'] = 'home_ctrl/pagelist';
$route['editPageList/save'] = 'home_ctrl/addPagelist';
$route['editPageList/edit'] = 'home_ctrl/editPagelist';
$route['editPageList/toggle/(:num)/(:num)'] = 'home_ctrl/toggleIsActivePage/$1/$2';


////////////////////////////////////////
//              Admin Zone            //
////////////////////////////////////////

$route['userPage'] = 'home_ctrl/userPage';
$route['initialize'] = 'home_ctrl/initialize';
$route['createUser'] = 'home_ctrl/createUser';
$route['editUser'] = 'home_ctrl/editUser';
$route['changePassword'] = 'home_ctrl/changePassword';
$route['editActiveUser/(:num)/(:num)'] = 'home_ctrl/toggleIsActiveUser/$1/$2';