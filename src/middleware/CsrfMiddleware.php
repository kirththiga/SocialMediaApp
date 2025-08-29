<?php
require_once __DIR__ . '/../security/csrf.php';

class CsrfMiddleware {
    private $unsafe = ['POST','PUT','PATCH','DELETE'];
    public function handle(?string $formName = null) {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        if (in_array($method, $this->unsafe, true)) {
            $form = $formName ?? ($_POST['csrf_form'] ?? 'default'); // <-- use posted form name
            if (!csrf_validate($form)) {
                http_response_code(419);
                echo 'Invalid CSRF token.';
                exit;
            }
        }
    }
}