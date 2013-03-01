<?php
//  ------------------------------------------------------------------------ //
//                     Document Management System                            //
//                  Written By:  Brian E. Reifsnyder                         //
//                         Copyright (c) 2003                                //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //

$modversion['name'] = "Document Management System";
$modversion['version'] = 1.91;
$modversion['description'] = "Document Management System";
$modversion['credits'] = "";
$modversion['author'] = "Brian E. Reifsnyder";
$modversion['help'] = "";
$modversion['license'] = "GPL see LICENSE";
$modversion['official'] = "No";
$modversion['image'] = "images/logo.png";
$modversion['dirname'] = "dms";

$modversion['hasMain'] = 1;

$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

$modversion['hasSearch'] = 1;
$modversion['search']['file'] = "inc_search_x.php";
$modversion['search']['func'] = "dms_search_x";

// Sql file (must contain sql generated by phpMyAdmin or phpPgAdmin)
// All tables should not have any prefix!
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";
//$modversion['sqlfile']['postgresql'] = "sql/pgsql.sql";

// Tables created by sql file (without prefix!)
$modversion['tables'][0]  = "dms_config";
$modversion['tables'][1]  = "dms_object_properties_sb";
$modversion['tables'][2]  = "dms_file_sys_counters";
$modversion['tables'][3]  = "dms_objects";
$modversion['tables'][4]  = "dms_object_perms";
$modversion['tables'][5]  = "dms_object_versions";
$modversion['tables'][6]  = "dms_object_version_comments";
$modversion['tables'][7]  = "dms_object_properties";
$modversion['tables'][8]  = "dms_object_misc";
$modversion['tables'][9]  = "dms_routing_data";
$modversion['tables'][10] = "dms_exp_folders";
$modversion['tables'][11] = "dms_active_folder";
$modversion['tables'][12] = "dms_lifecycles";
$modversion['tables'][13] = "dms_lifecycle_stages";
$modversion['tables'][14] = "dms_audit_log";
$modversion['tables'][15] = "dms_subscriptions";
$modversion['tables'][16] = "dms_groups";
$modversion['tables'][17] = "dms_groups_users_link";
$modversion['tables'][18] = "dms_notify";
$modversion['tables'][19] = "dms_user_doc_history";
$modversion['tables'][20] = "dms_user_prefs";
$modversion['tables'][21] = "dms_help_system";
$modversion['tables'][22] = "dms_job_services";

// Blocks
$modversion['blocks'][1]['file'] = "dms_block_doc_history.php";
$modversion['blocks'][1]['name'] = "Document History";
$modversion['blocks'][1]['show_func'] = "dms_show_history";
$modversion['blocks'][1]['template'] = "dms_block_history.html";
