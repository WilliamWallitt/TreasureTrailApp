/* ;==========================================
; Title:  Back End Score Test
; Author: Justin Van Daalen
; Date:   12 Mar 2020
;==========================================  */

<?php
use PHPUnit\Framework\TestCase;

final class ScoreTest extends TestCase {

    public static $database;

    public static function setUpBeforeClass() : void {
        ScoreTest::$database = new database();
    }

    public function setUp() : void { }

    public function test_get_score() {
        $score = ScoreTest::$database->get_score(1);
        $this->assertNotNull($score);
    }

    public function test_update_score() {
        $user = new stdClass();
        $user->user_id = "1";
        $user->seconds = 1;
        $user->attempts = 0;

        $response = ScoreTest::$database->update_score($user);
        $this->assertTrue($response);
    }
    
    public function tearDown() : void { }

    public static function tearDownAfterClass() : void {
        ScoreTest::$database->close();
    }
}
?>
