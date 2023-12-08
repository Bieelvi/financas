<?php 

namespace Financas\Helper;

class Response
{
    public static function json(array $data, int $statusCode): void
    {
        http_response_code($statusCode);
        echo json_encode($data); die;
    }
}