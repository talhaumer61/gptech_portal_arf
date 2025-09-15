<?php
    echo '
    <div class="modal fade"  id="deleteModel">
        <div class="modal-dialog modal-dialog-centered text-center" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-body text-center p-4">
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
                    <i class="ti-trash fs-65 text-danger lh-1 mb-5 d-inline-block" style="font-size:3rem;"></i>
                    <form action="applicants.php" autocomplete="off"enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        <input type="hidden" name="ap_id" id="ap_id_del" >
                        <h4 class="text-danger">Are you Sure You want to Remove this Record...!</h4>
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
            $(".deleteModelClass").click(function(){
                //get variables from "delete link" data attributes
                var ap_id = $(this).attr("data-ap-id");
                //set modal input values dynamically
                $("#ap_id_del").val(ap_id);
            }); 
        });
    </script>';
?>