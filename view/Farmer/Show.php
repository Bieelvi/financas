<?php require_once __DIR__ . '/../Header.php'; ?>

<section id="<?= $pageName ?>" class="container mt-3" data-bs-theme="dark">
    <div class="mb-3">
        <h1>Editar <?= $farmer->getProduct()->getName() ?></h1>
    </div>

    <?php require_once __DIR__ . '/Form.php'; ?>
</section>

<?php require_once __DIR__ . '/../Footer.php'; ?>