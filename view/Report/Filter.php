<div class="collapse my-2" id="collapseFilter">
    <div class="card card-body">
        <form action="/report" method="get">
            <div class="row mb-3">
                <div class="col-12 col-md-6 col-lg-3 mb-2">
                    <label for="filter_period" class="form-label">Period</label>
                    <select class="form-select" id="filter_period" name="filter_period">
                        <?php if (isset($params['filter_period'])) : ?>
                            <option value="<?= $params['filter_period'] ?>"><?= ucfirst($params['filter_period']) ?></option>
                        <?php else : ?>
                            <option selected disabled value>Selecione um período</option>
                        <?php endif; ?>
                        
                        <option value="month">Month</option>
                        <option value="week">Week</option>
                        <option value="year">Year</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-outline-light">Search</button>
        </form>
    </div>
</div>