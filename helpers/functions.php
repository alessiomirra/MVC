<?php

function view(string $view,array $data = [], string $viewDir = 'app/views/'): string {
    
    extract($data, EXTR_OVERWRITE);
    // ['posts' => $post]
     ob_start();
        require $viewDir . $view.'.tpl.php';
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
}

function dd(...$data): void {
    var_dump($data);
    die;
    
}
function redirect(string $url = '/'): void {
    header("Location:$url");
    exit();
}
function isUserLoggedin(): bool{
    return $_SESSION['loggedin'] ?? false;
}

function getUserLoggedInFullname(): string{
    return $_SESSION['userData']['username'] ?? '';
}
function getUserRole(): string{
    return $_SESSION['userData']['roletype'] ?? '';
}
function getUserEmail(): string {
    return $_SESSION['userData']['email'] ?? '';
}
function isUserAdmin(): bool{
    return getUserRole() === 'admin';
}
function userCanUpdate(): bool{
    $role = getUserRole();
    return  $role === 'admin' || $role === 'editor';
}
function userCanDelete(): bool{

    return  isUserAdmin();
}
function getUserId(): int {

    return $_SESSION['userData']['id'] ?? 0;
}