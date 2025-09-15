<?php
    // ADD TEAM MEMBERS
	if(isset($_POST['submit_add'])) {

		$condition	=	array ( 
								'select' 	=> "id",
								'where' 	=> array( 
														 'full_name'	=>	cleanvars($_POST['full_name'])
														,'is_deleted'	=>	'0'	
													),
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(TEAM_MEMBERS, $condition)) {
			$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'Record Already Exists';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: team_members.php", true, 301);
			exit();
		}else{

			$values = array(
							 'status'			=>	cleanvars($_POST['status'])
							,'ordering'			=>	cleanvars($_POST['ordering'])
							,'full_name' 		=>	cleanvars($_POST['full_name'])
							,'id_des' 			=>	cleanvars($_POST['id_des'])
							,'id_added'			=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							,'date_added'		=>	date('Y-m-d H:i:s')
						   ); 

			$sqllms		=	$dblms->insert(TEAM_MEMBERS, $values);

			if($sqllms) { 

				$id  =	$dblms->lastestid();

				// PROFILE IMAGE
				if(!empty($_FILES['profile_image']['name'])) {

					$path_parts 	= pathinfo($_FILES["profile_image"]["name"]);
					$extension 		= strtolower($path_parts['extension']);
					if(in_array($extension , array('jpeg','jpg', 'png', 'JPEG', 'JPG', 'PNG'))) {
						$img_dir 		= 'uploads/images/team_members/';
						$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['full_name'])).'-'.$id.".".($extension);
						$img_fileName	= to_seo_url(cleanvars($_POST['full_name'])).'-'.$id.".".($extension);
						$dataImage = array(
											'profile_image'	=>	$img_fileName, 
										  );
						$sqllmsUpdateCNIC = $dblms->Update(TEAM_MEMBERS, $dataImage, "WHERE id = '".$id."'");
						unset($sqllmsUpdateCNIC);
						$mode = '0644';
						move_uploaded_file($_FILES['profile_image']['tmp_name'],$originalImage);
						chmod ($originalImage, octdec($mode));
					}
	
				}
				
				$remarks = 'Add Team Members#:'.$id;
				$values = array (
									"id_user"	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
									,"filename"	=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
									,"action"	=>	'1'
									,"dated"	=>	date('Y-m-d h:i:s')
									,"ip"		=>	cleanvars($ip)
									,"remarks"	=>	cleanvars($remarks)
								);
				$sqllms  = $dblms->insert(LOGS, $values);
				$_SESSION['msg']['title'] 	= 'Successfully';
				$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
				$_SESSION['msg']['type'] 	= 'success';
				header("Location: team_members.php", true, 301);
				exit();
			}
		}
	}

    // EDIT TEAM MEMBERS
	if(isset($_POST['submit_edit'])) {

		$condition	=	array ( 
								'select' 	=> "id",
								'where' 	=> array( 
														 'full_name'	=>	cleanvars($_POST['full_name'])
														,'is_deleted'	=>	'0'	
													),
								'not_equal' 	=> array( 
														'id'		=>	cleanvars($_POST['id'])
													),					
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(TEAM_MEMBERS, $condition)) {
			$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'Record Already Exists';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: team_members.php", true, 301);
			exit();
		}else{
		
			$values = array(
								 'status'			=>	cleanvars($_POST['status'])
								,'ordering'			=>	cleanvars($_POST['ordering'])
								,'full_name' 		=>	cleanvars($_POST['full_name'])
								,'id_des' 			=>	cleanvars($_POST['id_des'])
								,'id_modify'		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_modify'		=>	date('Y-m-d H:i:s')

						   ); 
			$sqllms = $dblms->Update(TEAM_MEMBERS , $values , "WHERE id  = '".cleanvars($_POST['id'])."'");
			if($sqllms) { 
				// PROFILE IMAGE
				if(!empty($_FILES['profile_image']['name'])) {

					$path_parts 	= pathinfo($_FILES["profile_image"]["name"]);
					$extension 		= strtolower($path_parts['extension']);
					if(in_array($extension , array('jpeg','jpg', 'png', 'JPEG', 'JPG', 'PNG'))) {
						$img_dir 		= 'uploads/images/team_members/';
						$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['full_name'])).'-'.$_POST['id'].".".($extension);
						$img_fileName	= to_seo_url(cleanvars($_POST['full_name'])).'-'.$_POST['id'].".".($extension);
						$dataImage = array(
											'profile_image'	=>	$img_fileName, 
										  );
						$sqllmsUpdateCNIC = $dblms->Update(TEAM_MEMBERS, $dataImage, "WHERE id = '".$_POST['id']."'");
						unset($sqllmsUpdateCNIC);
						$mode = '0644';
						move_uploaded_file($_FILES['profile_image']['tmp_name'],$originalImage);
						chmod ($originalImage, octdec($mode));
					}
	
				}
				$remarks = 'Update Team Members#:'.cleanvars($_POST['id']);
				$values = array (
									"id_user"	=>	  cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
									,"filename"	=>	  strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
									,"action"	=>	  '2'
									,"dated"	=>	  date('Y-m-d h:i:s')
									,"ip"		=>	  cleanvars($ip)
									,"remarks"	=>	  cleanvars($remarks)
								);
				$sqllLog  = $dblms->insert(LOGS, $values);
				$_SESSION['msg']['title'] 	= 'Successfully';
				$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
				$_SESSION['msg']['type'] 	= 'info';
				header("Location: team_members.php", true, 301);
				exit();
			}
		}

		
	}

	// DELETE TEAM MEMBERS
	if(isset($_GET['deleteid'])) {
		
		$values = array(
						 'id_deleted'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,'is_deleted'	=>	'1'
						,'ip_deleted'	=>	cleanvars($ip)
						,'date_deleted'	=>	date('Y-m-d H:i:s')
					   );   

		$sqlDel = $dblms->Update(TEAM_MEMBERS , $values , "WHERE id  = '".cleanvars($_GET['deleteid'])."'");

		if($sqlDel) { 
			$remarks = 'Delete Team Members#:'.cleanvars($_GET['deleteid']);
			$values = array (
								"id_user"		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,"filename"		=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
								,"action"		=>	'3'
								,"dated"		=>	date('Y-m-d h:i:s')
								,"ip"			=>	cleanvars($ip)
								,"remarks"		=>	cleanvars($remarks)
								,"id_deleted"	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,"ip_deleted"	=>	cleanvars($ip)
								,'date_deleted'	=>	date('Y-m-d H:i:s')
							);
			$sqllms  = $dblms->insert(LOGS, $values);
			$_SESSION['msg']['title'] 	= 'Warning';
			$_SESSION['msg']['text'] 	= 'Record Successfully Deleted.';
			$_SESSION['msg']['type'] 	= 'warning';
			header("Location: team_members.php", true, 301);
			exit();
		}
	}
?>