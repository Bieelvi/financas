<?php require_once __DIR__ . '/../Header.php'; ?>

<section class="container mt-3" data-bs-theme="dark">
    <div class="mb-3">
        <h1>Produtos</h1>
    </div>

    <form action="/products/store" method="post">
        <div class="row mb-3">
            <div class="col-4">
                <label for="product-name" class="form-label"><?= translate('Product name') ?></label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="product-name" 
                    name="product-name" 
                    placeholder="<?= translate('Exemple card credit') ?>"
                >
            </div>
        </div>

        <button type="submit" class="btn btn-outline-light"><?= translate('Register') ?></button>
    </form>
</section>

<?php require_once __DIR__ . '/List.php'; ?>

<?php require_once __DIR__ . '/../Footer.php'; ?>