<?php 
    if (isset($params['product_id'])) {
        $productArray = array_filter($products, fn($p) => $p->getId() == $params['product_id']);
        $productParam = $productArray[array_key_first($productArray)];
    }
?>

<div class="collapse my-2" id="collapseFilter">
    <div class="card card-body">
        <form action="/farmer" method="get">
            <div class="row mb-3">
                <div class="col-12 col-md-6 col-lg-2 mb-2">
                    <label for="product_id" class="form-label"><?= translate('Product') ?></label>
                    <select class="form-select" id="product_id" name="product_id">
                        <?php if (isset($params['product_id'])) : ?>
                            <option value="<?= $productParam->getId() ?>">
                                <?= $productParam->getName() ?>
                            </option>
                        <?php else : ?>
                            <option selected disabled value><?= translate('Select a product') ?></option>
                        <?php endif; ?>

                        <?php foreach ($products as $product) : ?>
                            <option value="<?= $product->getId() ?>"><?= $product->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-12 col-md-6 col-lg-2 mb-2">
                    <label for="type" class="form-label"><?= translate('Type') ?></label>
                    <select class="form-select" id="type" name="type">
                        <?php if (isset($params['type'])) : ?>
                            <option value="<?= $params['type'] ?>"><?= $params['type'] ?></option>
                        <?php else : ?>
                            <option selected disabled value><?= translate('Select a type') ?></option>
                        <?php endif; ?>

                        <?php foreach (\Financas\Enum\ProductType::cases() as $type) : ?>
                            <option value="<?= $type->value ?>"><?= translate($type->value) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-12 col-md-6 col-lg-2 mb-2">
                    <label for="initial_value" class="form-label"><?= translate('Initial value') ?></label>
                    <input 
                        type="number" 
                        step="0.01" 
                        class="form-control" 
                        id="initial_value" 
                        name="initial_value" 
                        placeholder="<?= translate('Exemple 100') ?>" 
                        value="<?= isset($params['initial_value']) ? $params['initial_value'] : null ?>"
                    >
                </div>

                <div class="col-12 col-md-6 col-lg-2 mb-2">
                    <label for="final_value" class="form-label"><?= translate('Final value') ?></label>
                    <input 
                        type="number" 
                        step="0.01" 
                        class="form-control" 
                        id="final_value" 
                        name="final_value" 
                        placeholder="<?= translate('Exemple 200') ?>" 
                        value="<?= isset($params['final_value']) ? $params['final_value'] : null ?>"
                    >
                </div>

                <div class="col-12 col-md-6 col-lg-2 mb-2">
                    <label for="initial_date" class="form-label"><?= translate('Initial date') ?></label>
                    <input 
                        type="date" 
                        class="form-control" 
                        id="initial_date" 
                        name="initial_date" 
                        value="<?= isset($params['initial_date']) ? $params['initial_date'] : null ?>"
                    >
                </div>

                <div class="col-12 col-md-6 col-lg-2 mb-2">
                    <label for="final_date" class="form-label"><?= translate('Final date') ?></label>
                    <input 
                        type="date" 
                        class="form-control" 
                        id="final_date" 
                        name="final_date" 
                        value="<?= isset($params['final_date']) ? $params['final_date'] : null ?>"
                    >
                </div>
            </div>
            <button type="submit" class="btn btn-outline-light"><?= translate('Search') ?></button>
        </form>
    </div>
</div>