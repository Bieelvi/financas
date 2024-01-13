<div id="profile-email mb-3">
    <div class="d-flex justify-content-between align-items-center mb-1">
        <h4>Email</h4>

        <button 
            type="button" 
            class="btn btn-outline-light" 
            data-bs-toggle="collapse" 
            data-bs-target="#collapseEmail" 
            aria-expanded="false" 
            aria-controls="collapseEmail"
        >
            <?= translate("Change") ?>
        </button>
    </div>

    <div class="collapse my-2" id="collapseEmail">
        <div class="card card-body">
            <div class="mb-2">
                <input type="email" id="email" class="form-control" disabled value="<?= $user->getEmail() ?>">
            </div>

            <?php if (!$user->getValidateEmail()) : ?>
                <div class="d-flex align-items-end">
                    <button type="submit" id="validate" class="btn btn-outline-light">
                        <?= translate("Validate") ?>
                    </button>

                    <button id="loading-validate" type="submit" id="validate" disabled class="d-none btn btn-outline-light">
                        <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                        <span role="status"><?= translate("Validating") ?>...</span>
                    </button>
                </div>
            <?php else : ?>
                <div class="mb-2">
                    <input type="email" id="new-email" email class="form-control" placeholder="<?= translate("New email") ?>">
                </div>

                <div class="mb-2">
                    <input type="password" password id="password" class="form-control d-none" placeholder="<?= translate("Password") ?>">
                </div>

                <div class="d-flex align-items-end">
                    <button type="submit" id="update-email" disabled class="btn btn-outline-light">
                        <?= translate("Update email") ?>
                    </button>

                    <button id="loading-email" type="submit" id="validate" disabled class="d-none btn btn-outline-light">
                        <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                        <span role="status"><?= translate("Updating") ?>...</span>
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    function toggleSpinningEmail() {
        $("#update-email").toggleClass("d-none");
        $("#loading-email").toggleClass("d-none");
    }

    function toggleSpinningValidate() {
        $("#validate").toggleClass("d-none");
        $("#loading-validate").toggleClass("d-none");
    }

    function blockedUpdateEmail() {
        const newEmail    = $("#new-email");
        const updateEmail = $("#update-email");
        const password    = $("#password");

        if (newEmail.val().length <= 0) {
            updateEmail.attr("disabled", "disabled");
            password.addClass("d-none");
        } else {
            updateEmail.removeAttr("disabled", "disabled");
            password.removeClass("d-none");
        }
    }

    $("#validate").on("click", function() {
        toggleSpinningValidate();

        $.get("/validate-email").done(function(data) {
            const objectSuccess = JSON.parse(data);

            document.querySelectorAll("[email]").forEach(element => {
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
            toggleSpinningValidate();

            $("#update-password").removeAttr("disabled", "disabled");

            setTimeout(() => {
                hideMessage();
            }, 5000);
        });
    });

    $("#new-email").on("input", function() {
        blockedUpdateEmail();
    });

    $("#update-email").click(function() {
        toggleSpinningEmail();

        const newEmail = $("#new-email");
        const password = $("#password");

        $.post("/update-email", {
            newEmail: newEmail.val(),
            password: password.val()
        }).done(function(data) {
            const objectSuccess = JSON.parse(data);

            $("#email").val(newEmail.val());

            document.querySelectorAll("[email]").forEach(element => {
                element.value = '';
            });

            document.querySelectorAll("[password]").forEach(element => {
                element.value = '';
            });

            blockedUpdateEmail();

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
            toggleSpinningEmail();

            setTimeout(() => {
                hideMessage();
            }, 5000);
        });
    });
</script>