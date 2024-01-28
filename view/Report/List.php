<section class="container mt-3" data-bs-theme="dark">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3><?= translate(ucfirst((string) $filterPeriod)."s") ?></h3>

        <div class="d-flex gap-1">
            <?php if (count($params) > 0) : ?>
                <form action="/report" method="get">
                    <button type="submit" class="btn btn-outline-light"><?= translate("Clean filter") ?></button>
                </form>
            <?php endif; ?>

            <button 
                type="button" 
                class="btn btn-outline-light" 
                data-bs-toggle="collapse" 
                data-bs-target="#collapseFilter" 
                aria-expanded="false" 
                aria-controls="collapseFilter"
            >
                <?= translate("Filter") ?>
            </button>
        </div>
    </div>

    <?php require_once __DIR__ . '/Filter.php' ?>

    <div class="table-responsive">
        <table class="table table-hover table-striped text-center">
            <thead>
                <tr>
                    <th scope="col"><?= translate(ucfirst((string) $filterPeriod)) ?></th>
                    <th scope="col"><?= translate("Value") ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($farmers as $key => $value) : ?>
                    <tr>
                        <td><?= $key ?></td>
                        <td class="<?= $value > 0 ? 'text-success' : 'text-danger' ?>">
                            <?= $value > 0 ?
                                '+' . \Financas\Helper\Format::float($value) :
                                \Financas\Helper\Format::float($value)
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>