<?php 

namespace Financas\Controller;

use Financas\Helper\RenderHtml;

class HomeController extends Controller
{
    private string $pageName = 'home';

    public function view(): void
    {
        RenderHtml::render(
            'Home/Index.php', [
                'title' => $this->pageName
            ]
        );
    }
}