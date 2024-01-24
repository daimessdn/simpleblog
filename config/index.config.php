<?php

session_start();

$host = "localhost";
$dbname = "simpleblog";

$username = "root";
$password = "";

// init mysql connection
$conn = new PDO(
    "mysql:host=$host;dbname=$dbname;",
    $username,
    $password
);

class Model
{
    public $connection;
    public $table;
    public $property;

    function __construct($conn, $table, $property)
    {
        $this->connection = $conn;

        $this->table = $table;
        $this->property = $property;
    }

    function to_str($param)
    {
        return "\"" . $param . "\"";
    }

    function exec($query)
    {
        $exec_ = $this->connection->prepare($query);
        $exec_->execute();
    }

    function fetch($query)
    {
        $fetch_ = $this->connection->query($query);
        return $fetch_->fetchAll(PDO::FETCH_ASSOC);
    }

    function create_table_query()
    {
        $query = "";
        $model_query = "";

        $params = $this->property;

        for ($i = 0; $i < count($params); $i++) {
            $params_i = $params[$i];

            $model_query .= $params_i["name"] . " " . $params_i["type"] . " ";



            foreach ($params_i as $param => $val) {
                if ($param == "null") {
                    $model_query .= $val ? "NULL " : "NOT NULL ";
                } else if ($param == "auto_increment") {
                    $model_query .= $val ? "AUTO_INCREMENT, PRIMARY KEY (" . $params_i["name"] . ")" : " ";
                } else if ($param == "default") {
                    switch ($val) {
                        case "current_timestamp":
                            $val = "CURRENT_TIMESTAMP";
                            break;
                        default:
                            $val = $this->to_str($val);
                    }
                    $model_query .= "DEFAULT " . $val;
                }
            }

            $model_query .= $i < count($params) - 1 ? ", " : "";
        }

        $query = "CREATE TABLE IF NOT EXISTS " . $this->table . " (" . $model_query . ");";

        $this->exec($query);
    }

    public function insert($params)
    {
        $query = "";

        $keys_assoc = array_keys($params);

        $keys = "";
        $values = "";

        for ($i = 0; $i < sizeof($keys_assoc); $i++) {
            $key = $keys_assoc[$i];
            $val = $params[$keys_assoc[$i]];

            $keys .= $key . (
                $i < (sizeof($keys_assoc) - 1) ? ", " : ""
            );

            $values .= (
                $key == "password" ?
                $this->to_str(password_hash($val, PASSWORD_DEFAULT))
                :
                (
                    is_string($val) ? $this->to_str($val) : $val)
            ) . (
                $i < (sizeof($keys_assoc) - 1) ? ", " : ""
            );
        }

        $query = "INSERT INTO " . $this->table . " (" . $keys . ") VALUES (" . $values . ");";
        $this->exec($query);
    }

    public function select_all($params = [], $limit = -1, $offset = -1)
    {
        $table = $this->table;

        $where = "";
        $limit = $limit > 0 ? " LIMIT $limit" : "";
        $offset = $offset > 0 ? " OFFSET $offset" : "";

        $keys_assoc = array_keys($params);
        $keys_size = sizeof($keys_assoc);

        if ($keys_size > 0) {
            $where = " WHERE ";

            for ($i = 0; $i < $keys_size; $i++) {
                $key = $keys_assoc[$i];
                $val = $params[$keys_assoc[$i]];

                $where .= $key . " = " . (is_string($val) ? $this->to_str($val) : $val);

                if ($i != ($keys_size - 1)) {
                    $where .= " AND ";
                }
            }
        }

        $query = "SELECT * FROM " . $table . $where . $limit . $offset . ";";

        return $this->fetch($query);
    }

    public function check_is_empty($params = [], $limit = -1, $offset = -1)
    {
        $data = $this->select_all($params = [], $limit = -1, $offset = -1);

        return sizeof($data) == 0;
    }
}

class UserModel extends Model
{
    public function verify_password($username, $password) {
        $hashed_password = $this->select_all([
            "username" => $username]
        )[0]["password"];

        return password_verify($password, $hashed_password);
    }

    public function check_user_exists($username) {
        $users = $this->select_all([
            "username"=> $username,
        ]);

        return sizeof($users) > 0;
    }
}

class PostModel extends Model
{

}

if ($conn == true) {
    /*
        DOKUMENTASI USER
        
        - role: menggambarkan peranan user
            - 1: administrator
            - 2: kontributor
    */

    $user = new UserModel($conn, "users", [
        ["name" => "id", "type" => "int", "null" => false, "auto_increment" => true],
        ["name" => "name", "type" => "varchar(100)", "null" => true, "default" => ""],
        ["name" => "role", "type" => "int", "null" => false],
        ["name" => "username", "type" => "varchar(50)", "null" => false],
        ["name" => "email", "type" => "varchar(200)", "null" => false],
        ["name" => "password", "type" => "varchar(100)", "null" => false],
        ["name" => "created_at", "type" => "datetime", "null" => false, "default" => "current_timestamp",],
        ["name" => "updated_at", "type" => "datetime", "null" => true,],
    ]);

    /*
        DOKUMENTASI POST
        
        - category: menggambarkan kategori post
            - 0: belum ada kategori
            - 1: artikel
            - 2: blog
            - 3: berita
            - 4: portfolio
        
        - status: menggambarkan status post
            - 0: draft,
            - 1: published
    */

    $post = new PostModel($conn, "posts", [
        ["name" => "id", "type" => "int", "null" => false, "auto_increment" => true],
        ["name" => "title", "type" => "varchar(200)", "null" => false,],
        ["name" => "category", "type" => "int", "null" => false,],
        ["name" => "status", "type" => "int", "null" => false,],
        ["name" => "post", "type" => "text", "null" => false,],
        ["name" => "published_at", "type" => "datetime", "null" => true,],
        ["name" => "created_at", "type" => "datetime", "null" => false, "default" => "current_timestamp",],
        ["name" => "updated_at", "type" => "datetime", "null" => true,],
    ]);

    // buat table users
    $user->create_table_query();

    // buat user admin pertama
    if ($user->check_is_empty()) {
        $user->insert([
            "name" => "Ini Admin",
            "username" => "admin",
            "email" => "admin@example.com",
            "password" => "123",
            "role" => 1,
        ]);
        $user->insert([
            'name' => 'Om Burhan',
            'email' => 'burhan@example.com',
            'username' => 'om_burhan',
            'password' => "123",
            'role' => 2,
        ]);
    }

    // buat table postingan
    $post->create_table_query();

    // membuat postingan pertama
    if ($post->check_is_empty()) {
        $post->insert([
            'title' => 'Hello, world',
            'category' => 0,
            'post' => 'Added the first post on simpleblog.',
            'status' => 1,
            'published_at' => date("Y-m-d H:i:s"),
        ]);

        header("location:./pages/auth/login.php");
    }
}
