<?php require_once __DIR__ . '/../Header.php'; ?>

<section id="signup-index" class="container mt-3" data-bs-theme="dark">

    <div class="mb-3">
        <h1><?= translate("Sign up our plataform") ?></h1>
    </div>

    <form action="/user/store" method="post">
        <div class="mb-3">
            <label for="name" class="form-label"><?= translate("Nickname or fullname") ?></label>
            <input type="text" class="form-control" id="name" name="name">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label"><?= translate("Email") ?></label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text color-white"><?= translate("We'll never share your email with anyone else") ?></div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="password" class="form-label"><?= translate("Password") ?></label>
                <input type="password" password class="form-control" id="password" name="password">
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col">
                <label for="confirm-password" class="form-label"><?= translate("Confirm password") ?></label>
                <input type="password" password class="form-control" id="confirm-password" name="confirm-password">
            </div>
            
            <div class="d-flex justify-content-between">
                <small class="cursor-pointer" id="show-password"><?= translate("Show password") ?></small>
                <small class="text-danger d-none" id="not-match"><?= translate("Passwords do not match") ?></small>
            </div>
        </div>
        
        <button type="submit" id="update-password" class="btn btn-outline-light"><?= translate("Sign up") ?></button>
    </form>

</section>

<script>
    const signupIndex = $("#signup-index");

    resizeWidth(signupIndex);

    $(window).on("resize", function() {
        resizeWidth(signupIndex);
    });

    function blockedUpdatePassword() {
        const password        = $("#password");
        const confirmPassword = $("#confirm-password");
        const notMatch        = $("#not-match");
        const updatePassword  = $("#update-password");

        if ((password.val() != confirmPassword.val()) || password.val().length <= 0 || confirmPassword.val().length <= 0) {
            disableButtonPassword(true, updatePassword, notMatch, confirmPassword);
        } else {
            disableButtonPassword(false, updatePassword, notMatch, confirmPassword);
        }
    }

    $("#confirm-password").on("input", function() {
        blockedUpdatePassword();
    })
    
    $("#password").on("input", function() {
        blockedUpdatePassword();
    })
</script>

<?php require_once __DIR__ . '/../Footer.php'; ?>