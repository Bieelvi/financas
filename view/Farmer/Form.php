<form action="<?= isset($edit) ? '/farmer/edit' : '/farmer/store' ?>" method="post">
    <div class="row mb-3">
        <?php if (isset($edit)) : ?>
            <div class="d-none">
                <input type="number" id="id" name="id" value="<?= $farmer->getId() ?>">
            </div>
        <?php endif; ?>

        <div class="col">
            <label for="product" class="form-label">Product</label>
            <select class="form-select" id="product" name="product">
                <?php if (isset($edit)) : ?>
                    <option value="<?= $farmer->getProduct()->getId() ?>"><?= $farmer->getProduct()->getName() ?></option>
                <?php else : ?>
                    <option selected disabled value></option>
                <?php endif; ?>

                <?php foreach ($products as $product) : ?>
                    <option value="<?= $product->getId() ?>"><?= $product->getName() ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col">
            <label for="product-type" class="form-label">Product type</label>
            <select class="form-select" id="product-type" name="product-type">
                <?php if (isset($edit)) : ?>
                    <option value="<?= $farmer->getType() ?>"><?= $farmer->getType() ?></option>
                <?php else : ?>
                    <option selected disabled value></option>
                <?php endif; ?>

                <?php foreach (\Financas\Enum\ProductType::cases() as $type) : ?>
                    <option value="<?= $type->value ?>"><?= $type->value ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col">
            <label for="product-value" class="form-label">Product value</label>
            <input type="number" step="0.01" class="form-control" id="product-value" name="product-value" value="<?= isset($edit) ? $farmer->getValue() : null ?>">
        </div>

        <div class="col">
            <label for="product-date" class="form-label">Product date</label>
            <input type="date" class="form-control" id="product-date" name="product-date" value="<?= isset($edit) ? $farmer->getDate()->format('Y-m-d') : null ?>">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <label for="product-observation" class="form-label">Observation</label>
            <div class="form-floating">
                <textarea class="form-control" id="product-observation" name="product-observation" style="height: 100px;"><?= isset($edit) ? $farmer->getObservation() : null ?></textarea>
                <label for="product-observation">Observations</label>
            </div>
        </div>
    </div>

    <div class="d-flex gap-1">
        <?php if (isset($edit)) : ?>
            <a class="btn btn-outline-danger" href="/farmer">Back</a>
        <?php endif; ?>

        <button type="submit" class="btn btn-outline-success"><?= isset($edit) ? 'Edit' : 'Register' ?></button>
    </div>
</form>