<?php
    echo '
    <div class="modal fade"  id="deleteBank">
        <div class="modal-dialog modal-dialog-centered text-center" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-body text-center p-4">
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
                    <i class="ti-trash fs-65 text-danger lh-1 mb-5 d-inline-block" style="font-size:3rem;"></i>
                    <form action="banks.php" autocomplete="off"enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        <input type="hidden" name="bank_id" id="bank_id_del" >
                        <h4 class="text-danger">Are you Sure You want to Remove this Record !</h4>
                        <br>
                        <button type="submit" name="submit_delete" class="btn w-sm btn-danger" >Yes, Delete It!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            //---edit item link clicked-------
            $(".deleteBankModel").click(function(){
                //get variables from "edit link" data attributes
                var item_id_edit = $(this).attr("data-item-id");
                //set modal input values dynamically
                $("#bank_id_del").val(item_id_edit);
            }); 
        });
    </script>';
?>