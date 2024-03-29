<?php require_once __DIR__ . '/../Header.php'; ?>

<section id="signin-index" class="container mt-3" data-bs-theme="dark">

    <div class="mb-3">
        <h1><?= translate("Sign in our plataform") ?></h1>
    </div>

    <form action="/signin/store" method="post">
        <div class="mb-3">
            <label for="email" class="form-label"><?= translate("Email") ?></label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text color-white"><?= translate("We'll never share your email with anyone else") ?></div>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label"><?= translate("Password") ?></label>
            <input type="password" password class="form-control" id="password" name="password">
            
            <small class="cursor-pointer" id="show-password"><?= translate("Show password") ?></small>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember-password" name="remember-password">
            <label class="form-check-label" for="remember-password"><?= translate("Remember password") ?></label>
        </div>

        <button type="submit" class="btn btn-outline-light"><?= translate("Sign in") ?></button>
    </form>

</section>

<script>
    const signinIndex = $("#signin-index");

    resizeWidth(signinIndex);

    $(window).on("resize", function() {
        resizeWidth(signinIndex);
    });
</script>

<?php require_once __DIR__ . '/../Footer.php'; ?>