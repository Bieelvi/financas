<?php 

namespace Financas\Enum;

enum UserType: string
{
    case ADMIN = 'Admin';
    case NORMAL = 'Normal';
}