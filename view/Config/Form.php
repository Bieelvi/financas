<form action="/config/store" method="post">
    <div class="mb-3">
        <label for="language" class="form-label"><?= translate("Language") ?></label>
        <select class="form-control" name="language" id="language">
            <?php if ($user->getConfigs()) : ?>
                <option selected value="<?= $user->getConfigs()->getLanguage() ?>">
                    <?= translate($user->getConfigs()->getLanguage()) ?>
                </option>
            <?php else : ?>
                <option 
                    selected 
                    value="en"
                >
                    <?= translate('Select a language') ?>
                </option>
            <?php endif; ?>

            <?php foreach (\Financas\Enum\Language::cases() as $language) : ?>
                <option value="<?= $language->value ?>"><?= translate($language->value) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="theme" class="form-label"><?= translate("Theme") ?></label>
        <select class="form-control" name="theme" id="theme">
            <?php if ($user->getConfigs()) : ?>
                <option selected value="<?= $user->getConfigs()->getTheme() ?>">
                    <?= translate($user->getConfigs()->getTheme()) ?>
                </option>
            <?php else : ?>
                <option 
                    selected 
                    value="dark"
                >
                        <?= translate('Select a theme') ?>
                </option>
            <?php endif; ?>

            <?php foreach (\Financas\Enum\Theme::cases() as $theme) : ?>
                <option value="<?= $theme->value ?>"><?= $theme->value ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="timezone" class="form-label"><?= translate("Timezone") ?></label>
        <select class="form-control" name="timezone" id="timezone">
            <?php if ($user->getConfigs()) : ?>
                <option selected value="<?= $user->getConfigs()->getTimezone() ?>">
                    <?= $user->getConfigs()->getTimezone() ?>
                </option>
            <?php else : ?>
                <option 
                    selected 
                    value="America/Sao_Paulo"
                >
                    <?= translate('Select a timezone') ?>
                </option>
            <?php endif; ?>

            <?php foreach (\DateTimeZone::listIdentifiers() as $timezone) : ?>
                <option value="<?= $timezone ?>"><?= $timezone ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-outline-light"><?= translate("Save") ?></button>
</form>