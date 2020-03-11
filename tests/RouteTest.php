<?php
use PHPUnit\Framework\TestCase;

final class RouteTest extends TestCase {

    public static $database;

    public static function setUpBeforeClass() : void {
        RouteTest::$database = new database();
    }

    public function setUp() : void { }

    public function test_get_routes_by_department() {
        $routes = RouteTest::$database->get_routes_by_department(1);

        $this->assertTrue(count($routes) > 0);
        foreach ($routes as $route) {
            $this->assertNotNull($route->route_id);
        }
    }

    public function tearDown() : void { }

    public static function tearDownAfterClass() : void {
        RouteTest::$database->close();
    }
}
?>