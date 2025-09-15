<?php
    // ADD PRODUCT CATEGORY
	if(isset($_POST['submit_add'])) {

		$condition	=	array ( 
								'select' 	=>	'cat_id',
								'where' 	=>	array( 
														'cat_name'	=>	cleanvars($_POST['cat_name'])
														,'is_deleted'	=>	'0'
													),
								'return_type' 	=> 'count'
							); 
		if($dblms->getRows(PRODUCT_CAT, $condition)) {
			// alert_msg('error', 'Error', 'Record Already Exists');
			header("Location: product_categories.php", true, 301);
			exit();
		}else{
			$values = array(
								'cat_name'			=>	cleanvars($_POST['cat_name'])
								,'cat_code'			=>	cleanvars($_POST['cat_code'])
								,'cat_description'	=>	cleanvars($_POST['cat_description'])
								,'cat_status'		=>	cleanvars($_POST['cat_status'])
								,'id_added'			=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_added'		=>	date('Y-m-d H:i:s')
							); 
			
			$sqllms		= 	$dblms->insert(PRODUCT_CAT, $values);

			if($sqllms) { 

				$idLatest	=	$dblms->lastestid();

				$remarks = 'Add Product Category#:'.$idLatest;
				$values = array (
									"id_user"	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
									,"filename"	=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
									,"action"	=>	'1'
									,"dated"	=>	date('Y-m-d h:i:s')
									,"ip"		=>	cleanvars($ip)
									,"remarks"	=>	cleanvars($remarks)
								);
				$sqllms  = $dblms->insert(LOGS, $values);
				// alert_msg('success', 'Success', 'City added Successfully.');
				header("Location: product_categories.php", true, 301);
				exit();
			}
		}
	}

    // EDIT PRODUCT CATEGORY
	if(isset($_POST['submit_edit'])) {

		$condition	=	array ( 
								'select' 	=> "cat_id",
								'where' 	=> array( 
														'cat_name'		=>	cleanvars($_POST['cat_name'])
														,'is_deleted'	=>	'0'
													),
								'not_equal' 	=> array( 
														'cat_id'		=>	cleanvars($_POST['cat_id'])
													),					
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(PRODUCT_CAT, $condition)) {
			// alert_msg('error', 'Error', 'Record Already Exists');
			header("Location: product_categories.php", true, 301);
			exit();
		}else{
			$values = array(
								'cat_name'			=>	cleanvars($_POST['cat_name'])
								,'cat_code'			=>	cleanvars($_POST['cat_code'])
								,'cat_description'	=>	cleanvars($_POST['cat_description'])
								,'cat_status'		=>	cleanvars($_POST['cat_status'])
								,'id_modified'		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_modified'	=>	date('Y-m-d H:i:s')

							);   
			$sqllms = $dblms->Update(PRODUCT_CAT , $values , "WHERE cat_id  = '".cleanvars($_POST['cat_id'])."'");

			if($sqllms) { 

				$idLatest	=	$_POST['cat_id'];

				$remarks = 'Update Product Category#:'.cleanvars($idLatest);
				$values = array (
				  "id_user"		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
				  ,"filename"	=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
				  ,"action"		=>	'2'
				  ,"dated"		=>	date('Y-m-d h:i:s')
				  ,"ip"			=>	cleanvars($ip)
				  ,"remarks"	=>	cleanvars($remarks)
				);
				$sqllms  = $dblms->insert(LOGS, $values);
				// alert_msg('success', 'Success', 'City Updated Successfully.');
				header("Location: product_categories.php", true, 301);
				exit();
			}
		}		
	}

	// DELETE PRODUCT CATEGORY
	if(isset($_POST['submit_delete'])) {
		
		$values = array(
						'id_deleted'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,'is_deleted'	=>	'1'
						,'ip_deleted'	=>	cleanvars($ip)
						,'date_deleted'	=>	date('Y-m-d H:i:s')

					   );   
		$sqlDel = $dblms->Update(PRODUCT_CAT , $values , "WHERE cat_id  = '".cleanvars($_POST['cat_id'])."'");

		if($sqlDel) { 
			$remarks = 'Delete Product Category#:'.cleanvars($_POST['cat_id']);
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
			// alert_msg('success', 'Success', 'State deleted Successfully.');
			header("Location: product_categories.php", true, 301);
			exit();
		}
	}
?>