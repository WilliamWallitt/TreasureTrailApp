<?php
//;==========================================
//; Title:  Back end database call that handles all database SQL queries
//; Author: Justin Van Daalen, Edward Soutar, William Wallitt, Oliver Fawcett, Stephan Kubal
//; Date:   25 Feb 2020
//;==========================================
class database {
    private $connection;

    function __construct() {
        $this->open();
    }

    /**
     * Creates the connection to the database
     */
    private function open() {
        global $connection;

        // database connection information
        //$connection = new mysqli("localhost", "treayiaz_admin", "TY4KM1997", "treayiaz_admin");
        $connection = new mysqli("localhost", "root", "root", "project");
        if ($connection->connect_error) {
            die("Failed to create database connection: $connection->connect_error");
        }
    }

    /**
     * Gets all deparmtents from the database
     *
     * @return  array
     */
    public function get_departments() {
        global $connection;

        $sql = "SELECT * FROM departments";

        $result = $this->query($sql);
        return $result;
    }

    public function get_department($department_id) {
        global $connection;

        $department_id_param = $connection->escape_string($department_id);
        $sql = "SELECT * FROM departments WHERE department_id='$department_id_param' LIMIT 1";

        $result = $this->query($sql);

        return $result[0];  
    }

    /**
     * Creates a department and adds it to the database
     *
     * @param   object  $department An object, represents a json object with department_name properties
     * @return  bool
     */
    public function create_department($department) {
        global $connection;

        $department_name_param = $connection->escape_string($department->department_name);
        $sql = "INSERT INTO departments (department_name) VALUES ('$department_name_param')";

        $result = $this->general_query($sql);
        return $result;
    }

    /**
     * Removes a department given its id
     *
     * @param   string  department_id   An id that represents a department
     * @return  bool
     */
    public function remove_department($department_id) {
        global $connection;

        // routes are dependent on departments, therefore all routes
        // attached to this department need to also be removed
        foreach ($this->get_routes_by_department($department_id) as $route) {
            $this->remove_route($route->route_id);
        }

        $department_id_param = $connection->escape_string($department_id);
        $sql = "DELETE FROM departments WHERE department_id='$department_id_param'";

        $result = $this->general_query($sql);
        return $result;
    }

    /**
     * Fetches all buildings from the database
     *
     * @return array
     */
    public function get_all_buildings() {
        global $connection;

        $sql = "SELECT * FROM buildings";

        $result = $this->query($sql);

        $buildings = array();
        foreach ($result as $building) {
            $buildings[] = $building;
        }
        return $buildings;
    }

    /**
     * Fetches a building's information given its building id
     *
     * @param   string  building_id An id that represents a building
     * @return  object
     */
    public function get_building($building_id) {
        global $connection;

        $building_id_param = $connection->escape_string($building_id);
        $sql = "SELECT * FROM buildings WHERE building_id='$building_id_param' LIMIT 1";

        $result = $this->query($sql);
        return $result[0];
    }

    /**
     * Creates a building and adds it to the database
     *
     * @param   object  $building An object representing a json object with building_name, latitude,
     *                            longitude, extra_info and clues as properties
     * @param   bool
     */
    public function create_building($building) {
        global $connection;

        $building_name_param = $connection->escape_string($building->building_name);
        $latitude_param = $connection->escape_string($building->latitude);
        $longitude_param = $connection->escape_string($building->longitude);
        $extra_info_param = $connection->escape_string($building->extra_info);
        $sql = "INSERT INTO buildings (building_name, latitude, longitude, extra_info) VALUES ('$building_name_param', '$latitude_param', '$longitude_param', '$extra_info_param')";

        $result = $this->general_query($sql);

        // $building represents a json object which also contains a list of clues
        // therefore, all clues need to be inserted as well
        $building_id = $connection->insert_id;
        foreach ($building->clues as $clue) {
            $this->create_clue($building_id, $clue);
        }
        return $result;
    }

    /**
     * Removes a building given a building id
     *
     * @param   string  $building_id An id that represents a building
     * @return  bool
     */
    public function remove_building($building_id) {
        global $connection;

        // routes depend on buildings, therefore when removing a building,
        // all the routes attached to it need to also be removed
        foreach ($this->get_routes_by_building($building_id) as $route) {
            $this->remove_route($route->route_id);
        }

        // clues also depend on buildings and need to be removed
        foreach ($this->get_clues($building_id) as $clue) {
            $this->remove_clue($clue->clue_id);
        }

        $building_id_param = $connection->escape_string($building_id);
        $sql = "DELETE FROM buildings WHERE building_id='$building_id_param'";

        $result = $this->general_query($sql);
        return $result;
    }

    /**
     * Fetches all routes pertaining to a department id
     *
     * @param   string  $department_id An id that represents a department
     * @return  array
     */
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

    /**
     * Fetches all routes pertaining to a building id
     *
     * @param   string  $building_id An id that represents a building
     * @return  array
     */
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

    /**
     * Fetches all routes in the database
     *
     * @return  array
     */
    public function get_all_routes() {
        $routes = array();
        foreach ($this->get_departments() as $department) {
            $department_object = new stdClass();
            $department_object->department_id = $department['department_id'];
            $department_object->department_name = $department['department_name'];
            $department_object->buildings = $this->get_route($department['department_id']);

            $routes[] = $department_object;
        }
        return $routes;
    }

    /**
     * Fetches all routes pertaining to a department id, as well as all building information
     *
     * @param   string  $department_id An id that represents a department
     * @return  array
     */
    public function get_route($department_id) {
        global $connection;

        $department_id_param = $connection->escape_string($department_id);
        $sql = "SELECT * FROM routes WHERE department_id='$department_id_param'";

        $result = $this->query($sql);

        // order routes by ascending order of "order_id" column
        usort($result, function($x, $y) {
            return $x['order_id'] < $y['order_id'] ? -1 : 1;
        });

        $buildings = array();
        foreach ($result as $route) {
            $building = $this->get_building($route['building_id']);

            $route_object = new stdClass();
            $route_object->route_id = $route['route_id'];
            $route_object->building_id = $building['building_id'];
            $route_object->building_name = $building['building_name'];
            $route_object->latitude = $building['latitude'];
            $route_object->longitude = $building['longitude'];
            $route_object->extra_info = $building['extra_info'];

            $buildings[] = $route_object;
        }
        return $buildings;
    }

    /**
     * Given a department id, fetches the route and returns the last order id value
     *
     * @param   string  $department_id An id that represents a department
     * @return  string
     */
    private function get_last_order_id($department_id) {
        global $connection;

        $department_id_param = $connection->escape_string($department_id);
        $sql = "SELECT * FROM routes WHERE department_id='$department_id_param'";

        $result = $this->query($sql);

        // order routes by ascending order of "order_id" column
        usort($result, function($x, $y) {
            return $x['order_id'] < $y['order_id'] ? -1 : 1;
        });

        // get the maximum value of "order_id"
        return end($result)['route_id'];
    }

    /**
     * Creates a route
     *
     * @param   object  $route  A class that represents a json object with fields department_id, building_id
     * @return  string  $result;
     */
    public function create_route($route) {
        global $connection;

        $order_id_param = $this->get_last_order_id($route->department_id) + 1;
        $department_id_param = $connection->escape_string($route->department_id);
        $building_id_param = $connection->escape_string($route->building_id);
        $sql = "INSERT INTO routes (order_id, department_id, building_id) VALUES ('$order_id_param', '$department_id_param', '$building_id_param')";

        $result = $this->general_query($sql);
        return $result;
    }

    /**
     * Removes a route given its route id
     *
     * @param   string  route_id    An id that represents a route
     * @return  bool
     */
    public function remove_route($route_id) {
        global $connection;

        $route_id_param = $connection->escape_string($route_id);
        $sql = "DELETE FROM routes WHERE route_id='$route_id_param'";

        $result = $this->general_query($sql);
        return $result;
    }

    /**
     * Get all answers (including the correct field), given a clue id
     *
     * @param   string  $clue_id An id that represents a clue
     * @return  array
     */
    private function get_answers_correct($clue_id) {
        global $connection;

        $clue_id_param = $connection->escape_string($clue_id);
        $sql = "SELECT * FROM answers WHERE clue_id='$clue_id_param'";

        $result = $this->query($sql);

        $answers = array();
        foreach ($result as $answer) {
            $answer_object = new stdClass();
            $answer_object->answer_id = $answer['answer_id'];
            $answer_object->answer = $answer['answer'];
            $answer_object->correct = $answer['correct'] == "0" ? false : true;
            $answers[] = $answer_object;
        }
        return $answers;
    }

    /**
     * Fetches all answers pertaining to a clue
     *
     * @param   string  $clue_id    An id that represents a clue
     * @return  array
     */
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

    /**
     * Creates an answer and adds it to the database
     *
     * @param   string  $clue_id  The id that represents a clue
     * @param   object  $answer Represents a json object with answer & correct fields
     * @return  bool
     */
    public function create_answer($clue_id, $answer) {
        global $connection;

        $clue_id_param = $connection->escape_string($clue_id);
        $answer_param = $connection->escape_string($answer->answer);
        $correct_param = $connection->escape_string($answer->correct);
        $sql = "INSERT INTO answers (clue_id, answer, correct) VALUES ('$clue_id_param', '$answer_param', '$correct_param')";

        $result = $this->general_query($sql);
        return $result;
    }

    /**
     * Given an answer id, removes an answer from the database
     *
     * @param   string  $answer_id  The id that represents an answer
     * @return  bool
     */
    public function remove_answer($answer_id) {
        global $connection;

        $answer_id_param = $connection->escape_string($answer_id);
        $sql = "DELETE FROM answers WHERE answer_id='$answer_id_param'";

        $result = $this->general_query($sql);
        return $result;
    }

    /**
     * Fetches all clues from the database, for all buildings
     *
     * @return  object
     */
    public function get_all_clues() {
        global $connection;

        $sql = "SELECT * FROM clues";

        $result = $this->query($sql);

        $clues = array();
        foreach ($result as $clue) {
            $clue_object = new stdClass();
            $clue_object->clue_id = $clue['clue_id'];
            $clue_object->clue = $clue['clue'];
            $clue_object->answers = $this->get_answers_correct($clue['clue_id']);

            $clues[] = $clue_object;
        }
        return $clues;
    }

    /**
     * Fetches all clues from the database linked to a building id
     *
     * @param   string  $building_id    The id that represents a building in the clues table
     * @return  object
     */
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
            shuffle($clue_object->answers);

            $clues[] = $clue_object;
        }
        return $clues;
    }

    /**
     * Creates a clue given a building id and a clue object
     *
     * @param   object  $clue   A class representing a json object with building_id, clue, answers as its fields
     * @return  bool
     */
    public function create_clue($building_id, $clue) {
        global $connection;

        $building_id_param = $connection->escape_string($building_id);
        $clue_param = $connection->escape_string($clue->clue);
        $sql = "INSERT INTO clues (building_id, clue) VALUES ('$building_id_param', '$clue_param')";

        $result = $this->general_query($sql);

        $clue_id = $connection->insert_id;
        foreach ($clue->answers as $answer) {
            $this->create_answer($clue_id, $answer);
        }
        return $result;
    }

    /**
     * Given a clue id, removes a clue from the database, as well as any answers attached to it
     *
     * @param   string  $clue_id Represents the id of a clue
     * @return  bool
     */
    public function remove_clue($clue_id) {
        global $connection;

        // when removing a clue, all it's answers need to
        // also be removed
        foreach ($this->get_answers($clue_id) as $answer) {
            $this->remove_answer($answer->answer_id);
        }

        $clue_id_param = $connection->escape_string($clue_id);
        $sql = "DELETE FROM clues WHERE clue_id='$clue_id_param'";

        $result = $this->general_query($sql);
        return $result;
    }

    /**
     * Given an answer's id, checks to see whether the value of the 'correct' column is true or false
     *
     * @param   string  $answer_id   Represents the answer_id column for a row in the 'answers' table
     * @return  bool
     */
    public function verify_answer($answer_id) {
        global $connection;

        $answer_id_param = $connection->escape_string($answer_id);
        $sql = "SELECT * FROM answers WHERE answer_id='$answer_id_param' LIMIT 1";

        $result = $this->query($sql);
        return $result[0]['correct'] == 0 ? false : true;
    }

    /**
     * Fetches all FAQs from the database
     *
     * @return object
     */
    public function get_faqs() {
        global $connection;

        $sql = "SELECT * FROM faq";

        $result = $this->query($sql);

        $faqs = array();
        foreach ($result as $faq) {
            $faq_object = new stdClass();
            $faq_object->faq_id = $faq['faq_id'];
            $faq_object->question = $faq['question'];
            $faq_object->answer = $faq['answer'];

            $faqs[] = $faq_object;
        }
        return $faqs;
    }

    /**
     * Creates a FAQ
     *
     * @param   object  $faq A class representing a json object with question & answer properties
     * @return  bool
     */
    public function create_faq($faq) {
        global $connection;

        $question_param = $connection->escape_string($faq->question);
        $answer_param = $connection->escape_string($faq->answer);
        $sql = "INSERT INTO faq (question, answer) VALUES ('$question_param', '$answer_param')";

        $result = $this->general_query($sql);
        return $result;
    }

    /**
     * Removes a FAQ from the database, given its id
     *
     * @param   string  $faq_id An id which represents a row in the FAQ table
     * @return  bool
     */
    public function remove_faq($faq_id) {
        global $connection;

        $faq_id_param = $connection->escape_string($faq_id);
        $sql = "DELETE FROM faq WHERE faq_id='$faq_id_param'";

        $result = $this->general_query($sql);
        return $result;
    }

    /**
     * Checks to see if an account exists in the database
     *
     * @param   object  $account A class representing a json object with username & password properties
     * @return  bool
     */
    public function verify_account($account) {
        global $connection;

        $username_param = $connection->escape_string($account->username);
        $password_param = $connection->escape_string($account->password);
        $sql = "SELECT * FROM game_keepers WHERE username='$username_param' AND `password`='$password_param' LIMIT 1";

        $result = $this->query($sql);
        return count($result) == 1;
    }

    public function exists_user($user) {
        global $connection;

        $team_name_param = $connection->escape_string($user->team_name);
        $sql = "SELECT * FROM users WHERE team_name='$team_name_param' LIMIT 1";

        $result = $this->query($sql);
        return count($result) == 1;
    }

    public function create_user($user) {
        global $connection;

        if ($this->exists_user($user)) {
            return FALSE;
        }

        $team_name_param = $connection->escape_string($user->team_name);
        $department_id_param = $connection->escape_string($user->department_id);
        $building_id = $this->get_route($user->department_id)[0]->building_id;
        $sql = "INSERT INTO users (team_name, department_id, current_building_id) VALUES ('$team_name_param', '$department_id_param', '$building_id')";

        $result = $this->general_query($sql);

        $user_object = new stdClass();
        $user_object->user_id = $connection->insert_id;
        return $user_object;
    }

    public function get_all_tracking() {
        global $connection;

        $sql = "SELECT * FROM `users` WHERE `completed`=0";

        $result = $this->query($sql);
        $users = array();
        foreach ($result as $user) {
            $user_object = new stdClass();
            $user_object->user_id = $user['user_id'];
            $user_object->team_name = $user['team_name'];
            $user_object->department = $this->get_department($user['department_id']);
            $user_object->current_building = $this->get_building($user['current_building_id']);
            $user_object->score = $user['score'];

            $users[] = $user_object;
        }
        return $users;
    }

    public function update_tracking($tracking) {
        global $connection;

        $user_id_param = $connection->escape_string($tracking->user_id);
        $building_id_param = $connection->escape_string($tracking->building_id);
        $sql = "UPDATE `users` SET `current_building_id`='$building_id_param' WHERE `user_id`='$user_id_param'";

        $result = $this->general_query($sql);
    }

    public function get_score($user_id) {
        global $connection;

        $user_id_param = $connection->escape_string($user_id);
        $sql = "SELECT * FROM `users` WHERE `user_id`='$user_id_param'";

        $result = $this->query($sql);

        foreach ($result as $user) {
            $user_object = new stdClass();
            $user_object->score = (int)($user['score']);
            return $user_object;
        }
        return FALSE;
    }

    public function update_score($user) {
        global $connection;

        $score = 60000/($user->seconds);
        if ($score > 1000) {
            $score = 1000;
        }
        if ($user->attempts == 0) {
            $score += 1000;
        } else {
            $score += 1000/(1.25 * $user->attempts);
        }

        $user_id_param = $connection->escape_string($user->user_id);
        $score_param = $connection->escape_string($score);
        $sql = "UPDATE `users` SET `score`=score+$score_param WHERE `user_id`='$user_id_param'";

        $result = $this->general_query($sql);
        return $result;
    }

    public function reset_user($user_id) {
        global $connection;

        $user_id_param = $connection->escape_string($user_id);
        $sql = "UPDATE `users` SET `score`=0, `completed`=0 WHERE `user_id`='$user_id_param'";

        $result = $this->general_query($sql);
        return $result;
    }

    public function set_completed_user($user_id) {
        global $connection;

        $user_id_param = $connection->escape_string($user_id);
        $sql = "UPDATE `users` SET `completed`=1 WHERE `user_id`='$user_id_param'";

        $result = $this->general_query($sql);
        return $result;
    }

    public function get_leaderboard($department_id) {
        global $connection;

        $department_id_param = $connection->escape_string($department_id);
        $sql = "SELECT * FROM `users` WHERE `department_id`='$department_id_param' AND `completed`=1 ORDER BY score DESC LIMIT 25";

        $result = $this->query($sql);

        $users = array();
        foreach ($result as $user) {
            $user_object = new stdClass();
            $user_object->team_name = $user['team_name'];
            $user_object->score = $user['score'];

            $users[] = $user_object;
        }
        return $users;
    }

    public function get_leaderboard_position($user_id, $department_id) {
        global $connection;

        $user_id_param = $connection->escape_string($user_id);
        $department_id_param = $connection->escape_string($department_id);
        $sql = "SELECT `user_id`, `score` FROM `users` WHERE `department_id`='$department_id_param' AND `completed`=1 ORDER BY `score` DESC";

        $result = $this->query($sql);

        $user_object = new stdClass();
        $i = 0;
        foreach ($result as $user) {
            $i++;
            if ($user['user_id'] == $user_id) {
                $user_object->position = (int)$i;
                return $user_object;
            }
        }
        return false;
    }

    /**
     * Executes a query from an SQL statement which requires rows to be returned,
     * e.g. SELECT
     *
     * @param   string  $sql The SQL statement to execute
     * @return  array
     */
    private function query($sql) {
        global $connection;

        $result = $connection->query($sql);
        if (!$result) {
            die($connection->error);
        }

        // builds an array of all results from the query
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    /**
     * Executes a query from an SQL statement that requires no rows to be returned,
     * e.g. INSERT, DELETE, etc.
     *
     * @param   string  $sql The SQL statement to execute
     * @return  bool
     *
     */
    private function general_query($sql) {
        global $connection;

        $result = $connection->query($sql);
        if (!$result) {
            die($connection->error);
        }

        return $result;
    }

    /**
     * Closes the connection to the database
     */
    public function close() {
        global $connection;

        $connection->close();
    }
}
?>
