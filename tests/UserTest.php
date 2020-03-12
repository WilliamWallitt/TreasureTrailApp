/* ;==========================================
; Title:  Back End User Test
; Author: Justin Van Daalen
; Date:   12 Mar 2020
;==========================================  */

<?php
use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase {

    public static $database;

    public static function setUpBeforeClass() : void {
        UserTest::$database = new database();
    }

    public function setUp() : void { }

    public function test_exists_user() {
        $user = new stdClass();
        $user->team_name = time();

        $response = UserTest::$database->exists_user($user);
        $this->assertFalse($response);
    }

    public function test_create_user() {
        $user = new stdClass();
        $user->team_name = time();
        $user->department_id = 1;

        $user_response = UserTest::$database->create_user($user);
        $this->assertNotNull($user_response->user_id);
    }
    
    public function test_reset_user() {
        $response = UserTest::$database->reset_user(1);
        $this->assertTrue($response);
    }

    public function test_set_completed_user() {
        $response = UserTest::$database->set_completed_user(1);
        $this->assertTrue($response);
    }

    public function tearDown() : void { }

    public static function tearDownAfterClass() : void {
        UserTest::$database->close();
    }
}
?>
