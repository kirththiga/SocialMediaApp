<?php
require_once __DIR__ . '/../security/csrf.php';

class CsrfMiddleware {
    private $unsafe = ['POST','PUT','PATCH','DELETE'];

    public function handle(string $formName): {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        if (in_array($method, $this->unsafe, true)) {
            if (!csrf_validate($formName)) {
                http_response_code(419);
                echo 'Invalid CSRF token.';
                exit;
            }
        }
    }
}