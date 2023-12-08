<?php if (count($products) > 0) : ?>

    <?php require_once __DIR__ . '/../Components/ConfirmModel.php'; ?>

    <section class="container mt-3" data-bs-theme="dark">
        
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Lista de produtos cadastrados</h3>

            <button type="button" class="btn btn-outline-light" data-bs-toggle="collapse" data-bs-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter">
                Filter
            </button>
        </div>

        <?php require_once __DIR__ . '/Filter.php' ?>

        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product name</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $key => $product) : ?>
                        <tr id="product-id-<?= $product->getId() ?>">
                            <th scope="row"> <?= $product->getId() ?> </th>
                            <td><?= $product->getName() ?></td>
                            <td>
                                <div class="d-flex gap-3">
                                    <a class="product-edit cursor-pointer">
                                        <i class="bi bi-pencil-square" id="<?= $product->getId() ?>"></i>
                                    </a>
                                    <a class="product-delete cursor-pointer" data-bs-toggle="modal" data-bs-target="#confirmModal">
                                        <i class="bi bi-trash" id="<?= $product->getId() ?>"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </section>

    <script>
        $(".product-delete").on("click", function(e) {
            $("#confirmModalLabel").html("Delete product");
            $("#modal-body-text").html("Are you sure you want to delete this product?");
            $("#confirm-save").attr("delete", e.target.id);
        });

        $("#confirm-save").on("click", function() {
            const productId = $(this).attr("delete");

            $.post("/products/delete", {
                id: productId
            }).done(function(data) {
                $(`#product-id-${productId}`).remove();

                const objectSuccess = JSON.parse(data);

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
                setTimeout(() => {
                    hideMessage();
                }, 5000);
            });
        });
    </script>

<?php endif; ?>