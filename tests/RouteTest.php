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

    public function test_get_routes_by_building() {
        $routes = RouteTest::$database->get_routes_by_building(1);

        $this->assertTrue(count($routes) > 0);
        foreach ($routes as $route) {
            $this->assertNotNull($route->route_id);
        }
    }

    public function test_get_all_routes() {
        $routes = RouteTest::$database->get_all_routes();

        $this->assertTrue(count($routes) > 0);
        foreach ($routes as $department) {
            $this->assertNotNull($department->department_id);
            $this->assertNotNull($department->department_name);

            $this->assertTrue(count($department->buildings) > 0);
            foreach ($department->buildings as $building) {
                $this->assertNotNull($building->route_id);
                $this->assertNotNull($building->building_id);
                $this->assertNotNull($building->building_name);
                $this->assertNotNull($building->latitude);
                $this->assertNotNull($building->longitude);
                $this->assertNotNull($building->extra_info);
                $this->assertNotNull($building->narrative);
            }
        }
    }

    public function test_get_route() {
        $buildings = RouteTest::$database->get_route(1);

        $this->assertTrue(count($buildings) > 0);
        foreach ($buildings as $building) {
            $this->assertNotNull($building->route_id);
            $this->assertNotNull($building->building_id);
            $this->assertNotNull($building->building_name);
            $this->assertNotNull($building->latitude);
            $this->assertNotNull($building->longitude);
            $this->assertNotNull($building->extra_info);
            $this->assertNotNull($building->narrative);
        }
    }

    public function test_get_last_order_id() {
        $response = RouteTest::$database->get_last_order_id(1);

        $this->assertNotNull($response);
        $this->assertTrue($response > 0);
    }

    public function test_create_route() {
        $route = new stdClass();
        $route->department_id = 1;
        $route->building_id = 1;

        $response = RouteTest::$database->create_route($route);
        $this->assertTrue($response);
    } 

    public function test_remove_route() {
        $routes = RouteTest::$database->get_routes_by_department(1);
        $route = end($routes);
        
        $response = RouteTest::$database->remove_route($route->route_id);
        $this->assertTrue($response);
    }   

    public function tearDown() : void { }

    public static function tearDownAfterClass() : void {
        RouteTest::$database->close();
    }
}
?>