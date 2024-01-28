<?php 

namespace Financas\Report;

use Financas\Enum\ProductType;
use Financas\Entity\Farmer;

class FarmerByYearReport implements Report
{
    private array $years = [];

    public function __construct(private array $farmers)
    {
        $this->farmers = $farmers;

        $this->createArray();
    }

    public function generate(): void
    {        
        /** @var Farmer */
        foreach ($this->farmers as $farmer) {
            $date = $farmer->getDate()->format('Y');

            if ($farmer->getType() == ProductType::GAIN->value) {
                $this->years[$date] += $farmer->getValue();
            } 
            
            if ($farmer->getType() == ProductType::SPENT->value) {
                $this->years[$date] -= $farmer->getValue();
            }
        }
    }

    public function data(): array
    {   
        return $this->years;
    }

    private function createArray(): void
    {
        /** @var Farmer */
        foreach ($this->farmers as $farmer) {
            $date = $farmer->getDate()->format('Y');
            $this->years[$date] = 0;
        }
    }
}