<?php
class database {
    private $connection;

    function __construct() {
        $this->open();
    }

    private function open() {
        global $connection;

        $connection = new mysqli("localhost", "root", "root", "project");
        if ($connection->connect_error) {
            die("Failed to create database connection: $connection->connect_error");
        }
    }

    public function get_departments() {
        global $connection;

        $sql = "SELECT * FROM departments";

        $result = $this->query($sql);
        return $result;
    }

    public function create_department($department) {
        global $connection;

        $department_name_param = $connection->escape_string($department->department_name);
        $sql = "INSERT INTO departments (department_name) VALUES ('$department_name_param')";

        $result = $this->query($sql);
        return $result;
    }

    public function remove_department($department_id) {
        global $connection;

        foreach ($this->get_routes_by_department($department_id) as $route) {
            $this->remove_route($route->route_id);
        }

        $department_id_param = $connection->escape_string($department_id);
        $sql = "DELETE FROM departments WHERE department_id='$department_id_param'";

        $result = $this->delete_query($sql);
        return $result;
    }

    public function get_building($building_id) {
        global $connection;

        $building_id_param = $connection->escape_string($building_id);
        $sql = "SELECT * FROM buildings WHERE building_id='$building_id_param' LIMIT 1";

        $result = $this->query($sql);
        return $result[0];
    }

    public function create_building($building) {
        global $connection;

        $building_name_param = $connection->escape_string($building->building_name);
        $latitude_param = $connection->escape_string($building->latitude);
        $longitude_param = $connection->escape_string($building->longitude);
        $extra_info_param = $connection->escape_string($building->extra_info);
        $sql = "INSERT INTO buildings (building_name, latitude, longitude, extra_info) VALUES ('$building_name_param', '$latitude_param', '$longitude_param', '$extra_info_param')";

        $result = $this->query($sql);

        $building_id = $connection->insert_id;
        foreach ($building->clues as $clue) {
            $this->create_clue($building_id, $clue);
        }

        return $result;  
    }

    public function remove_building($building_id) {
        global $connection;

        foreach ($this->get_routes_by_building($building_id) as $route) {
            $this->remove_route($route->route_id);
        }

        foreach ($this->get_clues($building_id) as $clue) {
            $this->remove_clue($clue->clue_id);
        }

        $building_id_param = $connection->escape_string($building_id);
        $sql = "DELETE FROM buildings WHERE building_id='$building_id_param'";

        $result = $this->delete_query($sql);
        return $result;     
    }

    private function get_routes_by_department($department_id) {
        global $connection;

        $department_id_param = $connection->escape_string($department_id);
        $sql = "SELECT * FROM routes WHERE department_id='$department_id_param'";

        $result = $this->query($sql);

        $routes = array();
        foreach ($result as $route) {
            $route_object = new stdClass();
            $route_object->route_id = $route['route_id'];

            $routes[] = $route_object;
        }
        return $routes;
    }

    private function get_routes_by_building($building_id) {
        global $connection;

        $building_id_param = $connection->escape_string($building_id);
        $sql = "SELECT * FROM routes WHERE building_id='$building_id_param'";

        $result = $this->query($sql);

        $routes = array();
        foreach ($result as $route) {
            $route_object = new stdClass();
            $route_object->route_id = $route['route_id'];

            $routes[] = $route_object;
        }
        return $routes;
    }

    public function get_route($department_id) {
        global $connection;

        $department_id_param = $connection->escape_string($department_id);
        $sql = "SELECT * FROM routes WHERE department_id='$department_id_param'";

        $result = $this->query($sql);

        usort($result, function($x, $y) {
            return $x['order_id'] < $y['order_id'] ? -1 : 1;
        });

        $buildings = array();
        foreach ($result as $route) {
            $building = $this->get_building($route['building_id']);

            //$object = new stdClass();
            //$object->name = $building['building_name'];
            //$object->latitude = $building['latitude'];
            //$object->longitude = $building['longitude'];

            $buildings[] = $building;
        }
        return $buildings;
    }

    public function create_route($route) {
        global $connection;

        $order_id_param = $connection->escape_string($route->order_id);
        $department_id_param = $connection->escape_string($route->department_id);
        $building_id_param = $connection->escape_string($route->building_id);
        $sql = "INSERT INTO routes (order_id, department_id, building_id) VALUES ('$order_id_param', '$department_id_param', '$building_id_param')";

        $result = $this->query($sql);
        return $result;
    }

    public function remove_route($route_id) {
        global $connection;

        $route_id_param = $connection->escape_string($route_id);
        $sql = "DELETE FROM routes WHERE route_id='$route_id_param'";

        $result = $this->delete_query($sql);
        return $result; 
    }

    public function get_answers($clue_id) {
        global $connection;

        $clue_id_param = $connection->escape_string($clue_id);
        $sql = "SELECT * FROM answers WHERE clue_id='$clue_id_param'";

        $result = $this->query($sql);

        $answers = array();
        foreach ($result as $answer) {
            $answer_object = new stdClass();
            $answer_object->answer_id = $answer['answer_id'];
            $answer_object->answer = $answer['answer'];
            $answers[] = $answer_object;
        }
        return $answers;
    }

    public function create_answer($clue_id, $answer) {
        global $connection;

        $clue_id_param = $connection->escape_string($clue_id);
        $answer_param = $connection->escape_string($answer->answer);
        $correct_param = $connection->escape_string($answer->correct);
        $sql = "INSERT INTO answers (clue_id, answer, correct) VALUES ('$clue_id_param', '$answer_param', '$correct_param')";

        $result = $this->query($sql);
        return $result;
    }

    public function remove_answer($answer_id) {
        global $connection;

        $answer_id_param = $connection->escape_string($answer_id);
        $sql = "DELETE FROM answers WHERE answer_id='$answer_id_param'";

        $result = $this->delete_query($sql);
        return $result;  
    }

    public function get_all_clues() {
        global $connection;

        $sql = "SELECT * FROM clues";

        $result = $this->query($sql);

        $clues = array();
        foreach ($result as $clue) {
            $clue_object = new stdClass();
            $clue_object->clue_id = $clue['clue_id'];
            $clue_object->clue = $clue['clue'];
            $clue_object->answers = $this->get_answers($clue['clue_id']);

            $clues[] = $clue_object;
        }
        return $clues; 
    }

    public function get_clues($building_id) {
        global $connection;

        $building_id_param = $connection->escape_string($building_id);
        $sql = "SELECT * FROM clues WHERE building_id='$building_id_param'";

        $result = $this->query($sql);

        $clues = array();
        foreach ($result as $clue) {
            $clue_object = new stdClass();
            $clue_object->clue_id = $clue['clue_id'];
            $clue_object->clue = $clue['clue'];
            $clue_object->answers = $this->get_answers($clue['clue_id']);

            $clues[] = $clue_object;
        }
        return $clues;
    }

    public function create_clue($building_id, $clue) {
        global $connection;

        $building_id_param = $connection->escape_string($building_id);
        $clue_param = $connection->escape_string($clue->clue);
        $sql = "INSERT INTO clues (building_id, clue) VALUES ('$building_id_param', '$clue_param')";

        $result = $this->query($sql);

        $clue_id = $connection->insert_id;
        foreach ($clue->answers as $answer) {
            $this->create_answer($clue_id, $answer);
        }

        return $result;
    }

    public function remove_clue($clue_id) {
        global $connection;

        foreach ($this->get_answers($clue_id) as $answer) {
            $this->remove_answer($answer->answer_id);
        }

        $clue_id_param = $connection->escape_string($clue_id);
        $sql = "DELETE FROM clues WHERE clue_id='$clue_id_param'";

        $result = $this->delete_query($sql);
        return $result; 
    }

    public function verify_answer($answer_id) {
        global $connection;

        $answer_id_param = $connection->escape_string($answer_id);
        $sql = "SELECT * FROM answers WHERE answer_id='$answer_id_param' LIMIT 1";

        $result = $this->query($sql);
        return $result[0]['correct'] == 0 ? false : true;
    }

    public function get_faqs() {
        global $connection;

        $sql = "SELECT * FROM faq";

        $result = $this->query($sql);

        $faqs = array();
        foreach ($result as $faq) {
            $faq_object = new stdClass();
            $faq_object->question = $faq['question'];
            $faq_object->answer = $faq['answer'];

            $faqs[] = $faq_object;
        }
        return $faqs;
    }

    public function create_faq($faq) {
        global $connection;

        $question_param = $connection->escape_string($faq->question);
        $answer_param = $connection->escape_string($faq->answer);
        $sql = "INSERT INTO faq (question, answer) VALUES ('$question_param', '$answer_param')";

        $result = $this->query($sql);
        return $result;
    }

    public function remove_faq($faq_id) {
        global $connection;

        $faq_id_param = $connection->escape_string($faq_id);
        $sql = "DELETE FROM faq WHERE faq_id='$faq_id_param'";

        $result = $this->delete_query($sql);
        return $result; 
    }

    private function query($sql) {
        global $connection;

        $result = $connection->query($sql);
        if (!$result) {
            die($connection->error);
        }

        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    private function delete_query($sql) {
        global $connection;

        $result = $connection->query($sql);
        if (!$result) {
            die($connection->error);
        }

        return $result;
    }

    public function close() {
        global $connection;

        $connection->close();
    }
}
?>