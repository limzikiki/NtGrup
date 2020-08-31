<?php
  /*
   Plugin Name: Multi User
   Description: Adds Multi-User Management Section'
   Version: 1.3
   Author: Mike Henken
   Author URI: http://profileyourcity.com/
   */

  // get correct id for plugin
  $thisfile = basename(__FILE__, ".php");

  // register plugin
  register_plugin($thisfile, // ID of plugin, should be filename minus php
  'Multi User',
  '1.3',
  'Mike Henken', // Author of plugin
  'http://www.profileyourcity.com/', // Author URL
  'Adds Multi-User Management - Edit all options for current users and manage permissions.', // Plugin Description
  'settings', // Page type of plugin
  'multiuser_show' // Function that displays content
  );

  // activate hooks //
  //Add Sidebar Item In Settings Page
  add_action('settings-sidebar', 'createSideMenu', array($thisfile, 'User Management'));
  //Make the multiuser_perm() function run before each admin page loads
  add_action('header', 'multiuser_perm');

  function multiuser_show()
  {
      if (isset($_GET['deletefile'])) {
          $deletename = $_GET['deletefile'];
          $thedelete = GSUSERSPATH . $deletename . '.xml';
          $success = unlink($thedelete);
          if ($success){
             print "<div class=\"updated\" style=\"display: block;\">$deletename Has Been Successfully Deleted</div>";
            }
                else{
                    print "<div class=\"updated\" style=\"display: block;\"><span style=\"color:red;font-weight:bold;\">ERROR!!</span> - Unable To Delete File, Please Check Error Log Or Turn On Debug</div>";
                }
      }

      else {

      // check if new password was provided
      if (isset($_POST['userpassword'])) {
          $pwd1 = $_POST['userpassword'];
          if ($pwd1 != '') {
              $NPASSWD = passhash($pwd1);
          }
          else {$NPASSWD = $_POST['nano']; }
      }

      // GRAB DATA FROM FORM //

      //Get Filename For Edited User
      if (isset($_POST['usernamec'])) {
          $usrfile = $_POST['usernamec'] . '.xml';
      }

      //Username
      if (isset($_POST['usernamec'])) {
          $NUSR = $_POST['usernamec'];
      }

      //Email
      if (isset($_POST['useremail'])) {
          $NEMAIL = $_POST['useremail'];
      }

      //User Editor
      if (isset($_POST['usereditor'])) {
          $NHTMLEDITOR = $_POST['usereditor'];
      }

      //Timezone
      if (isset($_POST['ntimezone'])) {
          $NTIMEZONE = $_POST['ntimezone'];
      }

      //User Language
      if (isset($_POST['userlng'])) {
          $NLANG = $_POST['userlng'];
      }

      // PERMISSIONS CHECKBOXES BELOW //

      //Pages
      if (isset($_POST['Pages']) && $_POST['Pages'] == 'no') {
       $NPAGES = "no";
      }
      else {
       $NPAGES ="";
      }

      //Admin
      if (isset($_POST['Admin']) && $_POST['Admin'] == 'no') {
       $NADMIN = "no";
      }
      else {
       $NADMIN ="";
      }

      //Files - Uploads.php
      if (isset($_POST['Files']) && $_POST['Files'] == 'no') {
       $NFILES = "no";
      }
      else {
       $NFILES ="";
      }

      //Theme
      if (isset($_POST['Theme']) && $_POST['Theme'] == 'no') {
       $NTHEME = "no";
      }
       else {
       $NTHEME ="";
      }

      //Plugins
      if (isset($_POST['Plugins']) && $_POST['Plugins'] == 'no') {
          $NPLUGINS = "no";
      }
       else {
       $NPLUGINS ="";
      }

      //Backups
      if (isset($_POST['Backups'])) {
       $NBACKUPS = "no";
      }
       else {
       $NBACKUPS ="";
      }

      //Settings
      if (isset($_POST['Settings']) && $_POST['Settings'] == 'no') {
       $NSETTINGS = "no";
      }
        else {
       $NSETTINGS ="";
      }

      //Support
      if (isset($_POST['Support']) && $_POST['Support'] == 'no') {
       $NSUPPORT = "no";
      }
        else {
       $NSUPPORT ="";
      }

      //Edit
      if (isset($_POST['Edit']) && $_POST['Edit'] == 'no') {
       $NEDIT = "no";
      }
        else {
       $NEDIT ="";
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


      if (isset($_POST['usernamec'])) {

          // Edit user xml file - This coding was mostly taken from the 'settings.php' page..
          $xml = new SimpleXMLElement('<item></item>');
          $xml->addChild('USR', $NUSR);
          $xml->addChild('PWD', $NPASSWD);
          $xml->addChild('EMAIL', $NEMAIL);
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
          if (!XMLsave($xml, GSUSERSPATH . $usrfile)) {
              $error = "Did Not Save File - ERROR!";
			  echo $error;
          }
          // Redirect after script is completed... I will make the script submit via ajax later
          else {
              print '<div class="updated" style="display: block;">Your changes have been saved.</div>';
          }
      }
      }
      multiuser_form();
  }
   //Form And Coding For User Management Page
  function multiuser_form()
  {

     # get all available language files
      $lang_handle = opendir(GSLANGPATH) or die("Unable to open ". GSLANGPATH);
      while ($lfile = readdir($lang_handle)) {
      	if( is_file(GSLANGPATH . $lfile) && $lfile != "." && $lfile != ".." )	{
      		$lang_array[] = basename($lfile, ".php");
      	}
      }
      if (count($lang_array) != 0) {
      	sort($lang_array);
      	$count = '0'; $sel = ''; $langs = '';
      	foreach ($lang_array as $larray){
      		$langs .= '<option value="'.$larray.'" >'.$larray.'</option>';
      		$count++;
      	}
      }

     //Get Available Timezones
      ob_start(); include ("../admin/inc/timezone_options.txt");$Timezone_Include = ob_get_contents();ob_end_clean();

  //Styles For Form
    echo "<style>
    .text {
                      width:160px !important;
                     }
                     .user_tr_header {
                       border:0px;border-bottom:0px;border-bottom-width:0px;
                     }
                     .user_tr {
                       border:0px;border-bottom:0px;border-bottom-width:0px;background:#F7F7F7;
                     }
                     .user_tr td{
                       border:0px;border-bottom:0px;border-bottom-width:0px;background:#F7F7F7;
                     }
                     .user_sub_tr {
                       border:0px;border-bottom:0px !important; border-bottom-width:0px !important;border-top:0px;border-top-width:0px !important;display:none
                     }
                     .user_sub_tr h3{
                       font-size:14px; padding:0px;margin:0px;
                     }
                     .user_sub_tr td{
                       border:0px;border-bottom:0px !important;border-bottom-width:0px !important;padding-top:6px !important; border-top: 0px !important;
                     }
                     .hiduser {
                       display:none;
                     }
                     .user_sub_tr select{
                        width:160px;
                     }
                     .perm label {
                       clear:left
                     }
                     .perm_div {
                       width:70px;height:40px;float:left;margin-left:4px;
                     }
                     .leftsec {
                       width:180px;float:left;
                     }
                     .rightsec {
                       width:180px;
                     }
                     .perm_select {
                      width:220px;float:left;
                     }
                     .perm_div_2 {
                      width:auto;float:left;padding-top:6px;
                     }
                     .acurser {
                      cursor:pointer;text-decoration:underline;color:#D94136;position:absolute;margin-left:0px;
                     }
                     .hcurser {
                      cursor:pointer;text-decoration:underline;color:#D94136;
                     }
					 .edit-pointer {
					  cursor:pointer;
					 }
                     </style>";

      //Below is the 'Table Headers' For The user data
      echo "<h3 class=\"floated\">User Management</h3><div class=\"edit-nav clearfix\"><p><a href=\"#\" id=\"add-user\">Add New User</a></p></div><table class=\"user_table\">";

      echo "<tr>";
      echo "<th>Username: </th><th>Email: </th><th>HTML Editor:</th><th>Edit</th>";
      echo "</tr>";


      // Open Users Directory And Put Filenames Into Array
      $dir = "./../data/users/*.xml";

      // Make Edit Form For Each User XML File Found
      foreach (glob($dir) as $file) {
          $xml = simplexml_load_file($file) or die("Unable to load XML file!");


      // PERMISSIONS CHECKBOXES - Checks XML File To Find Existing Permissions Settings //

      // Pages
      if ($xml->PERMISSIONS->PAGES != "") {
      $pageschecked = "checked";
      $pages_dropdown = "";
    }
     else {
     $pageschecked = "";
     $pages_dropdown = "<option value=\"pages.php\">Pages</option>";
     
     }

     //Files - uploads.php
     if ($xml->PERMISSIONS->FILES != "") {
      $fileschecked = "checked";
    }
     else {$fileschecked = "";}

    //Theme
     if ($xml->PERMISSIONS->THEME != "") {
      $themechecked = "checked";
    }
     else {$themechecked = "";}

    //Plugins
     if ($xml->PERMISSIONS->PLUGINS != "") {
      $pluginschecked = "checked";
    }
     else {$pluginschecked = "";}

     //Backuops
     if ($xml->PERMISSIONS->BACKUPS != "") {
      $backupschecked = "checked";
    }
    else {$backupschecked = "";}

    //Settings
     if ($xml->PERMISSIONS->SETTINGS != "") {
      $settingschecked = "checked";
    }
     else {$settingschecked = "";}


     //Support
     if ($xml->PERMISSIONS->SUPPORT != "") {
      $supportchecked = "checked";
    }
     else {$supportchecked = "";}

     //Admin
     if ($xml->PERMISSIONS->ADMIN != "") {
      $adminchecked = "checked";
    }
     else {$adminchecked = "";}

     //Landing Page
     if ($xml->PERMISSIONS->LANDING != "pages.php") {
      $landingselected = $xml->PERMISSIONS->LANDING;
    }
     else {$landingselected = "pages.php";}

     //Edit
     if ($xml->PERMISSIONS->EDIT != "") {
      $editchecked = "checked";
    }

    //Html Editor
     else {$editchecked = "";}
          // access XML data
          if ($xml->HTMLEDITOR == "") {
              $htmledit = "No";
          } else {
              $htmledit = "Yes";
          }

          if ($htmledit == "No") {
              $cchecked = "";
          } elseif ($htmledit == "Yes") {
              $cchecked = "checked";
          }

          //Below is the User Data
          echo "
           <script language=\"javascript\">
            function decision(message, url){
            if(confirm(message)) location.href = url;
            }
           </script>
               ";
          echo "<tr class=\"user_tr\">";
          echo "<td>&nbsp;" . $xml->USR . "</td>";
          echo "<td>&nbsp;" . $xml->EMAIL . "</td>";
          echo "<td>&nbsp;" . $htmledit . "</td>";

          //Edit Button (Expanded By Jquery Script)
          echo "<td><a style=\"\" class=\"edit-pointer edit-user$xml->USR acurser\">Edit</a><a style=\"\" class=\"hide-user$xml->USR acurser hiduser\">Hide</a></td>";
          echo "</tr>";
          echo "\n";
          echo "\n";

          //Begin 'Edit User' Form
          echo "<form method=\"post\" action=\"load.php?id=user-managment\">";
          echo "\n";

          //Edit Username
          echo "<tr class=\"hide-div$xml->USR user_sub_tr\" style=\"\">
          <td style\"\"></td>";
          echo "\n";

          //Edit Email
          echo "<td style=\"\"><input class=\"text\" id=\"useremail\" name=\"useremail\" type=\"text\" value=\"$xml->EMAIL\" /></td>";
          echo "\n";

          //HTML Editor Permissions
          echo "<td  style=\"\"><input name=\"usereditor\" id=\"usereditor\" type=\"checkbox\" $cchecked></td>";
          echo "\n";
          echo "\n";

          //Change Password
          echo "</tr><tr class=\"hide-div$xml->USR user_sub_tr\" style=\"\">";
          echo "\n";
          echo "<td style\"\"><label for=\"userpassword\">Password:</label><input autocomplete=\"off\" class=\"text\" id=\"userpassword\" name=\"userpassword\" type=\"password\" value=\"\" /></td>";



          //Change Language
          echo "<td>
							  <label for=\"userlng\">Language:</label>
								<select name=\"userlng\" id=\"userlng\" class=\"text\">
                                <option value=\"$xml->LANG\"selected=\"selected\">$xml->LANG</option>
									$langs
								</select>
							</td>";

          //Change Timezone
          echo "<td>
							<label for=\"ntimezone\">Timezone:</label>
								<select class=\"text\" id=\"ntimezone\" name=\"ntimezone\">
                                    <option value=\"$xml->TIMEZONE\"  selected=\"selected\">$xml->TIMEZONE</option>
                                   $Timezone_Include
								</select>
							</td></tr>";
          echo "\n";

          //Permissions Checkboxes
          echo "<tr class=\"hide-div$xml->USR user_sub_tr perm\" style=\"\">
          <td colspan=\"4\" height=\"16\"><h3 style=\"\">Permissions (<strong>Check Areas</strong> You Would Like <strong>To Block</strong> Access To)</h3></td>
                        </tr>";


          echo "<tr class=\"hide-div$xml->USR user_sub_tr\" style=\"\">";
          echo "<td colspan=\"4\">
                             <div class=\"perm_div\"><label>Pages</label>
                             <input type=\"checkbox\" name=\"Pages\" value=\"no\" $pageschecked />
                             </div>

                             <div class=\"perm_div\"><label>Files</label>
                             <input type=\"checkbox\" name=\"Files\" value=\"no\" $fileschecked />
                             </div>

                             <div class=\"perm_div\"><label>Theme</label>
                             <input type=\"checkbox\" name=\"Theme\" value=\"no\" $themechecked />
                             </div>

                             <div class=\"perm_div\"><label>Plugins</label>
                             <input type=\"checkbox\" name=\"Plugins\" value=\"no\" $pluginschecked />
                             </div>

                             <div class=\"perm_div\"><label>Backups</label>
                             <input type=\"checkbox\" name=\"Backups\" value=\"no\" $backupschecked />
                             </div>

                             <div class=\"perm_div\"><label>Settings</label>
                             <input type=\"checkbox\" name=\"Settings\" value=\"no\" $settingschecked />
                             </div>

                             <div class=\"perm_div\"><label>Support</label>
                             <input type=\"checkbox\" name=\"Support\" value=\"no\" $supportchecked />
                             </div>

                             <div class=\"perm_div\"><label>Edit</label>
                             <input type=\"checkbox\" name=\"Edit\" value=\"no\" $editchecked />
                             </div>

                             <div class=\"perm_select\"><label>Custom Landing Page (Optional)
                             <a class=\"hcurser\" title=\"This is where you can set an alternate landing page the user will arrive at upon logging in\">?</a></label>
                             <select name=\"Landing\" id=\"userland\" class=\"text\">
                              <option value=\"$landingselected\" selected=\"selected\">$landingselected</option>
                              $pages_dropdown
                              <option value=\"theme.php\">Theme</option>
                              <option value=\"settings.php\">Settings</option>
                              <option value=\"support.php\">Support</option>
                              <option value=\"edit.php\">Edit</option>
                              <option value=\"plugins.php\">Plugins</option>
                              <option value=\"upload.php\">Upload</option>
                              <option value=\"backups.php\">Backups</option>
						      </select>
                             </div>

                             <div class=\"perm_div_2\"><label>Disable Admin Access (Cannot Manage Users)</label>
                             <input type=\"checkbox\" id=\"Admin\" name=\"Admin\" value=\"no\" $adminchecked />
                             </div>

                             <div class=\"clear\"></div>

                            </td>";
          echo "\n";
          echo "</tr>";

          //Submit Form
          echo "<tr class=\"hide-div$xml->USR user_sub_tr perm\" style=\"\"><td><input class=\"submit\" type=\"submit\" name=\"submitted\" value=\"Save Changes\"/>";
          echo "&nbsp;&nbsp;&nbsp;<a class=\"hcurser\" ONCLICK=\"decision('Are You Sure You Want To Delete $xml->USR?','load.php?id=user-managment&deletefile=$xml->USR')\">Delete User</a></td>";
          echo"</tr></div><input type=\"hidden\" name=\"nano\" value=\"$xml->PWD\"/><input type=\"hidden\" name=\"usernamec\" value=\"$xml->USR\"/></form>";
          echo "\n";
          echo "\n";
      }
      echo "</table>";

      //Add User Link
      echo "";

      // begin Jquery
      echo "<script type=\"text/javascript\">";

      //For Each User XML Filed, Print jQuery To Show/Hide The 'Edit User' And 'Add User' Sections
      foreach (glob($dir) as $file) {
          $xml = simplexml_load_file($file) or die("Unable to load XML file!");
          echo "\$(\".edit-user$xml->USR\").click(function () {";
          echo "\n";
          echo "\$(\".edit-user$xml->USR\").slideUp();";
          echo "\n";
          echo "\$(\".hide-user$xml->USR\").slideDown();";
          echo "\n";
          echo "\$(\".hide-div$xml->USR\").slideDown();";
          echo "\n";
          echo "});";
          echo "\n";
          echo "\$(\".hide-user$xml->USR\").click(function () {";
          echo "\n";
          echo "\$(\".edit-user$xml->USR\").slideDown();";
          echo "\n";
          echo "\$(\".hide-user$xml->USR\").slideUp();";
          echo "\n";
          echo "\$(\".hide-div$xml->USR\").slideUp();";
          echo "\n";
          echo "});";
          echo "\$(\"hideagain\").click(function () {";
          echo "\n";
          echo "\$(\".edit-user$xml->USR\").slideUp();";
          echo "\n";
          echo "\$(\".hide-div$xml->USR\").slideDown();";
          echo "\n";
          echo "});";
          echo "\$(\"#add-user\").click(function () {";
          echo "\n";
          echo "\$(\"#add-user\").slideUp();";
          echo "\n";
          echo "\$(\".hide-div\").slideDown();";
          echo "\n";
          echo "});";
      }
      echo "</script>";

                             // ADD USER FORM //

      echo "
 <!-- Below is the html form to add a new user.. It is proccesed with 'readxml.php' -->
      <div id=\"profile\" class=\"hide-div section\" style=\"display:none;margin-top:0px;\">
      <form method=\"post\" action=\"load.php?id=user-managment-add\">
    <h3>Add New User</h3>
    <div class=\"leftsec\">
      <p><label for=\"usernamec\" >Username:</label><input class=\"text\" id=\"usernamec\" name=\"usernamec\" type=\"text\" value=\"\" /></p>
    </div>
    <div class=\"rightsec\">
      <p><label for=\"useremail\" >Email :</label><input class=\"text\" id=\"useremail\" name=\"useremail\" type=\"text\" value=\"\" /></p>
    </div>
    <div class=\"leftsec\">
      <p><label for=\"ntimezone\" >Timezone:</label>
      <select class=\"text\" id=\"ntimezone\" name=\"ntimezone\">
      <option value=\"$xml->TIMEZONE\"  selected=\"selected\">$xml->TIMEZONE</option>
          $Timezone_Include
								</select>
      </select>
      </p>
    </div>
    <div class=\"rightsec\">
      <p><label for=\"userlng\" >Language:</label>
      <select name=\"userlng\" id=\"userlng\" class=\"text\">
			<option value=\"en_US\"selected=\"selected\">English (en_US)</option>
            $langs
      </select>
      </p>
    </div>
     <div class=\"leftsec\">
      <p><label for=\"userpassword\" >Password:</label><input autocomplete=\"off\" class=\"text\" id=\"userpassword\" name=\"userpassword\" type=\"password\" value=\"\" /></p>
    </div>
     <div class=\"leftsec\">
       <p class=\"inline\" style=\"padding-top:24px;\"><input name=\"usereditor\" id=\"usereditor\" type=\"checkbox\" value=\"1\"  /> &nbsp;<label for=\"usereditor\" >Enable the HTML editor</label></p>
    </div>
      <div class=\"clear\"></div>
      <h3 style=\"font-size:14px;\">Permissions (<strong>Check Areas</strong> You Would Like <strong>To Block</strong> Access To)</h3>
             <div class=\"perm_div\"><label for=\"Pages\">Pages</label>
                             <input type=\"checkbox\" id=\"Pages\" name=\"Pages\" value=\"no\" $pageschecked />
                             </div>

                             <div class=\"perm_div\"><label for=\"Files\">Files</label>
                             <input type=\"checkbox\" id=\"Files\" name=\"Files\" value=\"no\" />
                             </div>

                             <div class=\"perm_div\"><label for=\"Theme\">Theme</label>
                             <input type=\"checkbox\" id=\"Theme\" name=\"Theme\" value=\"no\" />
                             </div>

                             <div class=\"perm_div\"><label for=\"Plugins\">Plugins</label>
                             <input type=\"checkbox\" id=\"Plugins\" name=\"Plugins\" value=\"no\" />
                             </div>

                             <div class=\"perm_div\"><label for=\"Backups\">Backups</label>
                             <input type=\"checkbox\" id=\"Backups\" name=\"Backups\" value=\"no\" />
                             </div>

                             <div class=\"perm_div\"><label for=\"Settings\">Settings</label>
                             <input type=\"checkbox\" id=\"Settings\" name=\"Settings\" value=\"no\" />
                             </div>

                             <div class=\"perm_div\"><label for=\"Support\">Support</label>
                             <input type=\"checkbox\" id=\"Support\" name=\"Support\" value=\"no\" />
                             </div>

                             <div class=\"perm_div\"><label for=\"Edit\">Edit</label>
                             <input type=\"checkbox\" id=\"Edit\" name=\"Edit\" value=\"no\" />
                             </div>
                             <div style=\"clear:both\"></div>

                             <div class=\"perm_select\"><label for=\"userland\">Custom Landing Page (Optional)
                             <a href=\"#\" title=\"This is where you can set an alternate landing page the user will arrive at upon logging in\">?</a></label>
                             <select name=\"Landing\" id=\"userland\" class=\"text\">
                              <option value=\"$landingselected\" selected=\"selected\">$landingselected</option>
						      <option value=\"pages.php\">Pages</option>
                              <option value=\"theme.php\">Theme</option>
                              <option value=\"settings.php\">Settings</option>
                              <option value=\"support.php\">Support</option>
                              <option value=\"edit.php\">Edit</option>
                              <option value=\"plugins.php\">Plugins</option>
                              <option value=\"upload.php\">Upload</option>
                              <option value=\"backups.php\">Backups</option>
						      </select>
                             </div>

                             <div class=\"perm_div_2\"><label for=\"Admin\">Disable Admin Access (Cannot Manage Users)</label>
                             <input type=\"checkbox\" id=\"Admin\" name=\"Admin\" value=\"no\" />
                             </div>

                             <div class=\"clear\"></div>



    <div class=\"rightsec\">
      <p></p>
    </div>
    <div class=\"clear\"></div>

    <p id=\"submit_line\" >
      <span><input class=\"submit\" type=\"submit\" name=\"submitted\" value=\"Add New User\" /></span> &nbsp;&nbsp;<?php i18n('OR'); ?>&nbsp;&nbsp; <a class=\"cancel\" href=\"settings.php?cancel\"><?php i18n('CANCEL'); ?></a>
    </p></form>

    </div>";
  }

     // HIDE MENU ITEMS //
  function multiuser_perm()
  {
    //Get Current Users XML File
	  if(get_cookie('GS_ADMIN_USERNAME') != "")
	  {
      $current_user = get_cookie('GS_ADMIN_USERNAME');
      $dir = "./../data/users/" . $current_user . ".xml";
      $xml = simplexml_load_file($dir) or die("Unable to load XML file!");
	  

      //Find Current script and trim path
      $current_file = $_SERVER["PHP_SELF"];
      $current_file = basename(rtrim($current_file, '/'));
      $current_script =  $_SERVER["QUERY_STRING"];

      //Settings.php permissions
      if ($current_file == "settings.php") {
          if ($xml->PERMISSIONS->SETTINGS == "no") {
              die('You Do Not Have Permissions To Access This Page');
          }
                else {
                   $settings_menu ="";
                   }
      }
          if ($xml->PERMISSIONS->SETTINGS == "no") {
              $settings_menu = ".settings {display:none !important;}";
              $settings_footer = "$(\"a\").remove(\":contains('General Settings')\");";
          }
                else {
                   $settings_menu ="";
                   $settings_footer = "";
                   }

      //backups.php permisions
      if ($current_file == "backups.php") {
          if ($xml->PERMISSIONS->BACKUPS == "no") {
              die('You Do Not Have Permissions To Access This Page');
          }
                else {
                   $backups_menu ="";
                   }
      }
          if ($xml->PERMISSIONS->BACKUPS == "no") {
              $backups_menu = ".backups {display:none !important;}";
              $backups_footer = "$(\"a\").remove(\":contains('Backup Management')\");";
          }
                else {
                   $backups_menu ="";
                   $backups_footer = "";
                   }

      //plugins.php permissions
      if ($current_file == "plugins.php") {
          if ($xml->PERMISSIONS->PLUGINS == "no") {
              die('You Do Not Have Permissions To Access This Page');
          }
                else {
                   $plugins_menu ="";
                   }
      }
          if ($xml->PERMISSIONS->PLUGINS == "no") {
              $plugins_menu = ".plugins {display:none !important;}";
              $plugins_footer = "$(\"a\").remove(\":contains('Plugin Management')\");";
          }
                else {
                   $plugins_menu ="";
                   $plugins_footer = "";
                   }

     //pages.php permissions - If pages is disabled, this coding will kill the pages script and redirect to the chosen alternate landing page
      if ($current_file == "pages.php") {
          if ($xml->PERMISSIONS->PAGES == "no") {
            die('<meta http-equiv="refresh" content="0;url='.$xml->PERMISSIONS->LANDING.'">');
          }
                else {
                   $pages_menu ="";
                   }
      }
          if ($xml->PERMISSIONS->PAGES == "no") {
              $pages_menu = ".pages {display:none !important;}";
              $pages_footer = "$(\"a\").remove(\":contains('Page Management')\");";
          }
                else {
                   $pages_menu ="";
                   $pages_footer = "";
                   }

     //support.php & health-check.php permissions
      if ($current_file == "support.php") {
          if ($xml->PERMISSIONS->SUPPORT == "no") {
              die('You Do Not Have Permissions To Access This Page');
          }
                else {
                    $support_menu = "";
                   }
      }
         if ($xml->PERMISSIONS->SUPPORT == "no") {
              $support_menu = ".support {display:none !important;}";
              $support_footer = "$(\"a\").remove(\":contains('Support')\");";
          }
                else {
                    $support_menu = "";
                    $support_footer = "";
                   }

      //uploads.php (files page) permissions
      if ($current_file == "upload.php") {
          if ($xml->PERMISSIONS->FILES == "no") {
              die('You Do Not Have Permissions To Access This Page');
          }
                else {
                     $files_menu = "";
                     $files_footer = "";
                   }
      }
          if ($xml->PERMISSIONS->FILES == "no") {
              $files_menu = ".files {display:none !important;}";
              $files_footer = "$(\"a\").remove(\":contains('File Management')\");";
          }
                else {
                     $files_menu = "";
                     $files_footer = "";
                   }

      //theme.php permissions
      if ($current_file == "theme.php") {
          if ($xml->PERMISSIONS->THEME == "no") {
              die('You Do Not Have Permissions To Access This Page');
          }
                else {
                    $theme_menu = "";
                   }
      }
         if ($xml->PERMISSIONS->THEME == "no") {
              $theme_menu = ".theme {display:none !important;}";
              $theme_footer = "$(\"a\").remove(\":contains('Theme Management')\");";
          }
                else {
                    $theme_menu = "";
                    $theme_footer = "";
                   }

      //archive.php
      if ($current_file == "archive.php") {
          if ($xml->PERMISSIONS->BACKUPS == "no") {
              die('You Do Not Have Permissions To Access This Page');
          }
                else {

                   }
      }

      //theme-edit.php permissions
      if ($current_file == "theme-edit.php") {
          if ($xml->PERMISSIONS->THEME == "no") {
              die('You Do Not Have Permissions To Access This Page');
          }
                else {

                   }
      }

      //components.php permissions
      if ($current_file == "components.php") {
          if ($xml->PERMISSIONS->THEME == "no") {
              die('You Do Not Have Permissions To Access This Page');
          }
                else {

                   }
      }


      //edit.php
      if ($current_file == "edit.php") {
          if ($xml->PERMISSIONS->EDIT == "no") {
              die('You Do Not Have Permissions To Access This Page');
          }
                else {
                  $edit_menu = "";
                   }
      }
      if ($xml->PERMISSIONS->EDIT == "no") {
              $edit_footer = "$(\"a\").remove(\":contains('reate New Page')\");";
          }
                else {
                  $edit_menu = "";
                  $edit_footer ="";
                   }

      //Admin - Do not allow permissions to edit users
      if ($current_script == "id=user-managment") {
          if ($xml->PERMISSIONS->ADMIN == "no") {
              die('You Do Not Have Permissions To Access This Page');
          }
      }

      if ($xml->PERMISSIONS->ADMIN == "no") {
                $admin_footer = "$(\"a\").remove(\":contains('User Management')\");";
          }
                else {
                  $admin_footer ="";
                   }

      //Hide Menu Items
      echo"<style type=\"text/css\">";

      echo $settings_menu . $backups_menu . $plugins_menu . $pages_menu . $support_menu . $files_menu . $theme_menu;

      echo "</style>";

      //Hide Footer Menu Items With Jquery
      echo "<script type=\"text/javascript\">";
      echo "\n";
      echo "$(document).ready(function() {";
      echo "\n";
      echo $files_footer . $settings_footer . "\n" . $backups_footer . "\n" . $plugins_footer . "\n" . $pages_footer . "\n" . $support_footer . "\n" . $theme_footer . "\n" . $edit_footer . "\n" . $admin_footer;
      echo "\n";
      echo " });";
      echo "</script>";
  }
  }
?>