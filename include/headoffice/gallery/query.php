<?php
// ADD RECORD
if(isset($_POST['submit_add'])) {
	$condition	=	array ( 
							'select' 	=> "gal_title",
							'where' 	=> array( 
													 'gal_title'	=>	cleanvars($_POST['gal_title'])
													,'is_deleted'	=>	'0'	
												),
							'return_type' 	=> 'count' 
						); 
	if($dblms->getRows(GALLERY, $condition)) {
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: gallery.php", true, 301);
		exit();
	}else{
		$values = array(
						 'gal_title'		=>	cleanvars($_POST['gal_title'])
						,'gal_ordering'		=>	cleanvars($_POST['gal_ordering'])
						,'gal_description' 	=>	cleanvars($_POST['gal_description'])
						,'gal_status' 		=>	cleanvars($_POST['gal_status'])
						,'gal_href' 		=>	to_seo_url(cleanvars($_POST['gal_title']))
						,'id_cat' 			=>	cleanvars($_POST['id_cat'])
						,'id_place' 		=>	cleanvars($_POST['id_place'])
						,'gal_dated' 		=>	cleanvars($_POST['gal_dated'])
						,'id_added'			=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,'date_added'		=>	date('Y-m-d G:i:s')
					); 
		$sqllms = $dblms->insert(GALLERY, $values);

		if($sqllms) { 
			// LATEST ID
			$latestID = $dblms->lastestid();

			// THUMBNAIL
			if(!empty($_FILES['gal_image_video']['name'])) {
				$path_parts 	= pathinfo($_FILES["gal_image_video"]["name"]);
				$extension 		= strtolower($path_parts['extension']);
				if(in_array($extension , array('jpeg','jpg', 'png'))) {
					$fileDir 		= 'uploads/images/gallery/thumbnails/';
					$fileName		= to_seo_url(cleanvars($_POST['gal_title'])).'-'.$latestID.".".($extension);
					$originalFile	= $fileDir.$fileName;
					$dataImage = array(
										'gal_image_video'	=>	$fileName, 
										);
					$sqllmsThumbnail = $dblms->Update(GALLERY, $dataImage, "WHERE gal_id = '".$latestID."'");
					unset($sqllmsThumbnail);
					$mode = '0644';
					move_uploaded_file($_FILES['gal_image_video']['tmp_name'],$originalFile);
					chmod ($originalFile, octdec($mode));
				}
			}

			// PHOTOS
			for ($i=0; $i < count($_FILES['gal_photo']['name']); $i++){
				if(!empty($_FILES['gal_photo']['name'][$i])) {
					$path_parts 	= pathinfo($_FILES["gal_photo"]["name"][$i]);
					$extension 		= strtolower($path_parts['extension']);
					if(in_array($extension , array('jpeg','jpg', 'png'))) {
						$fileDir 		= 'uploads/images/gallery/';
						$fileName		= to_seo_url(cleanvars($_POST['gal_title'])).'-'.$i.'-'.$latestID.".".($extension);
						$originalFile	= $fileDir.$fileName;
						$dataImage 		= array(
													 'gal_photo'	=>	$fileName
													,'id_gal'		=>	$latestID
													,'photo_status'	=>	1
													,'id_added'		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
													,'date_added'	=>	date('Y-m-d G:i:s')
												);
						$sqlUpdatePhoto = $dblms->insert(GALLERY_PHOTOS, $dataImage);
						unset($sqlUpdatePhoto);static
						$mode = '0644';
						move_uploaded_file($_FILES['gal_photo']['tmp_name'][$i],$originalFile);
						chmod ($originalFile, octdec($mode));
					}
				}
			}
			
			$remarks = 'Add Gallery#:'.$event_id;
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
			header("Location: gallery.php", true, 301);
			exit();
		}
	}
}

// EDIT RECORD
if(isset($_POST['submit_edit'])) {

	$condition	=	array ( 
							'select' 		=> "gal_title",
							'where' 		=> array( 
													 'gal_title'	=>	cleanvars($_POST['gal_title'])
													,'is_deleted'	=>	'0'	
												),
							'not_equal'		=> array( 
													 'gal_id'	=>	cleanvars($_POST['gal_id'])
												),
							'return_type' 	=> 'count' 
						); 
	if($dblms->getRows(GALLERY, $condition)) {
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: gallery.php", true, 301);
		exit();
	}else{	
		$values = array(
						 'gal_title'		=>	cleanvars($_POST['gal_title'])
						,'gal_ordering'		=>	cleanvars($_POST['gal_ordering'])
						,'gal_description' 	=>	cleanvars($_POST['gal_description'])
						,'gal_status' 		=>	cleanvars($_POST['gal_status'])
						,'gal_href' 		=>	to_seo_url(cleanvars($_POST['gal_title']))
						,'id_cat' 			=>	cleanvars($_POST['id_cat'])
						,'id_place' 		=>	cleanvars($_POST['id_place'])
						,'gal_dated' 		=>	cleanvars($_POST['gal_dated'])
						,'id_modify'		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,'date_modify'		=>	date('Y-m-d G:i:s')
					); 
		$sqllms = $dblms->Update(GALLERY , $values , "WHERE gal_id  = '".cleanvars($_POST['gal_id'])."'");
		
		if($sqllms) { 
			// LATEST ID
			$latestID = $_POST['gal_id'];

			// THUMBNAIL
			if(!empty($_FILES['gal_image_video']['name'])) {
				$path_parts 	= pathinfo($_FILES["gal_image_video"]["name"]);
				$extension 		= strtolower($path_parts['extension']);
				if(in_array($extension , array('jpeg','jpg', 'png'))) {
					$fileDir 		= 'uploads/images/gallery/thumbnails/';
					$fileName		= to_seo_url(cleanvars($_POST['gal_title'])).'-'.$latestID.".".($extension);
					$originalFile	= $fileDir.$fileName;
					$dataImage = array(
										'gal_image_video'	=>	$fileName, 
										);
					$sqllmsThumbnail = $dblms->Update(GALLERY, $dataImage, "WHERE gal_id = '".$latestID."'");
					unset($sqllmsThumbnail);
					$mode = '0644';
					move_uploaded_file($_FILES['gal_image_video']['tmp_name'],$originalFile);
					chmod ($originalFile, octdec($mode));
				}
			}
			
			$remarks = 'Update Gallery#:'.cleanvars($latestID);
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
			header("Location: gallery.php", true, 301);
			exit();
		}
	}	
}

// DELETE RECORD
if(isset($_GET['deleteid'])) {	
	$values = array(
						'id_deleted'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,'is_deleted'	=>	'1'
						,'ip_deleted'	=>	cleanvars($ip)
						,'date_deleted'	=>	date('Y-m-d G:i:s')
					);   

	$sqlDel = $dblms->Update(GALLERY , $values , "WHERE gal_id  = '".cleanvars($_GET['deleteid'])."'");

	if($sqlDel) { 
		$remarks = 'Delete Gallery#:'.cleanvars($_GET['deleteid']);
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
		header("Location: gallery.php", true, 301);
		exit();
	}
}

// ADD RECORD PHOTO
if(isset($_POST['submit_add_photo'])) {
	$redirect = "view=photos&id_setup=".$_POST['id_setup']."&title=".$_POST['title']."";
	$condition = array ( 
							 'select'       =>  'id'
							,'where' 	    =>  array( 
														'id_gal'    =>   cleanvars($_POST['id_setup'])
													)
							,'return_type'  =>  'count' 
						);
	$countPhoto = $dblms->getRows(GALLERY_PHOTOS, $condition);

	if($countPhoto){
		$i = $countPhoto;
	} else {
		$i = '0';
	}

	if(!empty($_FILES['gal_photo']['name'])) {
		$path_parts 	= pathinfo($_FILES["gal_photo"]["name"]);
		$extension 		= strtolower($path_parts['extension']);
		if(in_array($extension , array('jpeg','jpg', 'png'))) {
			$img_dir 		= 'uploads/images/gallery/';
			$img_fileName	= to_seo_url(cleanvars($_POST['title'])).'-'.$i.'-'.$_POST['id_setup'].".".($extension);
			$originalImage	= $img_dir.$img_fileName;
			$dataImage 		= array(
										 'gal_photo'	=>	$img_fileName
										,'id_gal'		=>	$_POST['id_setup']
										,'photo_status'	=>	$_POST['photo_status']
										,'id_added'		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
										,'date_added'	=>	date('Y-m-d G:i:s')
									);
			$sqlUpdatePhoto = $dblms->insert(GALLERY_PHOTOS, $dataImage);
			unset($sqlUpdatePhoto);static
			$mode = '0644';
			move_uploaded_file($_FILES['gal_photo']['tmp_name'],$originalImage);
			chmod ($originalImage, octdec($mode));
		}
	}
	
	$latestID = $dblms->lastestid();
	
	// REMARKS
	$remarks = 'Add Gallery Photo#:'.$latestID;
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
	header("Location: gallery.php?".$redirect."", true, 301);
	exit();
}

// EDIT RECORD PHOTO
if(isset($_POST['submit_edit_photo'])) { 
	$redirect = "view=photos&id_setup=".$_POST['id_setup']."&title=".$_POST['title']."";

	$values	= array(
						 'photo_status'	=>	$_POST['photo_status']
						,'id_modify'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,'date_modify'	=>	date('Y-m-d G:i:s')
					);
	$sqlUpdate = $dblms->Update(GALLERY_PHOTOS, $values , "WHERE id = '".cleanvars($_POST['edit_id'])."'");

	if(!empty($_FILES['gal_photo']['name'])) {
		$path_parts 	= pathinfo($_FILES["gal_photo"]["name"]);
		$extension 		= strtolower($path_parts['extension']);
		if(in_array($extension , array('jpeg','jpg', 'png'))) {
			$img_dir 		= 'uploads/images/gallery/';
			$img_fileName	= $_POST['filename'].".".($extension);
			$originalImage	= $img_dir.$img_fileName;
			$dataImage 		= array(
										'gal_photo'	=>	$img_fileName
									);
			$sqlUpdatePhoto = $dblms->Update(GALLERY_PHOTOS, $dataImage , "WHERE id = '".cleanvars($_POST['edit_id'])."'");
			unset($sqlUpdatePhoto);static
			$mode = '0644';
			move_uploaded_file($_FILES['gal_photo']['tmp_name'],$originalImage);
			chmod ($originalImage, octdec($mode));
		}
	}
	
	// REMARKS	
	$remarks = 'Edit Gallery Photo#:'.$_POST['edit_id'];
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
	header("Location: gallery.php?".$redirect."", true, 301);
	exit();
}

// DELETE PHOTO
if(isset($_GET['deleteid_photo'])) {
	$redirect = "view=photos&id_setup=".$_GET['id_setup']."&title=".$_GET['title']."";
	$latestID = $_GET['deleteid_photo'];
	$values = array(
						 'id_deleted'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,'is_deleted'	=>	'1'
						,'ip_deleted'	=>	cleanvars(LMS_IP)
						,'date_deleted'	=>	date('Y-m-d G:i:s')
					);   
	$sqlDel = $dblms->Update(GALLERY_PHOTOS , $values , "WHERE id = '".cleanvars($latestID)."'");

	if($sqlDel) { 
	
		$remarks = 'Delete Gallery Photo#:'.$latestID;
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
		header("Location: gallery.php?".$redirect."", true, 301);
		exit();
	}
}
?>