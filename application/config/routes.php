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

$route['facebook'] = 'home_ctrl/socialDeck';




////////////////////////////////////////
//         Setting Global Zone        //
////////////////////////////////////////

/*---------- login page  ----------*/
$route['login'] = 'validation_ctrl/index';
$route['logout'] = 'validation_ctrl/logout';

/*---------- Chat url  ----------*/
$route['ajaxSendChat'] = 'Global_ctrl/ajaxSendChat';
$route['ajaxGetChat'] = 'Global_ctrl/ajaxGetChat';

/*---------- edit page  ----------*/
$route['facebook/editFacebookListUser']     = 'Facebook_ctrl/pagelist';
$route['facebook/editPageList/save']        = 'Facebook_ctrl/addPagelist';
$route['facebook/ajaxGetPageCategory']      = 'Facebook_ctrl/ajaxGetPageCategory';
$route['facebook/editPageList/edit']        = 'Facebook_ctrl/editPagelist';
$route['facebook/editPageList/addCategory'] = 'Facebook_ctrl/addCategory';
$route['facebook/editPageList/toggle/(:num)/(:num)'] = 'Facebook_ctrl/toggleIsActivePage/$1/$2';

/*---------- post table  ----------*/
$route['facebook/postList'] = 'Facebook_ctrl/postList';
$route['facebook/ajaxPostList'] = 'Facebook_ctrl/ajaxPostList';

/*---------- utility ajax ----------*/
$route['facebook/ajaxGetActivePage'] = 'Facebook_ctrl/ajaxGetActivePage';

/*---------- analytic ----------*/
$route['facebook/postAnalytic/(:num)/(:num)/(:any)'] = 'home_ctrl/postAnalytic/$1/$2/$3';
$route['facebook/ajaxAnalyticPost'] = 'home_ctrl/ajaxAnalyticPost';




/*---------- allfeed ----------*/
$route['facebook/allFeed'] = 'home_ctrl/allFeed';
$route['facebook/ajaxGetNewPostListbyPageID'] = 'home_ctrl/ajaxGetNewPostListbyPageID';
$route['facebook/ajaxGetNewPostListbyCat'] = 'home_ctrl/ajaxGetNewPostListbyCat';
$route['facebook/ajaxGetNewHighlightbyPageID'] = 'home_ctrl/ajaxGetNewHighlightbyPageID';

/*---------- trends ----------*/
$route['facebook/trends'] = 'home_ctrl/trends';
$route['facebook/ajaxGetTrendsData'] = 'home_ctrl/ajaxGetTrendsData';


/*---------- socialdesk ----------*/
$route['facebook/socialDeck'] = 'home_ctrl/socialDeck';
$route['facebook/ajaxFirstTimePost'] = 'home_ctrl/ajaxFirstTimePost';
$route['facebook/ajaxUpdatePost'] = 'home_ctrl/ajaxUpdatePost';
$route['facebook/ajaxEditPageCard'] = 'home_ctrl/ajaxEditPageCard';
$route['facebook/ajaxGetNewPost'] = 'home_ctrl/ajaxGetNewPost';
$route['facebook/ajaxGetHighlightPost'] = 'home_ctrl/ajaxGetHighlightPost';


/*---------- analyticList ----------*/
$route['facebook/analyticList'] = 'home_ctrl/analyticList';
$route['facebook/ajaxAnalyticList'] = 'home_ctrl/ajaxAnalyticList';

/*---------- dashboard ----------*/
$route['facebook/dashboard'] = 'home_ctrl/dashboard';
$route['facebook/ajaxDashboard'] = 'home_ctrl/ajaxDashboard';
$route['facebook/ajaxDashboardRankPost'] = 'home_ctrl/ajaxDashboardRankPost';

/*---------- owner dashboard ----------*/
$route['facebook/ownerDashboard'] = 'home_ctrl/ownerDashboard';
$route['facebook/ajaxOwnerDashboard'] = 'home_ctrl/ajaxOwnerDashboard';
$route['facebook/sessionDashboard/(:any)'] = 'home_ctrl/sessionDashboard/$1';
$route['facebook/ajaxSessionDashboard'] = 'home_ctrl/ajaxSessionDashboard';


/*---------- ranks post ----------*/
$route['facebook/rankPosts'] = 'home_ctrl/rankPosts';
$route['facebook/ajaxRankPost'] = 'home_ctrl/ajaxRankPost';

/*---------- post graph  ----------*/
$route['facebook/postGraph'] = 'home_ctrl/postGraph';

/*---------- page table  ----------*/
$route['facebook/showPageTable'] = 'home_ctrl/showPageTable';
$route['facebook/ajaxPageTable'] = 'home_ctrl/ajaxPageTable';

/*---------- growth table  ----------*/
$route['facebook/growthPage'] = 'home_ctrl/growthPage';
$route['facebook/ajaxGrowthPage'] = 'home_ctrl/ajaxGrowthPage';



/*---------- summary post page  ----------*/
$route['facebook/summaryTable'] = 'home_ctrl/summaryTable';
$route['facebook/ajaxSummaryPost'] = 'home_ctrl/ajaxSummaryPost';

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
//              Admin Zone            //
////////////////////////////////////////

/*---------- edit page  ----------*/
$route['editPageList'] = 'home_ctrl/pagelist';
$route['editPageList/save'] = 'home_ctrl/addPagelist';
$route['editPageList/edit'] = 'home_ctrl/editPagelist';
$route['editPageList/addCategory'] = 'home_ctrl/addCategory';
$route['editPageList/toggle/(:num)/(:num)'] = 'home_ctrl/toggleIsActivePage/$1/$2';

/*---------- deleted post page  ----------*/
$route['postManageList'] = 'home_ctrl/postManageList';
$route['ajaxManageList'] = 'home_ctrl/ajaxManageList';
$route['ajaxSetActivePost'] = 'home_ctrl/ajaxSetActivePost';

/*---------- Manage USER  ----------*/
$route['userPage'] = 'home_ctrl/userPage';
$route['initialize'] = 'home_ctrl/initialize';
$route['createUser'] = 'home_ctrl/createUser';
$route['editUser'] = 'home_ctrl/editUser';
$route['changePassword'] = 'home_ctrl/changePassword';
$route['editActiveUser/(:num)/(:num)'] = 'home_ctrl/toggleIsActiveUser/$1/$2';