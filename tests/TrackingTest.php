/* ;==========================================
; Title:  Back End Group Tracking Test
; Author: Justin Van Daalen
; Date:   12 Mar 2020
;==========================================  */

<?php
use PHPUnit\Framework\TestCase;

final class TrackingTest extends TestCase {

    public static $database;

    public static function setUpBeforeClass() : void {
        TrackingTest::$database = new database();
    }

    public function setUp() : void { }

    public function test_get_all_tracking() {
        $tracking = TrackingTest::$database->get_all_tracking();

        $this->assertTrue(count($tracking) > 0);
        foreach ($tracking as $user) {
            $this->assertNotNull($user->user_id);
            $this->assertNotNull($user->team_name);
            $this->assertNotNull($user->department);
            $this->assertNotNull($user->current_building);
            $this->assertNotNull($user->score);
        }
    }

    public function test_update_tracking() {
        $tracking = new stdClass();
        $tracking->user_id = 1;
        $tracking->building_id = 1;

        $response = TrackingTest::$database->update_tracking($tracking);
        $this->assertTrue($response);
    }
    
    public function tearDown() : void { }

    public static function tearDownAfterClass() : void {
        TrackingTest::$database->close();
    }
}
?>
