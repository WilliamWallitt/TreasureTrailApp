<?php
use PHPUnit\Framework\TestCase;

final class LeaderboardTest extends TestCase {

    public static $database;

    public static function setUpBeforeClass() : void {
        LeaderboardTest::$database = new database();
    }

    public function setUp() : void { }

    public function test_get_leaderboard() {
        $leaderboard = LeaderboardTest::$database->get_leaderboard(1);
        
        $this->assertTrue(count($leaderboard) > 0);
        foreach ($leaderboard as $user) {
            $this->assertNotNull($user->team_name);
            $this->assertNotNull($user->score);
        }
    }

    public function test_get_leaderboard_position() {
        $user = LeaderboardTest::$database->get_leaderboard_position(1, 1);
        $this->assertNotNull($user->position);
    }
    
    public function tearDown() : void { }

    public static function tearDownAfterClass() : void {
        LeaderboardTest::$database->close();
    }
}
?>