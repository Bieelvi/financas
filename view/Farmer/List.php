<?php if (count($products) > 0) : ?>

    <?php require_once __DIR__ . '/../Components/ConfirmModel.php'; ?>

    <?php require_once __DIR__ . '/../Components/InformationModel.php'; ?>

    <section class="container mt-3" data-bs-theme="dark">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Lista do fazendário</h3>

            <div class="d-flex gap-1">
                <?php if (count($params) > 0) : ?>
                    <form action="/farmer" method="get">
                        <button type="submit" class="btn btn-outline-light">Clean filter</button>
                    </form>
                <?php endif; ?>

                <button type="button" class="btn btn-outline-light" data-bs-toggle="collapse" data-bs-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter">
                    Filter
                </button>
            </div>
        </div>

        <?php require_once __DIR__ . '/Filter.php' ?>

        <div class="table-responsive">
            <table class="table table-hover table-striped text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product name</th>
                        <th scope="col">Type</th>
                        <th scope="col">Value</th>
                        <th scope="col">Date</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($farmers as $key => $farmer) : ?>
                        <tr id="farmer-id-<?= $farmer->getId() ?>">
                            <th scope="row"> <?= $farmer->getId() ?> </th>
                            <td><?= $farmer->getProduct()->getName() ?></td>
                            <td><?= $farmer->getType() ?></td>
                            <td><?= $farmer->getValue(true) ?></td>
                            <td><?= $farmer->getDate()->format('d/m/Y') ?></td>
                            <td>
                                <div class="d-flex justify-content-center gap-3">
                                    <a class="farmer-observation cursor-pointer" data-bs-toggle="modal" data-bs-target="#informationModal">
                                        <i class="bi bi-card-text" observation="<?= $farmer->getObservation() ?>"></i>
                                    </a>

                                    <a class="farmer-edit cursor-pointer" href="/farmer/show?id=<?= $farmer->getId() ?>">
                                        <i class="bi bi-pencil-square" id="<?= $farmer->getId() ?>"></i>
                                    </a>

                                    <a class="farmer-delete cursor-pointer" data-bs-toggle="modal" data-bs-target="#confirmModal">
                                        <i class="bi bi-trash" id="<?= $farmer->getId() ?>"></i>
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
        $(".farmer-observation").on("click", function(e) {
            $("#informationModalLabel").html("Observation");

            let obs = e.target.getAttribute('observation');
            if (!obs) {
                obs = 'Sem nenhuma observação';
            }

            $("#modal-observation-body-text").html(obs);

        });

        $(".farmer-delete").on("click", function(e) {
            $("#confirmModalLabel").html("Delete product");
            $("#modal-body-text").html("Are you sure you want to delete this farm?");
            $("#confirm-save").attr("delete", e.target.id);
        });

        $("#confirm-save").on("click", function() {
            const productId = $(this).attr("delete");

            $.post("/farmer/delete", {
                id: productId
            }).done(function(data) {
                $(`#farmer-id-${productId}`).remove();

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
            });;
        });
    </script>

<?php endif; ?>