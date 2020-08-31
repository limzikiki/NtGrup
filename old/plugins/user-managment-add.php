<?php
/*
Plugin Name: Multi User (Add User)
Description: Adds To Multi-User Management Section, giving the Add User function
Version: 1.3
Author: Mike Henken
*/

# get correct id for plugin
$thisfile=basename(__FILE__, ".php");

# register plugin
register_plugin(
	$thisfile, # ID of plugin, should be filename minus php
	'Multi User Add',
	'1.3', # Version of plugin
	'Mike Henken',	# Author of plugin
    'http://www.profileyourcity.com/',   # Author URL
	'Adds To Multi-User Management Section, giving the Add User function', 	# Plugin Description
	'settings',  # Page type of plugin
	'add_user'  # Function that displays content
);

# activate hooks
//add_action('settings-sidebar','createSideMenu',array($thisfile,'User Management'));

function add_user() {
 /**
 * Add New Users Script
 * Form For this script is found in user-management.
 * Author: Mike Henken (XML Code at the bottom mostly grabbed from settings.php)
 */
      if (isset($_POST['usereditor'])) {
          $NHTMLEDITOR = $_POST['usereditor'];
      }

      if (isset($_POST['ntimezone'])) {
          $NTIMEZONE = $_POST['ntimezone'];
      }

      if (isset($_POST['userlng'])) {
          $NLANG = $_POST['userlng'];
      }


      //User Admin Setting (Sets The User As An Admin And Enables All Permissions & The Ability To Manage Users)
      if (isset($_POST['Admin']) && $_POST['Admin'] == 'no') {
       $NADMIN = "no";
      }
      else {
       $NADMIN ="";
      }

      //Landing Page
       if (isset($_POST['Landing'])) {
       $NLANDING = $_POST['Landing'];
      }
        else {
       $NLANDING ="";
      }

      if ($NLANDING == "pages.php") {
        $NLANDING == "";
      }


      if (isset($_POST['Pages']) && $_POST['Pages'] == 'no') {
       $NPAGES = "no";
      }
      else {
       $NPAGES ="";
      }

      if (isset($_POST['Files']) && $_POST['Files'] == 'no') {
       $NFILES = "no";
      }
      else {
       $NFILES ="";
      }

      if (isset($_POST['Theme']) && $_POST['Theme'] == 'no') {
       $NTHEME = "no";
      }
       else {
       $NTHEME ="";
      }

      if (isset($_POST['Plugins']) && $_POST['Plugins'] == 'no') {
          $NPLUGINS = "no";
      }
       else {
       $NPLUGINS ="";
      }

      if (isset($_POST['Backups']) && $_POST['Backups'] == 'no') {
       $NBACKUPS = "no";
      }
       else {
       $NBACKUPS ="";
      }

      if (isset($_POST['Settings']) && $_POST['Settings'] == 'no') {
       $NSETTINGS = "no";
      }
        else {
       $NSETTINGS ="";
      }

      if (isset($_POST['Support']) && $_POST['Support'] == 'no') {
       $NSUPPORT = "no";
      }
        else {
       $NSUPPORT ="";
      }

      if (isset($_POST['Edit']) && $_POST['Edit'] == 'no') {
       $NEDIT = "no";
      }
        else {
       $NEDIT ="";
      }

      if (isset($_POST['usereditor']) && $_POST['usereditor'] == '1') {
       $NHTMLEDITOR = "1";
      }
        else {
       $NHTMLEDITOR ="";
      }
$usrfile = strtolower($_POST['usernamec']);
$usrfile	= $usrfile . '.xml';
$NUSR = strtolower($_POST['usernamec']);
$NUSR = $NUSR;
$NEMAIL 		= $_POST['useremail'];
$pwd1       = $_POST['userpassword'];
$NPASSWD = passhash($pwd1);
$NTIMEZONE = $_POST['ntimezone'];
$NLANG = $_POST['userlng'];

// create user xml file - This coding was mostly taken from the 'settings.php' page..
	createBak($usrfile, GSUSERSPATH, GSBACKUSERSPATH);
	if (file_exists(GSUSERSPATH . _id($NUSR).'.xml.reset')) { unlink(GSUSERSPATH . _id($NUSR).'.xml.reset'); }
	$xml = new SimpleXMLElement('<item></item>');
	$xml->addChild('USR', $NUSR);
	$xml->addChild('PWD', $NPASSWD);
	$xml->addChild('EMAIL', $NEMAIL );
    $xml->addChild('HTMLEDITOR', $NHTMLEDITOR);
    $xml->addChild('TIMEZONE', $NTIMEZONE);
    $xml->addChild('LANG', $NLANG);
    $perm = $xml->addChild('PERMISSIONS');
    $perm->addChild('PAGES', $NPAGES);
    $perm->addChild('FILES', $NFILES);
    $perm->addChild('THEME', $NTHEME);
    $perm->addChild('PLUGINS', $NPLUGINS);
    $perm->addChild('BACKUPS', $NBACKUPS);
    $perm->addChild('SETTINGS', $NSETTINGS);
    $perm->addChild('SUPPORT', $NSUPPORT);
    $perm->addChild('EDIT', $NEDIT);
    $perm->addChild('LANDING', $NLANDING);
    $perm->addChild('ADMIN', $NADMIN);
	if (! XMLsave($xml, GSUSERSPATH . $usrfile) ) {
		$error = i18n_r('CHMOD_ERROR');
	}
			// Redirect after script is completed... I will make the script submit via ajax later
				else {
print "<meta http-equiv=\"refresh\" content=\"0;url=load.php?id=user-managment\">";
}
}
?>