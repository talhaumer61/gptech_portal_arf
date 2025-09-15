<?php
// ADD RECORD
if(isset($_POST['submit_add'])) {
	$condition	=	array ( 
							'select' 	=> "id",
							'where' 	=> array( 
													 'title'		=>	cleanvars($_POST['title'])
													,'type'			=>	cleanvars($_POST['type'])
													,'is_deleted'	=>	'0'	
												),
							'return_type' 	=> 'count' 
							); 
	if($dblms->getRows(REPORTS_DOWNLOADS, $condition)) {
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: reports.php", true, 301);
		exit();
	}else{

		$values = array(
							 'status'			=>	cleanvars($_POST['status'])
							,'type'				=>	cleanvars($_POST['type'])
							,'title'			=>	cleanvars($_POST['title'])
							,'id_added'			=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							,'date_added'		=>	date('Y-m-d G:i:s')
						); 
		$sqllms = $dblms->insert(REPORTS_DOWNLOADS, $values);

		if($sqllms) { 
			$latestId = $dblms->lastestid();

			// FILE
			if(!empty($_FILES['file']['name'])) {
				$path_parts 	= pathinfo($_FILES["file"]["name"]);
				$extension 		= strtolower($path_parts['extension']);
				if(in_array($extension , array('pdf'))) {
					$fileDir 		= 'uploads/files/reports/';
					$fileName		= to_seo_url($_POST['title'].'-'.$_POST['type'].'-'.$latestId).'.'.$extension;
					$originalFile	= $fileDir.$fileName;
					$valuesFile = array(
										'file'	=>	$fileName, 
										);
					$sqlUploadFIle = $dblms->Update(REPORTS_DOWNLOADS, $valuesFile, "WHERE id = '".$latestId."'");
					unset($sqlUploadFIle);
					$mode = '0644';
					move_uploaded_file($_FILES['file']['tmp_name'],$originalFile);
					chmod ($originalFile, octdec($mode));
				}
			}
			
			$remarks = 'Add Report #:'.$latestId;
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
			header("Location: reports.php", true, 301);
			exit();
		}
	}
}

// EDIT RECORD
if(isset($_POST['submit_edit'])) {

	$condition	=	array ( 
							'select' 	=> "id",
							'where' 	=> array( 
													 'title'		=>	cleanvars($_POST['title'])
													,'type'			=>	cleanvars($_POST['type'])
													,'is_deleted'	=>	'0'	
												),
							'not_equal' 	=> array( 
													'id'			=>	cleanvars($_POST['id'])
												),					
							'return_type' 	=> 'count' 
							); 
	if($dblms->getRows(REPORTS_DOWNLOADS, $condition)) {
		$_SESSION['msg']['title'] 	= 'Error';
		$_SESSION['msg']['text'] 	= 'Record Already Exists';
		$_SESSION['msg']['type'] 	= 'error';
		header("Location: reports.php", true, 301);
		exit();
	}else{	
		$values = array(
							 'status'			=>	cleanvars($_POST['status'])
							,'type'				=>	cleanvars($_POST['type'])
							,'title'			=>	cleanvars($_POST['title'])
							,'id_modify'		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							,'date_modify'		=>	date('Y-m-d G:i:s')
						); 
		$sqllms = $dblms->Update(REPORTS_DOWNLOADS , $values , "WHERE id  = '".cleanvars($_POST['id'])."'");
		if($sqllms) {
			$latestId = $_POST['id'];

			// FILE
			if(!empty($_FILES['file']['name'])) {
				$path_parts 	= pathinfo($_FILES["file"]["name"]);
				$extension 		= strtolower($path_parts['extension']);
				if(in_array($extension , array('pdf'))) {
					$fileDir 		= 'uploads/files/reports/';
					$fileName		= to_seo_url($_POST['title'].'-'.$_POST['type'].'-'.$latestId).'.'.$extension;
					$originalFile	= $fileDir.$fileName;
					$valuesFile = array(
										'file'	=>	$fileName, 
										);
					$sqlUploadFIle = $dblms->Update(REPORTS_DOWNLOADS, $valuesFile, "WHERE id = '".$latestId."'");
					unset($sqlUploadFIle);
					$mode = '0644';
					move_uploaded_file($_FILES['file']['tmp_name'],$originalFile);
					chmod ($originalFile, octdec($mode));
				}
			}

			$remarks = 'Update Reports #:'.cleanvars($latestId);
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
			header("Location: reports.php", true, 301);
			exit();
		}
	}
}

// DELETE RECORD
if(isset($_GET['deleteid'])) {	
	$latestId = $_GET['deleteid'];
	
	$values = array(
						 'id_deleted'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,'is_deleted'	=>	'1'
						,'ip_deleted'	=>	cleanvars($ip)
						,'date_deleted'	=>	date('Y-m-d G:i:s')
					);   

	$sqlDel = $dblms->Update(REPORTS_DOWNLOADS , $values , "WHERE id  = '".cleanvars($latestId)."'");

	if($sqlDel) { 
		$remarks = 'Delete Region#:'.cleanvars($latestId);
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
		header("Location: reports.php", true, 301);
		exit();
	}
}
?>