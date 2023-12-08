<?php 

namespace Financas\Enum;

enum ProductType: string
{
    case GAIN = 'Gain';
    case SPENT = 'Spent';
}