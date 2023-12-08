<?php 

namespace Financas\Report;

use Financas\Enum\ProductType;
use Financas\Entity\Farmer;

class FarmerByWeekReport implements Report
{
    private array $weeks;

    public function __construct(private array $farmers)
    {
        $this->farmers = $farmers;
        $this->weeks   = [];

        $this->createArray();
    }

    public function generate(): void
    {        
        /** @var Farmer */
        foreach ($this->farmers as $farmer) {
            $date = $farmer->getDate()->format('d/m/Y');

            if ($farmer->getType() == ProductType::GAIN->value) {
                $this->weeks[$date] += $farmer->getValue();
            } 
            
            if ($farmer->getType() == ProductType::SPENT->value) {
                $this->weeks[$date] -= $farmer->getValue();
            }
        }
    }

    public function data(): array
    {   
        return $this->weeks;
    }

    private function createArray(): void
    {
        /** @var Farmer */
        foreach ($this->farmers as $farmer) {
            $date = $farmer->getDate()->format('d/m/Y');
            $this->weeks[$date] = 0;
        }
    }
}