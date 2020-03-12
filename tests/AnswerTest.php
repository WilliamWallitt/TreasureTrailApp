/* ;==========================================
; Title:  Back End Answer Test
; Author: Justin Van Daalen
; Date:   12 Mar 2020
;==========================================  */

<?php
use PHPUnit\Framework\TestCase;

final class AnswerTest extends TestCase {

    public static $database;

    public static function setUpBeforeClass() : void {
        AnswerTest::$database = new database();
    }

    public function setUp() : void { }

    public function test_get_answers_correct() {
        $answers = AnswerTest::$database->get_answers_correct(1);

        $this->assertTrue(count($answers) > 0);
        foreach ($answers as $answer) {
            $this->assertNotNull($answer->answer_id);
            $this->assertNotNull($answer->answer);
            $this->assertNotNull($answer->correct);
        }
    }

    public function test_get_answers() {
        $answers = AnswerTest::$database->get_answers(1);

        $this->assertTrue(count($answers) > 0);
        foreach ($answers as $answer) {
            $this->assertNotNull($answer->answer_id);
            $this->assertNotNull($answer->answer);
        }
    }

    public function test_create_answer() {
        $answer = new stdClass();
        $answer->answer = "answer";
        $answer->correct = true;

        $response = AnswerTest::$database->create_answer(1, $answer);
        $this->assertTrue($response);
    }

    public function test_verify_answer() {
        $answers = AnswerTest::$database->get_answers(1);
        $answer = end($answers);
        
        $response = AnswerTest::$database->verify_answer($answer->answer_id);
        $this->assertTrue($response);
    }

    public function test_remove_answer() {
        $answers = AnswerTest::$database->get_answers(1);
        $answer = end($answers);
        
        $response = AnswerTest::$database->remove_answer($answer->answer_id);
        $this->assertTrue($response);
    } 

    public function tearDown() : void { }

    public static function tearDownAfterClass() : void {
        AnswerTest::$database->close();
    }
}
?>
