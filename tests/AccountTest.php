/* ;==========================================
; Title:  Back End Account Test
; Author: Justin Van Daalen
; Date:   12 Mar 2020
;==========================================  */

<?php
use PHPUnit\Framework\TestCase;

final class AccountTest extends TestCase {

    public static $database;

    public static function setUpBeforeClass() : void {
        AccountTest::$database = new database();
    }

    public function setUp() : void { }

    public function test_verify_account() {
        $account = new stdClass();
        $account->username = "username";
        $account->password = "password";

        $response = AccountTest::$database->verify_account($account);
        $this->assertFalse($response);
    }
    
    public function tearDown() : void { }

    public static function tearDownAfterClass() : void {
        AccountTest::$database->close();
    }
}
?>
