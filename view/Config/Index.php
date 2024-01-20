<?php require_once __DIR__ . '/../Header.php'; ?>

<section id="config-index" class="container mt-3" data-bs-theme="dark">

    <div class="mb-3">
        <h1><?= translate("Configurations") ?></h1>
    </div>

    <?php require_once __DIR__ . '/Form.php'; ?>

</section>

<script>
    const configIndex = $("#config-index");

    resizeWidth(configIndex);

    $(window).on("resize", function() {
        resizeWidth(configIndex);
    });
</script>

<?php require_once __DIR__ . '/../Footer.php'; ?>