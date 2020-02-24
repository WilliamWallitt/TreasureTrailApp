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

    public function get_department_by_id($department_id) {
        global $connection;

        $department_id_param = $connection->escape_string($department_id);
        $sql = "SELECT * FROM departments WHERE department_id='$department_id_param' LIMIT 1";

        $result = $this->query($sql);
        return $result[0];
    }

    public function get_departments() {
        global $connection;

        $sql = "SELECT * FROM departments";

        $result = $this->query($sql);
        return $result;
    }

    public function get_building($building_id) {
        global $connection;

        $building_id_param = $connection->escape_string($building_id);
        $sql = "SELECT * FROM buildings WHERE building_id='$building_id_param' LIMIT 1";

        $result = $this->query($sql);
        return $result[0];
    }

    public function get_route($department_id) {
        global $connection;

        $sql = "SELECT * FROM routes WHERE department_id='$department_id'";

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

    private function query($sql) {
        global $connection;

        $result = $connection->query($sql);
        if (!$result) {
            die();
        }

        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function close() {
        global $connection;

        $connection->close();
    }
}
?>