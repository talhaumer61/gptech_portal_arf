<?php
// ADD EVENT
if(isset($_POST['submit_add'])) {
	$condition	=	array ( 
							'select' 	=> "event_short_title",
							'where' 	=> array( 
													'event_short_title'	=>	cleanvars($_POST['event_short_title'])
													,'is_deleted'	=>	'0'	
												),
							'return_type' 	=> 'count' 
						); 
	if($dblms->getRows(EVENTS, $condition)) {
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: events.php", true, 301);
		exit();
	}else{

		$values = array(
							 'event_status'					=>	cleanvars($_POST['event_status'])
							,'event_ordering'				=>	cleanvars($_POST['event_ordering'])
							,'event_short_title'			=>	cleanvars($_POST['event_short_title'])
							,'event_brief_title'			=>	cleanvars($_POST['event_brief_title'])
							,'event_href'					=>	cleanvars(to_seo_url($_POST['event_short_title']))
							,'event_description'			=>	cleanvars($_POST['event_description'])
							,'event_start_date'				=>	cleanvars($_POST['event_start_date'])
							,'event_end_date'				=>	cleanvars($_POST['event_end_date'])
							,'event_youtube_link'			=>	cleanvars($_POST['event_youtube_link'])
							,'id_added'						=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							,'date_added'					=>	date('Y-m-d G:i:s')
						); 

		$sqllms		=	$dblms->insert(EVENTS, $values);

		if($sqllms) { 

			if(!empty($_FILES['event_thumbnail']['name']) || !empty($_FILES['event_image']['name'])) {

				$event_id   =	$dblms->lastestid();

			}

			// EVENT THUMBNAIL
			if(!empty($_FILES['event_thumbnail']['name'])) {

				$path_parts 	= pathinfo($_FILES["event_thumbnail"]["name"]);
				$extension 		= strtolower($path_parts['extension']);
				if(in_array($extension , array('jpeg','jpg', 'png'))) {
					$img_dir 		= 'uploads/images/events/thumbnails/';
					$img_fileName	= to_seo_url(cleanvars($_POST['event_short_title'])).'-'.$event_id.".".($extension);
					$originalImage	= $img_dir.$img_fileName;
					$dataImage = array(
										'event_thumbnail'	=>	$img_fileName, 
										);
					$sqllmsThumbnail = $dblms->Update(EVENTS, $dataImage, "WHERE event_id = '".$event_id."'");
					unset($sqllmsThumbnail);
					$mode = '0644';
					move_uploaded_file($_FILES['event_thumbnail']['tmp_name'],$originalImage);
					chmod ($originalImage, octdec($mode));
				}

			}
			// EVENT IMAGE
			for ($i=0; $i < count($_FILES['event_photo']['name']); $i++){
				if(!empty($_FILES['event_photo']['name'][$i])) {
					$path_parts 	= pathinfo($_FILES["event_photo"]["name"][$i]);
					$extension 		= strtolower($path_parts['extension']);
					if(in_array($extension , array('jpeg','jpg', 'png'))) {
						$img_dir 		= 'uploads/images/events/';
						$img_fileName	= to_seo_url(cleanvars($_POST['event_short_title'])).'-'.$i.'-'.$event_id.".".($extension);
						$originalImage	= $img_dir.$img_fileName;
						$dataImage 		= array(
													 'event_photo'	=>	$img_fileName
													,'id_event'		=>	$event_id
													,'photo_status'	=>	1
													,'id_added'		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
													,'date_added'	=>	date('Y-m-d G:i:s')
												);
						$sqlUpdatePhoto = $dblms->insert(EVENT_PHOTOS, $dataImage);
						unset($sqlUpdatePhoto);static
						$mode = '0644';
						move_uploaded_file($_FILES['event_photo']['tmp_name'][$i],$originalImage);
						chmod ($originalImage, octdec($mode));
					}
				}
			}
			
			$remarks = 'Add event#:'.$event_id;
			$values = array (
								"id_user"	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,"filename"	=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
								,"action"	=>	'1'
								,"dated"	=>	date('Y-m-d G:i:s')
								,"ip"		=>	cleanvars($ip)
								,"remarks"	=>	cleanvars($remarks)
							);
			$sqllms  = $dblms->insert(LOGS, $values);
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
			$_SESSION['msg']['type'] 	= 'success';
			header("Location: events.php", true, 301);
			exit();
		}
	}
}

// EDIT EVENT
if(isset($_POST['submit_edit'])) {

	$condition	=	array ( 
							'select' 	=> "event_id",
							'where' 	=> array( 
													'event_short_title'	=>	cleanvars($_POST['event_short_title'])
													,'is_deleted'		=>	'0'	
												),
							'not_equal' 	=> array( 
													'event_id'			=>	cleanvars($_POST['event_id'])
												),					
							'return_type' 	=> 'count' 
						); 
	if($dblms->getRows(EVENTS, $condition)) {
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: events.php", true, 301);
		exit();
	}else{
	
		$values = array(
							 'event_status'					=>	cleanvars($_POST['event_status'])
							,'event_ordering'				=>	cleanvars($_POST['event_ordering'])
							,'event_short_title'			=>	cleanvars($_POST['event_short_title'])
							,'event_brief_title'			=>	cleanvars($_POST['event_brief_title'])
							,'event_href'					=>	cleanvars(to_seo_url($_POST['event_short_title']))
							,'event_description'			=>	cleanvars($_POST['event_description'])
							,'event_start_date'				=>	cleanvars($_POST['event_start_date'])
							,'event_end_date'				=>	cleanvars($_POST['event_end_date'])
							,'event_youtube_link'			=>	cleanvars($_POST['event_youtube_link'])
							,'id_modify'					=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							,'date_modify'					=>	date('Y-m-d G:i:s')
					); 

		$sqllms = $dblms->Update(EVENTS , $values , "WHERE event_id  = '".cleanvars($_POST['event_id'])."'");
		
		if($sqllms) { 
			// EVENT THUMBNAIL
			if(!empty($_FILES['event_thumbnail']['name'])) {

				$path_parts 	= pathinfo($_FILES["event_thumbnail"]["name"]);
				$extension 		= strtolower($path_parts['extension']);
				if(in_array($extension , array('jpeg','jpg', 'png', 'JPEG', 'JPG', 'PNG'))) {
					$img_dir 		= 'uploads/images/events/thumbnails/';
					$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['event_short_title'])).'-'.$_POST['event_id'].".".($extension);
					$img_fileName	= to_seo_url(cleanvars($_POST['event_short_title'])).'-'.$_POST['event_id'].".".($extension);
					$dataImage = array(
										'event_thumbnail'	=>	$img_fileName, 
									);
					$sqllmsThumbnail = $dblms->Update(EVENTS, $dataImage, "WHERE event_id = '".$_POST['event_id']."'");
					unset($sqllmsThumbnail);
					$mode = '0644';
					move_uploaded_file($_FILES['event_thumbnail']['tmp_name'],$originalImage);
					chmod ($originalImage, octdec($mode));
				}

			}
			
			$remarks = 'Update Events#:'.cleanvars($_POST['event_id']);
			$values = array (
								"id_user"	=>	  cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,"filename"	=>	  strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
								,"action"	=>	  '2'
								,"dated"	=>	  date('Y-m-d G:i:s')
								,"ip"		=>	  cleanvars($ip)
								,"remarks"	=>	  cleanvars($remarks)
							);
			$sqllLog  = $dblms->insert(LOGS, $values);
			$_SESSION['msg']['title'] 	= 'Successfully';
			$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
			$_SESSION['msg']['type'] 	= 'info';
			header("Location: events.php", true, 301);
			exit();
		}
	}	
}

// DELETE EVENT
if(isset($_GET['deleteid'])) {
	
	$values = array(
						'id_deleted'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,'is_deleted'	=>	'1'
						,'ip_deleted'	=>	cleanvars($ip)
						,'date_deleted'	=>	date('Y-m-d G:i:s')
					);   

	$sqlDel = $dblms->Update(EVENTS , $values , "WHERE event_id  = '".cleanvars($_GET['deleteid'])."'");

	if($sqlDel) { 
		$remarks = 'Delete Event#:'.cleanvars($_GET['deleteid']);
		$values = array (
							"id_user"		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							,"filename"		=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
							,"action"		=>	'3'
							,"dated"		=>	date('Y-m-d G:i:s')
							,"ip"			=>	cleanvars($ip)
							,"remarks"		=>	cleanvars($remarks)
							,"id_deleted"	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							,"ip_deleted"	=>	cleanvars($ip)
							,'date_deleted'	=>	date('Y-m-d G:i:s')
						);
		$sqllms  = $dblms->insert(LOGS, $values);
		$_SESSION['msg']['title'] 	= 'Warning';
		$_SESSION['msg']['text'] 	= 'Record Successfully Deleted.';
		$_SESSION['msg']['type'] 	= 'warning';
		header("Location: events.php", true, 301);
		exit();
	}
}

// ADD RECORD PHOTO
if(isset($_POST['submit_add_photo'])) {	
	$redirect = "view=photos&id=".$_POST['id_event']."&title=".$_POST['title']."";
	$condition = array ( 
							 'select'       =>  'id'
							,'where' 	    =>  array( 
														'id_event'    =>   cleanvars($_POST['id_event'])
													)
							,'return_type'  =>  'count' 
						);
	$countPhoto = $dblms->getRows(EVENT_PHOTOS, $condition);

	if($countPhoto){
		$i = $countPhoto;
	} else {
		$i = '0';
	}

	if(!empty($_FILES['event_photo']['name'])) {
		$path_parts 	= pathinfo($_FILES["event_photo"]["name"]);
		$extension 		= strtolower($path_parts['extension']);
		if(in_array($extension , array('jpeg','jpg', 'png'))) {
			$img_dir 		= 'uploads/images/events/';
			$img_fileName	= to_seo_url(cleanvars($_POST['title'])).'-'.$i.'-'.$_POST['id_event'].".".($extension);
			$originalImage	= $img_dir.$img_fileName;
			$dataImage 		= array(
										 'event_photo'	=>	$img_fileName
										,'id_event'		=>	$_POST['id_event']
										,'photo_status'	=>	$_POST['photo_status']
										,'id_added'		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
										,'date_added'	=>	date('Y-m-d G:i:s')
									);
			$sqlUpdatePhoto = $dblms->insert(EVENT_PHOTOS, $dataImage);
			unset($sqlUpdatePhoto);static
			$mode = '0644';
			move_uploaded_file($_FILES['event_photo']['tmp_name'],$originalImage);
			chmod ($originalImage, octdec($mode));
		}
	}
	
	// REMARKS
	$remarks = 'Add Event Photo#:'.$_POST['id_event'];
	$values = array (
						 "id_user"	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,"filename"	=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
						,"action"	=>	'1'
						,"dated"	=>	date('Y-m-d G:i:s')
						,"ip"		=>	cleanvars($ip)
						,"remarks"	=>	cleanvars($remarks)
					);
	$sqllms  = $dblms->insert(LOGS, $values);
	$_SESSION['msg']['title'] 	= 'Successfully';
	$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
	$_SESSION['msg']['type'] 	= 'success';
	header("Location: events.php?".$redirect."", true, 301);
	exit();
}

// EDIT RECORD PHOTO
if(isset($_POST['submit_edit_photo'])) { 
	$redirect = "view=photos&id=".$_POST['id_event']."&title=".$_POST['title']."";
	$values = array(
							 'photo_status'	=>	$_POST['photo_status']
							,'id_modify'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							,'date_modify'	=>	date('Y-m-d G:i:s')
						);
	$sqlUpdate = $dblms->Update(EVENT_PHOTOS, $values , "WHERE id  = '".cleanvars($_POST['id'])."'");

	if(!empty($_FILES['event_photo']['name'])) {
		$path_parts 	= pathinfo($_FILES["event_photo"]["name"]);
		$extension 		= strtolower($path_parts['extension']);
		if(in_array($extension , array('jpeg','jpg', 'png'))) {
			$img_dir 		= 'uploads/images/events/';
			$img_fileName	= $_POST['filename'].".".($extension);
			$originalImage	= $img_dir.$img_fileName;
			$dataImage 		= array(
										'event_photo'	=>	$img_fileName
									);
			$sqlUpdatePhoto = $dblms->Update(EVENT_PHOTOS, $dataImage , "WHERE id  = '".cleanvars($_POST['id'])."'");
			unset($sqlUpdatePhoto);static
			$mode = '0644';
			move_uploaded_file($_FILES['event_photo']['tmp_name'],$originalImage);
			chmod ($originalImage, octdec($mode));
		}
	}
	
	// REMARKS
	
	$remarks = 'Edit Event Photo#:'.$_POST['id_event'];
	$values = array (
						 "id_user"	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,"filename"	=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
						,"action"	=>	'1'
						,"dated"	=>	date('Y-m-d G:i:s')
						,"ip"		=>	cleanvars($ip)
						,"remarks"	=>	cleanvars($remarks)
					);
	$sqllms  = $dblms->insert(LOGS, $values);
	$_SESSION['msg']['title'] 	= 'Successfully';
	$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
	$_SESSION['msg']['type'] 	= 'info';
	header("Location: events.php?".$redirect."", true, 301);
	exit();
}

// DELETE PHOTO
if(isset($_GET['deleteid_photo'])) {
	$redirect = "view=photos&id=".$_GET['id_event']."&title=".$_GET['title']."";
	$latestID = $_GET['deleteid_photo'];
	$values = array(
						 'id_deleted'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,'is_deleted'	=>	'1'
						,'ip_deleted'	=>	cleanvars(LMS_IP)
						,'date_deleted'	=>	date('Y-m-d G:i:s')
					);   
	$sqlDel = $dblms->Update(EVENT_PHOTOS , $values , "WHERE id  = '".cleanvars($latestID)."'");

	if($sqlDel) { 
	
		$remarks = 'Delete Event Photo#:'.$_POST['id_event'];
		$values = array (
							 "id_user"	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							,"filename"	=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
							,"action"	=>	'1'
							,"dated"	=>	date('Y-m-d G:i:s')
							,"ip"		=>	cleanvars($ip)
							,"remarks"	=>	cleanvars($remarks)
						);
		$sqllms  = $dblms->insert(LOGS, $values);
		$_SESSION['msg']['title'] 	= 'Successfully';
		$_SESSION['msg']['text'] 	= 'Record Successfully Deleted.';
		$_SESSION['msg']['type'] 	= 'danger';
		header("Location: events.php?".$redirect."", true, 301);
		exit();
	}
}
?>