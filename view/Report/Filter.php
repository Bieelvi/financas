<div class="collapse my-2" id="collapseFilter">
    <div class="card card-body">
        <form action="/report" method="get">
            <div class="row mb-3">
                <div class="col-12 col-md-6 col-lg-3 mb-2">
                    <label for="filter_period" class="form-label"><?= translate("Period") ?></label>
                    <select class="form-select" id="filter_period" name="filter_period">
                        <?php if (isset($params['filter_period'])) : ?>
                            <option value="<?= $params['filter_period'] ?>"><?= ucfirst((string) $params['filter_period']) ?></option>
                        <?php else : ?>
                            <option selected disabled value><?= translate("Select a period") ?></option>
                        <?php endif; ?>
                        
                        <option value="month"><?= translate("Month") ?></option>
                        <option value="week"><?= translate("Week") ?></option>
                        <option value="year"><?= translate("Year") ?></option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-outline-light"><?= translate("Search") ?></button>
        </form>
    </div>
</div>