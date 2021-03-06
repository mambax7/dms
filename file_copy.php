<?php
//  ------------------------------------------------------------------------ //
//                     Document Management System                            //
//                  Written By:  Brian E. Reifsnyder                         //
//                        Copyright 2003                                     //
// ------------------------------------------------------------------------- //
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

// file_copy.php

include_once '../../mainfile.php';
include_once 'inc_dms_functions.php';
include_once 'inc_dest_path_and_file.php';
include_once 'inc_file_copy.php';
include_once 'inc_lifecycle_functions.php';

// Include the select object system.
//include_once 'inc_obj_select.php';


if (dms_get_var("hdn_file_copy") == "confirm")
	{
	$dest_obj_owner = dms_get_var("rad_selected_obj_id");
	
	$obj_id = dms_get_var("hdn_obj_id");

	$location = "file_options.php?obj_id=".$obj_id;
	
	$new_obj_id = dms_file_copy($obj_id,$dest_obj_owner);

	//dms_document_name_sync($new_obj_id);
	
	dms_auditing($obj_id,"document/copy/dest obj id=".$obj_id."/dest folder id=".$dest_obj_owner);
	dms_auditing($new_obj_id,"document/copy/source obj id=".$obj_id);
	
	dms_folder_subscriptions($new_obj_id);
	
	// Check to see if an automatic lifecycle exists for this document.  If it exists, apply it.
	
	$query  = "SELECT data FROM ".$dmsdb->prefix("dms_object_misc")." ";
	$query .= "WHERE obj_id=".$dest_obj_owner." AND data_type='".FOLDER_AUTO_LIFECYCLE_NUM."'";
	$folder_auto_lifecycle_num = $dmsdb->query($query,'data');
	if($dmsdb->getnumrows() == 1) dms_apply_lifecycle($new_obj_id,$folder_auto_lifecycle_num);
	
	dms_message("The document has been copied to the selected destination directory.");
	
	//header("Location:".$location);
	dms_header_redirect($location);
	
	exit(0);
	}
else
	{
	$obj_id = dms_get_var("hdn_obj_id");
	if($obj_id == FALSE) $obj_id = dms_get_var("obj_id");
	//if ($HTTP_POST_VARS["hdn_obj_id"]) $obj_id = $HTTP_POST_VARS['hdn_obj_id'];
	//else $obj_id = $HTTP_GET_VARS['obj_id']; 
	
	// Permissions required to access this page:
	//  EDIT, OWNER
	$perms_level = dms_perms_level($obj_id);
	
	if ( ($perms_level != 3) && ($perms_level != 4) )
		{
		print("<SCRIPT LANGUAGE='Javascript'>\r");
		print("location='index.php';");
		print("</SCRIPT>");  
		end();
		}
	
	$location = "file_copy.php";
		
	include 'inc_pal_header.php';
	include_once 'inc_obj_select.php';

	// Get file information
	$query  = "SELECT obj_name from ".$dmsdb->prefix("dms_objects")." ";
	$query .= "WHERE obj_id='".$obj_id."'";  
	$doc_name = $dmsdb->query($query,'obj_name');
	
	print "  <form method='post' name='frm_select_obj' action='file_copy.php'>\r";
	print "  <table width='100%'>\r";

	//display_dms_header(2);
	dms_display_header(2,"","",FALSE);

	print "  <tr><td colspan='2'><BR></td></tr>\r";
	print "  <tr><td colspan='2' align='left'><b>Copy Document:</b></td></tr>\r";
	print "  <tr><td colspan='2'><BR></td></tr>\r";
	print "  <tr>\r";
	print "    <td colspan='2' align='left'>Name:&nbsp;&nbsp;&nbsp;";
	print "        ".$doc_name."</td>\r";
	print "  </tr>\r";
	print "  <tr><td colspan='2'><BR></td></tr>\r";
	
	print "  <tr>\r";
	print "    <td colspan='2' align='left'>\r";
	
	dms_select_object_id(SELECT_FOLDER,$obj_id);
	
	print "    </td>\r";
	print "  </tr>\r";
	
	print "  <tr><td colspan='2'><BR></td></tr>\r";
	
	print "  <td colspan='2' align='left'><input type=button name='btn_submit' value='Copy' onclick='obj_select_check_for_dest();'>";
	print "                               <input type=button name='btn_cancel' value='Cancel' onclick='location=\"file_options.php?obj_id=".$obj_id."\";'></td>\r";
	print "</table>\r";
	print "<input type='hidden' name='hdn_file_copy' value='confirm'>\r";
	print "<input type='hidden' name='hdn_obj_id' value='".$obj_id."'>\r";
	print "<input type='hidden' name='hdn_destination_folder_id' value=''>\r";
	print "</form>\r";

	include_once 'inc_pal_footer.php';
	}
?>



