<?php

namespace Financas\Controller;

use Financas\Entity\Farmer;
use Financas\Helper\RenderHtml;
use Financas\Report\RedirectToReport;

class ReportController extends Controller
{
    public function view(): void
    {
        $get = $this->get();

        $farmers = $this->em
            ->getRepository(Farmer::class)
            ->findAllWithFilter(maxResult: null);

        $filterPeriod = $get['filter_period'] ?? 'month';

        $report = (new RedirectToReport())
            ->report($filterPeriod, $farmers);
        $report->generate();

        RenderHtml::render(
            'Report/Index.php',
            [
                'title'        => translate('Reports'),
                'farmers'      => $report->data(),
                'filterPeriod' => $filterPeriod,
                'params'       => $get
            ]
        );
    }
}
