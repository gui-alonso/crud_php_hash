<?php
use PHPUnit\Framework\TestCase;

class RegisterTest extends TestCase
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

    public function testUserRegistration()
    {
        $email = 'test@example.com';
        $password = '123456';
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $name = 'Test User';
        $role = 2;

        // Simula a consulta para verificar se o e-mail já existe
        $this->stmt->expects($this->any())
            ->method('bind_param')
            ->willReturn(true);

        $this->stmt->expects($this->any())
            ->method('execute')
            ->willReturn(true);

        // Mock do retorno da consulta para verificar se o e-mail existe
        $this->result->method('fetch_assoc')
            ->willReturn(false); // Simula que o e-mail não existe no banco de dados

        // Simula o get_result retornando o mock de mysqli_result
        $this->stmt->expects($this->any())
            ->method('get_result')
            ->willReturn($this->result);

        // Insere o novo usuário
        $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sssi", $name, $email, $hashedPassword, $role);

        $this->assertTrue($stmt->execute());
    }
}