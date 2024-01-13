<?php require_once __DIR__ . '/../Header.php'; ?>

<section id="profile-index" class="container mt-3" data-bs-theme="dark">
    
    <div class="mb-3">
        <h1><?= translate("User profile") ?></h1>
    </div>

    <?php require_once __DIR__ . '/Email.php' ?>

    <?php require_once __DIR__ . '/Password.php' ?>

</section>

<script>
    const profileIndex = $("#profile-index");

    resizeWidth(profileIndex);

    $(window).on("resize", function() {
        resizeWidth(profileIndex);
    });
</script>

<?php require_once __DIR__ . '/../Footer.php'; ?>