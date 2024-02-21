<?php

function view(string $view,array $data = [], string $viewDir = 'app/views/'): string {
    
    extract($data, EXTR_OVERWRITE);
    ob_start();
    require $viewDir . $view.'.tpl.php';
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}