/* ;==========================================
; Title:  Back End Department Test
; Author: Justin Van Daalen
; Date:   12 Mar 2020
;==========================================  */

<?php
require 'D:\xampp\htdocs\project\app\database.php';
use PHPUnit\Framework\TestCase;

final class DepartmentTest extends TestCase {

    public static $database;

    public static function setUpBeforeClass() : void {
        DepartmentTest::$database = new database();
    }

    public function setUp() : void { }

    public function test_get_departments() {
        $departments = DepartmentTest::$database->get_departments();

        $this->assertTrue(count($departments) > 0);
        foreach ($departments as $department) {
            $this->assertNotNull($department['department_id']);
            $this->assertNotNull($department['department_name']);
        }
    }

    public function test_get_department() {
        $department = DepartmentTest::$database->get_department(1);

        $this->assertNotNull($department['department_id']);
        $this->assertNotNull($department['department_name']);
    }

    public function test_create_department() {
        $department = new stdClass();
        $department->department_name = "department_name";

        $response = DepartmentTest::$database->create_department($department);
        $this->assertTrue($response);
    }

    public function test_remove_department() {
        $departments = DepartmentTest::$database->get_departments();
        $department = end($departments);
        
        $response = DepartmentTest::$database->remove_department($department['department_id']);
        $this->assertTrue($response);
    }   

    public function tearDown() : void { }

    public static function tearDownAfterClass() : void {
        DepartmentTest::$database->close();
    }
}
?>
