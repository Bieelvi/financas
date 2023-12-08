<?php 

namespace Financas\Report;

use Financas\Enum\ProductType;
use Financas\Entity\Farmer;

class FarmerByMonthReport implements Report
{
    private array $months;

    public function __construct(private array $farmers)
    {
        $this->farmers = $farmers;
        $this->months  = [];

        $this->createArray();
    }

    public function generate(): void
    {        
        /** @var Farmer */
        foreach ($this->farmers as $farmer) {
            $date = $farmer->getDate()->format('m/Y');

            if ($farmer->getType() == ProductType::GAIN->value) {
                $this->months[$date] += $farmer->getValue();
            } 
            
            if ($farmer->getType() == ProductType::SPENT->value) {
                $this->months[$date] -= $farmer->getValue();
            }
        }
    }

    public function data(): array
    {   
        return $this->months;
    }

    private function createArray(): void
    {
        /** @var Farmer */
        foreach ($this->farmers as $farmer) {
            $date = $farmer->getDate()->format('m/Y');
            $this->months[$date] = 0;
        }
    }
}