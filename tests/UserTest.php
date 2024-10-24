<?php
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testPasswordHash()
    {
        $password = '123456';
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Verifica se a senha foi corretamente criptografada
        $this->assertNotEquals($password, $hashedPassword);
        $this->assertTrue(password_verify($password, $hashedPassword));
    }

    public function testPasswordVerify()
    {
        $password = '123456';
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Verifica se a senha digitada é validada corretamente
        $this->assertTrue(password_verify($password, $hashedPassword));

        // Verifica se uma senha incorreta não passa na validação
        $this->assertFalse(password_verify('wrong_password', $hashedPassword));
    }
}