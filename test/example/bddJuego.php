<?php
use PHPUnit\Framework\TestCase;



include_once(__DIR__ . "/../../configuration/Configuration.php");
require_once __DIR__ . '/../../../vendor/autoload.php';

include_once(__DIR__ . "/../../helper/MysqlDatabase.php");
include_once(__DIR__ . "/../../helper/MysqlObjectDatabase.php");



final class bddJuego extends TestCase
{
    public function testShouldCheckAssertTrue(){
        $this->assertTrue(true);
    }

    public function testShouldCheckAssertEquals(){
        $this->assertEquals("a", "a");
    }

    private $registroModel;
   public function setUp(): void
   {
        // Carga la configuración
       $db = (new Configuration())->getDatabase();
       $this->registroModel = new RegistroModel($db);  // Asegúrate de que RegistroModel reciba $db en su constructor
       $db->getConnection()->beginTransaction();
    }

    protected function tearDown(): void
    {
        // Revertir los cambios en la base de datos después de cada prueba
        $this->db->getConnection()->rollback();
    }

    public function testCreateUser() {
        // Datos de prueba
        $data = [
            'nombre' => 'Test',
            'nombre_usuario' => 'testuser',
            'contrasenia' => 'testpass',
            'fecha_nacimiento' => '2000-01-01',
            'pais' => 'Argentina',
            'sexo' => 'Masculino',
            'ciudad' => 'Buenos Aires',
            'email' => 'test@example.com'
        ];

        // Ejecuta la función
        $result = $this->registroModel->createUser($data);

        // Verifica si la inserción fue exitosa
        $this->assertGreaterThan(0, $result, "El usuario debería haberse insertado en la base de datos.");
    }

    /*protected function tearDown() : void{
        // Revertir los cambios en la base de datos después de cada prueba
        $this->db->getConnection()->rollback();
    }*/
}

