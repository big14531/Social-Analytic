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
$route['default_controller'] = 'home_ctrl/socialDeck';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;






////////////////////////////////////////
//         Setting Global Zone        //
////////////////////////////////////////

/*---------- edit page  ----------*/
$route['facebook/editFacebookListUser']     = 'Facebook_ctrl/pagelist';
$route['facebook/editPageList/save']        = 'Facebook_ctrl/addPagelist';
$route['facebook/ajaxGetPageCategory']      = 'Facebook_ctrl/ajaxGetPageCategory';
$route['facebook/editPageList/edit']        = 'Facebook_ctrl/editPagelist';
$route['facebook/editPageList/addCategory'] = 'Facebook_ctrl/addCategory';
$route['facebook/editPageList/toggle/(:num)/(:num)'] = 'Facebook_ctrl/toggleIsActivePage/$1/$2';






// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //







////////////////////////////////////////
//              Process Zone             //
////////////////////////////////////////

/*---------- get new post link ----------*/
$route['sweepFacebookPost/(:num)/(:num)'] = 'data_ctrl/sweepFacebookPost/$1/$2';

/*---------- update post link ----------*/
$route['updateFacebookPost/(:num)'] = 'data_ctrl/updateFacebookPost/$1';

/*---------- update page link ----------*/
$route['updateTrackingPage'] = 'data_ctrl/updateTrackingPage';

/*---------- update all interval , temp ----------*/
$route['processAnalyticPost'] = 'data_ctrl/processAnalyticPost';
$route['updateInsight'] = 'data_ctrl/updateInsight';
$route['updateBatchFacebookPost']  = 'data_ctrl/updateBatchFacebookPost';
$route['newSweepFacebookPost']  = 'data_ctrl/newSweepFacebookPost';
$route['crontab-data-crawler'] = 'data_ctrl/contabDataCrawler';

/*---------- processKeyword ----------*/
$route['processKeyword'] = 'data_ctrl/processKeyword';

////////////////////////////////////////
//              View Zone             //
////////////////////////////////////////

$route['login'] = 'validation_ctrl/index';
$route['logout'] = 'validation_ctrl/logout';

/*---------- allfeed ----------*/
$route['allFeed'] = 'home_ctrl/allFeed';
$route['ajaxGetNewPostListbyPageID'] = 'home_ctrl/ajaxGetNewPostListbyPageID';
$route['ajaxGetNewPostListbyCat'] = 'home_ctrl/ajaxGetNewPostListbyCat';
$route['ajaxGetNewHighlightbyPageID'] = 'home_ctrl/ajaxGetNewHighlightbyPageID';

/*---------- trends ----------*/
$route['trends'] = 'home_ctrl/trends';
$route['ajaxGetTrendsData'] = 'home_ctrl/ajaxGetTrendsData';


/*---------- socialdesk ----------*/
$route['socialDeck'] = 'home_ctrl/socialDeck';
$route['ajaxFirstTimePost'] = 'home_ctrl/ajaxFirstTimePost';
$route['ajaxUpdatePost'] = 'home_ctrl/ajaxUpdatePost';
$route['ajaxEditPageCard'] = 'home_ctrl/ajaxEditPageCard';
$route['ajaxGetNewPost'] = 'home_ctrl/ajaxGetNewPost';
$route['ajaxGetHighlightPost'] = 'home_ctrl/ajaxGetHighlightPost';


/*---------- analyticList ----------*/
$route['analyticList'] = 'home_ctrl/analyticList';
$route['ajaxAnalyticList'] = 'home_ctrl/ajaxAnalyticList';

/*---------- dashboard ----------*/
$route['dashboard'] = 'home_ctrl/dashboard';
$route['ajaxDashboard'] = 'home_ctrl/ajaxDashboard';
$route['ajaxDashboardRankPost'] = 'home_ctrl/ajaxDashboardRankPost';
/*---------- utility ajax ----------*/
$route['ajaxGetActivePage'] = 'home_ctrl/ajaxGetActivePage';

/*---------- owner dashboard ----------*/
$route['ownerDashboard'] = 'home_ctrl/ownerDashboard';
$route['ajaxOwnerDashboard'] = 'home_ctrl/ajaxOwnerDashboard';
$route['sessionDashboard/(:any)'] = 'home_ctrl/sessionDashboard/$1';
$route['ajaxSessionDashboard'] = 'home_ctrl/ajaxSessionDashboard';
/*---------- analytic ----------*/
$route['postAnalytic/(:num)/(:num)/(:any)'] = 'home_ctrl/postAnalytic/$1/$2/$3';
$route['ajaxAnalyticPost'] = 'home_ctrl/ajaxAnalyticPost';

/*---------- ranks post ----------*/
$route['rankPosts'] = 'home_ctrl/rankPosts';
$route['ajaxRankPost'] = 'home_ctrl/ajaxRankPost';

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
$route['ajaxGrowthPage'] = 'home_ctrl/ajaxGrowthPage';

/*---------- edit page  ----------*/
$route['ajaxGetPageCategory'] = 'home_ctrl/ajaxGetPageCategory';
$route['editPageList'] = 'home_ctrl/pagelist';
$route['editPageList/save'] = 'home_ctrl/addPagelist';
$route['editPageList/edit'] = 'home_ctrl/editPagelist';
$route['editPageList/addCategory'] = 'home_ctrl/addCategory';
$route['editPageList/toggle/(:num)/(:num)'] = 'home_ctrl/toggleIsActivePage/$1/$2';

/*---------- deleted post page  ----------*/
$route['postManageList'] = 'home_ctrl/postManageList';
$route['ajaxManageList'] = 'home_ctrl/ajaxManageList';
$route['ajaxSetActivePost'] = 'home_ctrl/ajaxSetActivePost';

/*---------- summary post page  ----------*/
$route['summaryTable'] = 'home_ctrl/summaryTable';
$route['ajaxSummaryPost'] = 'home_ctrl/ajaxSummaryPost';


////////////////////////////////////////
//              Admin Zone            //
////////////////////////////////////////

$route['userPage'] = 'home_ctrl/userPage';
$route['initialize'] = 'home_ctrl/initialize';
$route['createUser'] = 'home_ctrl/createUser';
$route['editUser'] = 'home_ctrl/editUser';
$route['changePassword'] = 'home_ctrl/changePassword';
$route['editActiveUser/(:num)/(:num)'] = 'home_ctrl/toggleIsActiveUser/$1/$2';