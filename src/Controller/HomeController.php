<?php 

namespace Financas\Controller;

use Financas\Helper\RenderHtml;

class HomeController extends Controller
{
    public function view(): void
    {
        RenderHtml::render(
            'Home/Index.php', [
                'title' => translate("Home")
            ]
        );
    }
}