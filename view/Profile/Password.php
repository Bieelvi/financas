<div class="profile-password mb-3">
    <div class="d-flex justify-content-between align-items-center mb-1">
        <h4>Password</h4>

        <button 
            type="button" 
            class="btn btn-outline-light" 
            data-bs-toggle="collapse" 
            data-bs-target="#collapsePassword" 
            aria-expanded="false" 
            aria-controls="collapsePassword"
        >
            <?= translate("Change") ?>
        </button>
    </div>

    <div class="collapse my-2" id="collapsePassword">
        <div class="card card-body">
            <div class="mb-2">
                <input 
                    type="password" 
                    password 
                    id="actual-password" 
                    name="actual-password" 
                    class="form-control" 
                    placeholder="<?= translate("Actual password") ?>"
                >
            </div>

            <div class="mb-2">
                <input 
                    type="password" 
                    password 
                    id="new-password" 
                    name="new-password" 
                    class="form-control" 
                    placeholder="<?= translate("New password") ?>"
                >
            </div>

            <div class="mb-2">
                <input 
                    type="password" 
                    password 
                    id="repeat-new-password" 
                    name="repeat-new-password" 
                    class="form-control" 
                    placeholder="<?= translate("Repeat new password") ?>"
                >

                <div class="d-flex justify-content-between">
                    <small class="cursor-pointer" id="show-password"><?= translate("Show password") ?></small>
                    <small class="text-danger d-none" id="not-match"><?= translate("Passwords do not match") ?></small>
                </div>
            </div>


            <div class="d-flex align-items-end">
                <button type="submit" id="update-password" disabled class="btn btn-outline-light">
                    <?= translate("Update password") ?>
                </button>

                <button id="loading-password" type="submit" id="validate" disabled class="d-none btn btn-outline-light">
                    <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                    <span role="status"><?= translate("Updating") ?>...</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function blockedUpdatePassword() {
        const newPassword       = $("#new-password");
        const repeatNewPassword = $("#repeat-new-password");
        const notMatch          = $("#not-match");
        const updatePassword    = $("#update-password");

        if ((newPassword.val() != repeatNewPassword.val()) || newPassword.val().length <= 0 || repeatNewPassword.val().length <= 0) {
            disableButtonPassword(true, updatePassword, notMatch, repeatNewPassword);
        } else {
            disableButtonPassword(false, updatePassword, notMatch, repeatNewPassword);
        }
    }   

    function toggleSpinningPassword() {
        $("#update-password").toggleClass("d-none");
        $("#loading-password").toggleClass("d-none");
    }

    $("#repeat-new-password").on("input", function() {
        blockedUpdatePassword();
    })
    
    $("#new-password").on("input", function() {
        blockedUpdatePassword();
    })

    $("#update-password").on("click", function() {
        $("#update-password").attr("disabled", "disabled");

        toggleSpinningPassword();

        const actualPassword     = $("#actual-password");
        const newPassword        = $("#new-password");

        $.post("/update-password", {
            actualPassword: actualPassword.val(),
            newPassword: newPassword.val()
        }).done(function(data) {
            const objectSuccess = JSON.parse(data);

            document.querySelectorAll("[password]").forEach(element => {
                element.value = '';
            });

            showMessage(
                'success',
                objectSuccess.data
            );
        }).fail(function(data) {
            const objectError = JSON.parse(data.responseText);

            showMessage(
                'danger',
                objectError.data
            );
        }).always(function() {
            toggleSpinningPassword();
            
            setTimeout(() => {
                hideMessage();
            }, 5000);
        });
    });
</script>