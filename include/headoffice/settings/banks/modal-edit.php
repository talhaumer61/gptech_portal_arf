<?php 
    echo '
    <!-- MODAL EFFECTS -->
    <div class="modal fade"  id="editBank">
        <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
            <div class="modal-content modal-content-demo expanel expanel-info">
                <div class="modal-header expanel-heading">
                    <h6 class="modal-title">Edit Bank</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="banks.php" autocomplete="off" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <div class="modal-body expanel-body text-start">
                        <div class="form-group">
                            <label class="form-label" for="card-name">Bank Name</label>
                            <input type="hidden" name="bank_id" id="bank_id_edit" required>
                            <input class="form-control" type="text" name="bank_name" id="bank_name_edit" placeholder="Enter Name" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="card-name">Bank Code</label>
                            <input class="form-control" name="bank_code" id="bank_code_edit" type="text" placeholder="Enter Code" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Staus</label>
                            <select class="form-control select2-show-search form-select" name="bank_status" id="bank_status_edit" data-placeholder="Choose one">
                                <option label="Choose one"></option>';
                                foreach($status as $stats):
                                    echo '
                                    <option value="'.$stats['id'].'">'.$stats['name'].'</option>';
                                endforeach;
                                echo '
                            </select>
                        </div>
                    </div>
                    <div class="expanel-footer modal-footer">
                        <button type="submit" class="btn btn-info" name="submit_edit" >Edit Bank</button> 
                        <a class="btn btn-danger" data-bs-dismiss="modal" >Close</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            //---edit item link clicked-------
            $(".editBankModel").click(function(){
            
                //get variables from "edit link" data attributes
                
                var item_name_edit      =   $(this).attr("data-item-name");
                var item_code_edit	    =   $(this).attr("data-item-code");
                var item_status_edit    =   $(this).attr("data-item-status");
                var item_id_edit        =   $(this).attr("data-item-id");


                //set modal input values dynamically
                $("#bank_id_edit").val(item_id_edit);
                $("#bank_name_edit").val(item_name_edit);
                $("#bank_code_edit").val(item_code_edit);

                //pre-select data in pull down lists
                $("#bank_status_edit").select2().select2("val", item_status_edit);
            }); 
        });
    </script>
    ';
?>
