<?php
    // Create Single Installemt Challan
    if(isset($_POST['create_single_challan'])) { 

        //If Applicant ID 
        if(isset($_POST['id_applicant'])) {

			$total  =  array_sum($_POST['challan_heads']);

			$month	=  $_POST['id_month'];
			$date	=  date("d",strtotime($_POST['installment_due_date']));
			
        
            $yearmonth 	 = date('Y').'-'.$month;
            $dueDate 	 = date('Y').'-'.$month.'-'.$date;
            $issueDate 	 = date('Y-m-d' , strtotime($_POST['issue_date']));

			$challanDate = substr(date('Y'),2,4);
            //Generate Challan Number
            $sqllmsChallan 	= $dblms->querylms("SELECT challan_no 
                                                FROM ".CHALLANS." 
                                                WHERE challan_no LIKE '9931".$challanDate."%'  
                                                ORDER by challan_no DESC LIMIT 1 ");
            if(mysqli_num_rows($sqllmsChallan) < 1) {
                $challanNo	= '9931'.$challanDate.'00001';
            }else{
                $valueChallan = mysqli_fetch_array($sqllmsChallan);
                $challanNo = ($valueChallan['challan_no'] +1);
            }

            $values = array(
								'status'		        =>  '2' 
								,'challan_no'	        =>  $challanNo 
								,'challan_type'	        =>  '2'
								,'id_applicant'	        =>  cleanvars($_POST['id_applicant']) 
								,'id_ap_products'	    =>  cleanvars($_POST['id_ap_products']) 
								,'principal_os'		    =>  cleanvars($_POST['principal_amount']) 
								,'yearmonth'			=>  $yearmonth 
								,'installment_no'		=>  cleanvars($_POST['installment_no']) 
								,'total_amount'		    =>  cleanvars($total) 
								,'issue_date'           =>  $issueDate
								,'due_date'             =>  $dueDate
								,'id_added'             =>  cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_added'           =>  date("Y-m-d H:i:s") 
						   );

            $sqllmsInsert   =   $dblms->Insert(CHALLANS , $values);
            $latestID       =	$dblms->lastestid();

            if($sqllmsInsert) {

				//Iterate over Challan Head's Array
				for($i=1; $i<=sizeof($_POST['challan_heads']); $i++){
			
					//Check if ID item is not empty
					if(!empty($_POST['challan_heads'][$i]) && $_POST['challan_heads'][$i] > 0) {
			
						$challanParticulars = array(
														'id_challan'		=>  $latestID 
														,'id_particular'	=>  cleanvars($i) 
														,'amount'		    =>  cleanvars($_POST['challan_heads'][$i]) 
													);
						$sqllmsChallanParticulars  = $dblms->Insert(CHALLANPARTICULARS , $challanParticulars);
					}
				}

                $remarks = 'Created Challan#:'.$latestID;
                $values = array (
                    "id_user"       =>  cleanvars($_SESSION['userlogininfo']['LOGINIDA']),
                    "filename"      =>  strstr(basename($_SERVER['REQUEST_URI']), '.php', true),
                    "action"        =>  '1',
                    "dated"         =>  date('Y-m-d h:i:s'),
                    "ip"            =>  cleanvars($ip),
                    "remarks"       =>  cleanvars($remarks)
                );
                $sqllms  = $dblms->insert(LOGS, $values);
                alert_msg('success', 'Success', 'Challan Created Successfully.');
                header("Location: challans.php", true, 301);
                exit();
            }

        } else{

            //Set Error MSG in Session & Exit
            alert_msg('error', 'Error', 'Challan can not be created.');
            header("Location: challans.php", true, 301);
            exit();
        }
    }

    // Update Challan Details
    if(isset($_POST['update_challan'])) { 

        $total  =  array_sum($_POST['challan_heads']);

        $month	=  $_POST['id_month'];
        $date	=  date("d",strtotime($_POST['installment_due_date']));
        
    
        $yearmonth 	 = date('Y').'-'.$month;
        $dueDate 	 = date('Y').'-'.$month.'-'.$date;

        

        $values = array(
                        'status'		        =>  cleanvars($_POST['status'])
                        ,'id_ap_products'	    =>  cleanvars($_POST['id_ap_products']) 
                        ,'principal_os'		    =>  cleanvars($_POST['principal_amount']) 
                        ,'yearmonth'			=>  $yearmonth
                        ,'installment_no'		=>  cleanvars($_POST['installment_no']) 
                        ,'total_amount'		    =>  cleanvars($total)
                        ,'due_date'             =>  $dueDate
                        ,'paid_date'		    =>  cleanvars($_POST['paid_date']) 
                        ,'id_modified'          =>  cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
                        ,'date_modified'        =>  date("Y-m-d H:i:s") 
                       );
        if($_POST['status'] == 1){
            $values['paid_amount']  =   $_POST['paid_amount'];
        }
        
        $sqllmsUpdateChallan = $dblms->Update(CHALLANS, $values, "WHERE challan_id  = '".cleanvars($_POST['id_challan'])."'");

        if($sqllmsUpdateChallan) { 

            //Delete Challan Particulars
            $sqllmsDelChallanPar 	= $dblms->querylms("DELETE 
                                                        FROM ".CHALLANPARTICULARS." 
                                                        WHERE id_challan = '".cleanvars($_POST['id_challan'])."'");
            if($sqllmsDelChallanPar){
                //Iterate over Challan Head's Array
                for($i=1; $i<=sizeof($_POST['challan_heads']); $i++){
            
                    //Check if ID item is not empty
                    if(!empty($_POST['challan_heads'][$i]) && $_POST['challan_heads'][$i] > 0) {
            
                        $challanParticulars = array(
                                                        'id_challan'		=>  cleanvars($_POST['id_challan']) 
                                                        ,'id_particular'	=>  cleanvars($i) 
                                                        ,'amount'		    =>  cleanvars($_POST['challan_heads'][$i]) 
                                                    );
                        $sqllmsDelChallanParParticulars  = $dblms->Insert(CHALLANPARTICULARS , $challanParticulars);
                    }
                }
            }
            

            //Set Success MSG in Session & Exit
            $remarks = 'Updated Challan#:'.$_POST['id_challan'];
            $values = array (
                "id_user"       =>  cleanvars($_SESSION['userlogininfo']['LOGINIDA']),
                "filename"      =>  strstr(basename($_SERVER['REQUEST_URI']), '.php', true),
                "action"        =>  '1',
                "dated"         =>  date('Y-m-d h:i:s'),
                "ip"            =>  cleanvars($ip),
                "remarks"       =>  cleanvars($remarks)
            );
            $sqllms  = $dblms->insert(LOGS, $values);
            alert_msg('success', 'Success', 'Challan Updated Successfully.');
            header("Location: challans.php", true, 301);
            exit();
        }
    }
?>