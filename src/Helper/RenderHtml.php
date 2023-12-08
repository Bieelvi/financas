<?php

namespace Financas\Helper;

class RenderHtml 
{
    public static function render(string $path, array $content = []): void
    {
        extract($content);
		ob_start();

		require __DIR__ . '/../../view/' . $path;

		$html = ob_get_clean();

		echo $html;

        exit;
    }
}