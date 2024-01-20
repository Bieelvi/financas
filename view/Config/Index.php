<?php require_once __DIR__ . '/../Header.php'; ?>

<section id="config-index" class="container mt-3" data-bs-theme="dark">

    <div class="mb-3">
        <h1><?= translate("Configurations") ?></h1>
    </div>

    <form action="/config/store" method="post">
        <div class="mb-3">
            <label for="language" class="form-label"><?= translate("Language") ?></label>
            <select class="form-control" name="language" id="language">
                <?php if ($user->getConfigs()) : ?>
                    <option 
                        disabled 
                        selected 
                        value="<?= $user->getConfigs()->getLanguage() ?>"
                    >
                        <?= translate($user->getConfigs()->getLanguage()) ?>
                    </option>
                <?php else : ?>
                    <option disabled selected value><?= translate('Select a language') ?></option>
                <?php endif; ?>

                <?php foreach (\Financas\Enum\Language::cases() as $language) : ?>
                    <option value="<?= $language->value ?>"><?= translate($language->value) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-outline-light"><?= translate("Save") ?></button>
    </form>

</section>

<script>
    const configIndex = $("#config-index");

    resizeWidth(configIndex);

    $(window).on("resize", function() {
        resizeWidth(configIndex);
    });
</script>

<?php require_once __DIR__ . '/../Footer.php'; ?>