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
$route['default_controller'] = 'site';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

# Site
$route[''] = 'site/index';
$route['about'] = 'site/about';
$route['accounts/login'] = 'auth/index';

# Admin
$route['admin'] = 'auth/index';
$route['logout'] = 'auth/logout';

$route['admin/dashboard'] = 'admin/dashboard/index';

$route['admin/farmers'] = 'admin/dashboard/farmers';
$route['admin/farmers/(:num)'] = 'admin/dashboard/farmers/$1';

$route['admin/cattle'] = 'admin/dashboard/cattle';
$route['admin/cattle/(:num)'] = 'admin/dashboard/cattle/$1';

$route['admin/submissions'] = 'admin/dashboard/submissions';

$route['breeds/form'] = 'admin/breeds/form';
$route['breeds/form/(:num)'] = 'admin/breeds/form/$1';

$route['feeds/form'] = 'admin/feeds/form';
$route['feeds/form/(:num)'] = 'admin/feeds/form/$1';

$route['dosages/form'] = 'admin/dosages/dosageForm';
$route['dosages/form/(:num)'] = 'admin/dosages/dosageForm/$1';

$route['agents/form'] = 'admin/dosages/agentForm';
$route['agents/form/(:num)'] = 'admin/dosages/agentForm/$1';

$route['diseases/form'] = 'admin/dosages/diseaseForm';
$route['diseases/form/(:num)'] = 'admin/dosages/diseaseForm/$1';

/**
 * 
 * APIs
 * 
 */
$route['api/v1/bundle'] = 'api/cattle/getBundle';

# Auth
$route['api/v1/login'] = 'api/users/login';
$route['api/v1/register'] = 'api/users/register';
$route['api/v1/account/update'] = 'api/users/update';
$route['api/v1/account/verify'] = 'api/users/verify';

# LW
$route['api/v1/lw'] = 'api/lw/getLW';
$route['api/v1/lw/submissions'] = 'api/lw/getSubmissions';
$route['api/v1/cattle'] = 'api/cattle/getCattle';
$route['api/v1/cattle/register'] = 'api/cattle/registerCattle';
$route['api/v1/cattle/delete'] = 'api/cattle/deleteCattle';

# Feeds
$route['api/v1/feeds'] = 'api/cattle/getFeeds';
$route['api/v1/feeds/ration'] = 'api/cattle/calculateFeedRation';

# Dosages
$route['api/v1/dosages'] = 'api/cattle/getDosages';
$route['api/v1/dosage/calculate'] = 'api/cattle/calculateDosage';

# Reports
$route['api/v1/report/submissions'] = 'api/lw/getSubmissions';