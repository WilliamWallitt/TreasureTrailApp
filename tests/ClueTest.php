<?php
use PHPUnit\Framework\TestCase;

final class ClueTest extends TestCase {

    public static $database;

    public static function setUpBeforeClass() : void {
        ClueTest::$database = new database();
    }

    public function setUp() : void { }

    public function test_get_clues() {
        $clues = ClueTest::$database->get_clues(1);

        $this->assertTrue(count($clues) > 0);
        foreach ($clues as $clue) {
            $this->assertNotNull($clue->clue_id);
            $this->assertNotNull($clue->clue);

            $this->assertTrue(count($clue->answers) > 0);
            foreach ($clue->answers as $answer) {
                $this->assertNotNull($answer->answer_id);
                $this->assertNotNull($answer->answer);
            }
        }
    }

    public function test_create_clue() {
        $answer = new stdClass();
        $answer->answer = "answer";
        $answer->correct = true;
        
        $clue = new stdClass();
        $clue->clue = "clue";
        $clue->answers = array();
        $clue->answers[] = $answer;

        $response = ClueTest::$database->create_clue(1, $clue);
        $this->assertTrue($response);
    }

    public function test_remove_clue() {
        $clues = ClueTest::$database->get_clues(1);
        $clue = end($clues);
        
        $response = ClueTest::$database->remove_clue($clue->clue_id);
        $this->assertTrue($response);
    } 

    public function tearDown() : void { }

    public static function tearDownAfterClass() : void {
        ClueTest::$database->close();
    }
}
?>