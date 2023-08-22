<?php

use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase {
    public function testLoginPage() {
        $html = file_get_contents('login.html');
        $this->assertStringContainsString('<title>Login Page</title>', $html);
    }

    public function testLoginLogic() {
        // Simulate POST data
        $_POST['username'] = 'testuser';
        $_POST['password'] = 'testpassword';

        ob_start(); // Start capturing output
        include 'login.php'; // Include your PHP login code
        $output = ob_get_clean(); // Capture the output

        $this->assertStringContainsString('Login successful!', $output);
    }
}
