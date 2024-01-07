<div 
    class="modal fade" 
    id="confirmModal" 
    tabindex="-1" 
    aria-labelledby="confirmModalLabel" 
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background-color: rebeccapurple;">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="confirmModalLabel"></h1>
                <button 
                    type="button" 
                    class="btn-close" 
                    data-bs-dismiss="modal" 
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body text-white" id="modal-body-text">

            </div>
            <div class="modal-footer">
                <button 
                    type="button" 
                    class="btn btn-danger" 
                    data-bs-dismiss="modal"
                >
                    <?= translate("Close") ?>
                </button>
                <button 
                    type="button" 
                    class="btn btn-success" 
                    data-bs-dismiss="modal" 
                    id="confirm-save"
                >
                    <?= translate("Confirm") ?>
                </button>
            </div>
        </div>
    </div>
</div>