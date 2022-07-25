<?php  
include_once('config.inc.php');
include_once('currency_display.php');
include_once('libraries/function_inc.php');
include_once('libraries/query.inc.php');
include_once('libraries/product.inc.php');
include_once('libraries/order.inc.php'); 
include_once('libraries/paging.inc.php');
include_once('libraries/cart.inc.php'); 

define('URL','https://localhost/project/shopurneeds');
define('ADMINURL','https://localhost/project/shopurneeds/admin-panel');
define('FSite', 'www.https://localhost/project/shopurneeds');
define('SSite', 'https://localhost/project/shopurneeds');
define('TSite', 'https://localhost/project/shopurneeds');
define('CompnaySite', 'https://localhost/project/shopurneeds');
define('CompanyEmail', 'info@shopurneeds.com');
define('AddressCity', 'Noida');
define('Country', 'India');
define('CompanyName', 'shopurneeds');
define('CompanyAddress', 'NA');
define('CompanyPhone1', '+91 0000000000');
define('CompanyFax', '+91 0000000000');
define('PostCode', '+91 0000000000');
define('Currency', 'JD ');
define('SiteTitle',   'shopurneeds');
define('_FooterTitle_',   'shopurneeds');
define('_SITE_NAME',    'https://localhost/project/shopurneeds');
/* Define Accounts Module Details */
define('_ControlPanelSiteTitle_',   'shopurneeds:Control Panel');
$homeurl = "<a class='aheadtag' href='https://localhost/project/shopurneeds/admin-panel/dashboard'>Home</a>";
define('_ControlPanelPageHeading_',  $homeurl);
/*Admin Section*/
define('_ADMIN_TITLE_',   'shopurneeds');
define('_PANEL_NAME',   'shopurneeds Control Panel');
define('_PANEL_FOOTER',   'Powered By : TPI');
define('_SITE_NAME',    'shopurneeds');
define('_SITE_ADDRESS', 'https://localhost/project/shopurneeds');
define('_ADMIN_EMAIL',  'info@shopurneeds.com');
define('_SUPPORT_EMAIL', 'Support <info@shopurneeds.com>');
$url="https://localhost/project/shopurneeds";
$admincurl="https://localhost/project/shopurneeds/admin-panel";
$sufix="shopurneeds_";
if($_SESSION['admin_language'] == '')
{
    $_SESSION['admin_language'] = 'EN';
}
?>