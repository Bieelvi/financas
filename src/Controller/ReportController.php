<?php

namespace Financas\Controller;

use Financas\Entity\Farmer;
use Financas\Helper\RenderHtml;
use Financas\Report\RedirectToReport;

class ReportController extends Controller
{
    private string $pageName = 'report';

    public function view(): void
    {
        $get = $this->get();

        $farmers = $this->em
            ->getRepository(Farmer::class)
            ->findAllWithFilter(maxResult: null);

        $filterPeriod = isset($get['filter_period']) ? $get['filter_period'] : 'month';

        $report = (new RedirectToReport())
            ->report($filterPeriod, $farmers);
        $report->generate();

        RenderHtml::render(
            'Report/Index.php',
            [
                'title'        => $this->pageName,
                'farmers'      => $report->data(),
                'filterPeriod' => $filterPeriod,
                'params'       => $get
            ]
        );
    }
}
