<?php
//  ------------------------------------------------------------------------ //
//                     Document Management System                            //
//                  Written By:  Brian E. Reifsnyder                         //
//                        Copyright 2008                                     //
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

// file_move.php

include '../../mainfile.php';
include_once 'inc_dms_functions.php';

if (dms_get_var("hdn_folder_move") != FALSE)
	{
	$dest_folder = dms_get_var("rad_selected_obj_id");
	$obj_id = dms_get_var("hdn_obj_id");

	$location = "folder_options.php?obj_id=".$obj_id;
	
	$query  = "UPDATE ".$dmsdb->prefix('dms_objects')." ";
	$query .= "SET ";
	$query .= "obj_owner='".$dest_folder."' ";
	$query .= "WHERE obj_id='".$obj_id."'";
	$dmsdb->query($query);
	
	dms_auditing($obj_id,"folder/move/dest folder id=".$dest_folder);
	dms_message("The folder has been moved to the selected destination folder.");
	
	dms_header_redirect($location);
	}
else
	{
	include 'inc_pal_header.php';
	include_once 'inc_obj_select.php';

	if (dms_get_var("hdn_obj_id") != FALSE) $obj_id = dms_get_var("hdn_obj_id");
	else $obj_id = dms_get_var("obj_id");
	
	// Permissions required to access this page:
	//  OWNER
	$perms_level = dms_perms_level($obj_id);
	
	if ( $perms_level != OWNER )
		{
		print("<SCRIPT LANGUAGE='Javascript'>\r");
		print("location='index.php';");
		print("</SCRIPT>");  
		end();
		}
	
	$location="folder_move.php";
		
	// Get file information
	$query  = "SELECT obj_name from ".$dmsdb->prefix("dms_objects")." ";
	$query .= "WHERE obj_id='".$obj_id."'";  
	$obj_name = $dmsdb->query($query,'obj_name');
	
	print "  <table width='100%'>\r";
	print "  <form method='post' name='frm_select_obj' action='folder_move.php'>\r";
	dms_display_header(2,"","",FALSE);
	
	print "  <tr><td colspan='2'><BR></td></tr>\r";
	print "  <tr><td colspan='2' align='left'><b>Move Folder</b></td></tr>\r";
	print "  <tr><td colspan='2'><BR></td></tr>\r";
	print "  <tr>\r";
	print "    <td colspan='2' align='left'>Folder Name:&nbsp;&nbsp;&nbsp;";
	print "        ".$obj_name."</td>\r";
	print "  </tr>\r";
	print "  <tr><td colspan='2'><BR></td></tr>\r";
	
	print "  <tr>\r";
	print "    <td colspan='2' align='left'>\r";
	
	dms_select_object_id(SELECT_FOLDER,$obj_id,TRUE);
	
	print "    </td>\r";
	print "  </tr>\r";
	
	print "  <tr><td colspan='2'><BR></td></tr>\r";
	
	print "  <td colspan='2' align='left'><input type=button name='btn_submit' value='" . _DMS_MOVE . "' onclick='obj_select_check_for_dest();'>";
	print "                               <input type=button name='btn_cancel' value='" . _DMS_CANCEL . "' onclick='location=\"folder_options.php?obj_id=".$obj_id."\";'></td>\r";
	print "</table>\r";
	print "<input type='hidden' name='hdn_folder_move' value='confim'>\r";
	print "<input type='hidden' name='hdn_obj_id' value='".$obj_id."'>\r";
	print "<input type='hidden' name='hdn_destination_folder_id' value=''>\r";
	print "</form>\r";
	
	include_once 'inc_pal_footer.php';
	}
?>



