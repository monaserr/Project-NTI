<?php

class Connect
{
    private const host_name = "localhost";
    private const user_name = "root";
    private const password = "ةهىش2006";
    private const db = "tech_journey";

    private $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect(
            self::host_name,
            self::user_name,
            self::password,
            self::db
        );
    }

    public function insert(array $post, string $table): bool
    {
        $cloms = [];
        $values = [];

        foreach ($post as $key => $value) {
            $cloms[] = $key;
            $values[] = "'" . $value . "'";
        }

        $clomsString = implode(',', $cloms);
        $valuesString = implode(',', $values);

        if (
            $this->conn->query(
                "INSERT INTO $table ($clomsString) VALUES ($valuesString)"
            )
        ) {
            return true;
        }

        return false;
    }

    public function select($table): array
    {
        $rows = $this->conn->query("SELECT * FROM $table");

        if ($rows->num_rows > 0) {
            return $rows->fetch_all(MYSQLI_ASSOC);
        }

        return [];
    }

    public function selectOne(string $table, int $id): array
    {
        $row = $this->conn->query("SELECT * FROM $table WHERE id = $id limit 1");
        if ($row->num_rows > 0) {
            $data = $row->fetch_assoc();
            return $data;
        }
        return [];
    }


    public function update(array $post, string $table, int $id): bool
    {
        $fieldValue = [];
        foreach ($post as $key => $value) {
            $fieldValue[] = "$key = '$value'";
        }
        // print_r($fieldValue);
        $fieldValueString = implode(',', $fieldValue);
        // print "<br>"$fieldValue;
        // print_r($post);
        // $this->con->query("UPDATE $table set 'user_name = value ,email = value ,password = vlue' where $id ");
        if ($this->conn->query("UPDATE $table set $fieldValueString where id=$id"))
            return true;
        return false;
    }

    public function login(string $email, string $password): array
    {

        $row = $this->conn->query("SELECT * FROM client where email='$email'  and  password = '$password' ");
        if ($row->num_rows > 0) {
            $data = $row->fetch_assoc();
            return $data;
        }
        return [];
    }

    public function count(string $table, string $column): int
    {
        $row = $this->conn->query("SELECT COUNT(DISTINCT $column) as total FROM $table");
        $data = $row->fetch_assoc();
        return (int) $data['total'];
    }

    public function delete(string $table, int $id): bool
    {
        if ($this->conn->query("DELETE FROM $table WHERE id = $id"))
            return true;
        return false;
    }
}

$conn = mysqli_connect("localhost", "root", "ةهىش2006", "tech_journey");
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8mb4");
?>