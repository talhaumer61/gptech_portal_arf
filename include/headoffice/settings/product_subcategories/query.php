<?php
    // ADD PRODUCT SUB CATEGORY
	if(isset($_POST['submit_add'])) {

		$condition	=	array ( 
								'select' 	=>	'subcat_id',
								'where' 	=>	array( 
														'subcat_name'	=>	cleanvars($_POST['subcat_name'])
														,'is_deleted'	=>	'0'
													),
								'return_type' 	=> 'count'
							); 
		if($dblms->getRows(PRODUCT_SUBCAT, $condition)) {
			// alert_msg('error', 'Error', 'Record Already Exists');
			header("Location: product_subcategories.php", true, 301);
			exit();
		}else{
			$values = array(
								'subcat_name'			=>	cleanvars($_POST['subcat_name'])
								,'subcat_code'			=>	cleanvars($_POST['subcat_code'])
								,'subcat_description'	=>	cleanvars($_POST['subcat_description'])
								,'id_cat'				=>	cleanvars($_POST['id_cat'])
								,'subcat_status'		=>	cleanvars($_POST['subcat_status'])
								,'id_added'				=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_added'			=>	date('Y-m-d H:i:s')
							); 
			
			$sqllms		= 	$dblms->insert(PRODUCT_SUBCAT, $values);

			if($sqllms) { 

				$idLatest	=	$dblms->lastestid();

				$remarks = 'Add Product Sub Category#:'.$idLatest;
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
				header("Location: product_subcategories.php", true, 301);
				exit();
			}
		}
	}

    // EDIT PRODUCT SUB CATEGORY
	if(isset($_POST['submit_edit'])) {

		$condition	=	array ( 
								'select' 	=> "subcat_id",
								'where' 	=> array( 
														'subcat_name'		=>	cleanvars($_POST['subcat_name'])
														,'is_deleted'	=>	'0'
													),
								'not_equal' 	=> array( 
														'subcat_id'		=>	cleanvars($_POST['subcat_id'])
													),					
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(PRODUCT_SUBCAT, $condition)) {
			// alert_msg('error', 'Error', 'Record Already Exists');
			header("Location: product_subcategories.php", true, 301);
			exit();
		}else{
			$values = array(
								'subcat_name'			=>	cleanvars($_POST['subcat_name'])
								,'subcat_code'			=>	cleanvars($_POST['subcat_code'])
								,'subcat_description'	=>	cleanvars($_POST['subcat_description'])
								,'id_cat'				=>	cleanvars($_POST['id_cat'])
								,'subcat_status'		=>	cleanvars($_POST['subcat_status'])
								,'id_modified'			=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_modified'		=>	date('Y-m-d H:i:s')

							);   
			$sqllms = $dblms->Update(PRODUCT_SUBCAT , $values , "WHERE subcat_id  = '".cleanvars($_POST['subcat_id'])."'");

			if($sqllms) { 

				$idLatest	=	$_POST['subcat_id'];

				$remarks = 'Update Product Sub Category#:'.cleanvars($idLatest);
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
				header("Location: product_subcategories.php", true, 301);
				exit();
			}
		}		
	}

	// DELETE PRODUCT SUB CATEGORY
	if(isset($_POST['submit_delete'])) {
		
		$values = array(
						'id_deleted'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,'is_deleted'	=>	'1'
						,'ip_deleted'	=>	cleanvars($ip)
						,'date_deleted'	=>	date('Y-m-d H:i:s')

					   );   
		$sqlDel = $dblms->Update(PRODUCT_SUBCAT , $values , "WHERE subcat_id  = '".cleanvars($_POST['subcat_id'])."'");

		if($sqlDel) { 
			$remarks = 'Delete Product Sub Category#:'.cleanvars($_POST['subcat_id']);
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
			header("Location: product_subcategories.php", true, 301);
			exit();
		}
	}
?>