<?php
use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    protected $db;
    protected $stmt;
    protected $result;

    protected function setUp(): void
    {
        // Mock da conexão com o banco de dados
        $this->db = $this->createMock(mysqli::class);

        // Mock do objeto mysqli_stmt
        $this->stmt = $this->createMock(mysqli_stmt::class);

        // Mock do objeto mysqli_result
        $this->result = $this->createMock(mysqli_result::class);

        // Retorna o objeto mysqli_stmt quando prepare() é chamado
        $this->db->method('prepare')
            ->willReturn($this->stmt);
    }

    public function testUserLogin()
    {
        $email = 'test@example.com';
        $password = '123456';

        // Simula o bind_param e execute para a query
        $this->stmt->expects($this->any())
            ->method('bind_param')
            ->willReturn(true);

        $this->stmt->expects($this->any())
            ->method('execute')
            ->willReturn(true);

        // Mock do retorno da consulta com o usuário
        $this->result->method('fetch_assoc')
            ->willReturn([
                'email' => 'test@example.com',
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'role' => 2
            ]);

        // Simula o get_result retornando o mock de mysqli_result
        $this->stmt->expects($this->any())
            ->method('get_result')
            ->willReturn($this->result);

        // Verifica se a senha está correta
        $result = $this->stmt->get_result()->fetch_assoc();
        $this->assertTrue(password_verify($password, $result['password']));
    }
}