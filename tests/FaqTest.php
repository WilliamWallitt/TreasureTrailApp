/* ;==========================================
; Title:  Back End FAQ Test
; Author: Justin Van Daalen
; Date:   12 Mar 2020
;==========================================  */

<?php
use PHPUnit\Framework\TestCase;

final class FaqTest extends TestCase {

    public static $database;

    public static function setUpBeforeClass() : void {
        FaqTest::$database = new database();
    }

    public function setUp() : void { }

    public function test_get_faqs() {
        $faqs = FaqTest::$database->get_faqs(1);

        $this->assertTrue(count($faqs) > 0);
        foreach ($faqs as $faq) {
            $this->assertNotNull($faq->faq_id);
            $this->assertNotNull($faq->question);
            $this->assertNotNull($faq->answer);
        }
    }

    public function test_create_faq() {
        $faq = new stdClass();
        $faq->question = "question";
        $faq->answer = "answer";

        $response = FaqTest::$database->create_faq($faq);
        $this->assertTrue($response);
    }

    public function test_remove_faq() {
        $faqs = FaqTest::$database->get_faqs();
        $faq = end($faqs);
        
        $response = FaqTest::$database->remove_faq($faq->faq_id);
        $this->assertTrue($response);
    } 

    public function tearDown() : void { }

    public static function tearDownAfterClass() : void {
        FaqTest::$database->close();
    }
}
?>
