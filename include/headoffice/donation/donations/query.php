<?php
    // ADD DONATION
	if(isset($_POST['submit_add'])) {

			$values = array(
							 'status'			=>	cleanvars($_POST['status'])
							,'id_type'			=>	'3'
							,'is_by_portal'		=>	'1'
							,'id_pc_subcat' 	=>	cleanvars($_POST['id_pc_subcat'])
							,'dated' 			=>	date('Y-m-d')
							,'id_donor' 		=>	cleanvars($_POST['id_donor'])
							,'referrals' 		=>	cleanvars($_POST['referrals'])
							,'amount' 			=>	cleanvars($_POST['amount'])
							,'id_added'			=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							,'date_added'		=>	date('Y-m-d H:i:s')
						   ); 
			
			$sqllms		=	$dblms->insert(DONATIONS, $values);

			if($sqllms) { 

				$id    =	$dblms->lastestid();
				$randString = substr(bin2hex(random_bytes(8)), 0, 8);
				if(!empty($_FILES['image']['name'])) {

					$path_parts 	= pathinfo($_FILES["image"]["name"]);
					$extension 		= strtolower($path_parts['extension']);
					if(in_array($extension , array('jpeg','jpg', 'png', 'JPEG', 'JPG', 'PNG'))) {
						$img_dir 		= 'uploads/images/donation_slips/';
						$originalImage	= $img_dir.to_seo_url(cleanvars($randString)).'-'.$id.".".($extension);
						$img_fileName	= to_seo_url(cleanvars($randString)).'-'.$id.".".($extension);
						$dataImage = array(
											'image'	=>	$img_fileName, 
										  );
						$sqllmsUpdateCNIC = $dblms->Update(DONATIONS, $dataImage, "WHERE id = '".$id."'");
						
						unset($sqllmsUpdateCNIC);
						$mode = '0644';
						move_uploaded_file($_FILES['image']['tmp_name'],$originalImage);
						chmod ($originalImage, octdec($mode));
					}
	
				}

				$remarks = 'Add Donation#:'.$id ;
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
				header("Location: donations.php", true, 301);
				exit();
			}
	}

    // EDIT DONATION
	if(isset($_POST['submit_edit'])) {

			$values = array(
								'status'			=>	cleanvars($_POST['status'])
								,'id_type'			=>	'3'
								,'is_by_portal'		=>	'1'
								,'id_pc_subcat' 	=>	cleanvars($_POST['id_pc_subcat'])
								,'dated' 			=>	date('Y-m-d')
								,'id_donor' 		=>	cleanvars($_POST['id_donor'])
								,'referrals' 		=>	cleanvars($_POST['referrals'])
								,'amount' 			=>	cleanvars($_POST['amount'])
								,'id_modify'		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_modify'		=>	date('Y-m-d H:i:s')
						   ); 
		
			$sqllms = $dblms->Update(DONATIONS , $values , "WHERE id = '".cleanvars($_POST['id'])."'");

			if($sqllms) {
				
				if(!empty($_FILES['image']['name'])) {
					$randString = substr(bin2hex(random_bytes(8)), 0, 8);
					$path_parts 	= pathinfo($_FILES["image"]["name"]);
					$extension 		= strtolower($path_parts['extension']);
					if(in_array($extension , array('jpeg','jpg', 'png', 'JPEG', 'JPG', 'PNG'))) {
						$img_dir 		= 'uploads/images/donation_slips/';
						$originalImage	= $img_dir.to_seo_url(cleanvars($randString)).'-'.$_POST['id'].".".($extension);
						$img_fileName	= to_seo_url(cleanvars($randString)).'-'.$_POST['id'].".".($extension);
						$dataImage = array(
											'image'	=>	$img_fileName, 
										  );
						$sqllmsUpdateCNIC = $dblms->Update(DONATIONS, $dataImage, "WHERE id = '".$_POST['id']."'");
						
						unset($sqllmsUpdateCNIC);
						$mode = '0644';
						move_uploaded_file($_FILES['image']['tmp_name'],$originalImage);
						chmod ($originalImage, octdec($mode));
					}
	
				} 
				
				$remarks = 'Update Donation#:'.cleanvars($_POST['id']);
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
				header("Location: donations.php", true, 301);
				exit();
			}

		
	}

	// DELETE DONATION
	if(isset($_GET['deleteid'])) {
		
		$values = array(
						 'id_deleted'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,'is_deleted'	=>	'1'
						,'ip_deleted'	=>	cleanvars($ip)
						,'date_deleted'	=>	date('Y-m-d H:i:s')
					   );   

		$sqlDel = $dblms->Update(DONATIONS , $values , "WHERE id  = '".cleanvars($_GET['deleteid'])."'");

		if($sqlDel) { 
			$remarks = 'Delete Donation#:'.cleanvars($_GET['deleteid']);
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
			header("Location: donations.php", true, 301);
			exit();
		}
	}
?>