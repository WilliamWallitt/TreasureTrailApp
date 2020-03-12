/* ;==========================================
; Title:  Back End Building Test
; Author: Justin Van Daalen
; Date:   12 Mar 2020
;==========================================  */

<?php
use PHPUnit\Framework\TestCase;

final class BuildingTest extends TestCase {

    public static $database;

    public static function setUpBeforeClass() : void {
        BuildingTest::$database = new database();
    }

    public function setUp() : void { }

    public function test_get_all_buildings() {
        $buildings = BuildingTest::$database->get_all_buildings();

        $this->assertTrue(count($buildings) > 0);
        foreach ($buildings as $building) {
            $this->assertNotNull($building['building_id']);
            $this->assertNotNull($building['building_name']);
            $this->assertNotNull($building['latitude']);
            $this->assertNotNull($building['longitude']);
            $this->assertNotNull($building['extra_info']);
            $this->assertNotNull($building['narrative']);
        }
    }

    public function test_get_building() {
        $building = BuildingTest::$database->get_building(1);

        $this->assertNotNull($building['building_id']);
        $this->assertNotNull($building['building_name']);
        $this->assertNotNull($building['latitude']);
        $this->assertNotNull($building['longitude']);
        $this->assertNotNull($building['extra_info']);
        $this->assertNotNull($building['narrative']);
    }

    public function test_create_building() {
        $answer = new stdClass();
        $answer->answer = "answer";
        $answer->correct = true;
        
        $clue = new stdClass();
        $clue->clue = "clue";
        $clue->answers = array();
        $clue->answers[] = $answer;

        $building = new stdClass();
        $building->building_name = "building_name";
        $building->latitude = 1;
        $building->longitude = 1;
        $building->extra_info = "extra_info";
        $building->narrative = "narrative";
        $building->clues = array();
        $building->clues[] = $clue;

        $response = BuildingTest::$database->create_building($building);
        $this->assertTrue($response);
    }

    public function test_remove_building() {
        $buildings = BuildingTest::$database->get_all_buildings();
        $building = end($buildings);
        
        $response = BuildingTest::$database->remove_building($building['building_id']);
        $this->assertTrue($response);
    } 

    public function tearDown() : void { }

    public static function tearDownAfterClass() : void {
        BuildingTest::$database->close();
    }
}
?>
