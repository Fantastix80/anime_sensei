<?php

// This constant contains the database credentials
const DB_NAME = "anime_sensei";
const DB_HOST = "localhost";
const DB_USERNAME = "root";
const DB_PASSWORD = "";

// This class contains all the methods to retrieve data from the database
class Database {
    public $pdo;

    // The constructor will create a link to the database and will set it to the attribute pdo
    public function __construct() {
        $this->pdo = new PDO("mysql:dbname=".DB_NAME.";host=".DB_HOST,DB_USERNAME, DB_PASSWORD);
    }

    // This methods takes the name of the table and will return you all the data from it
    public function findAll(string $table)
    {
        $query = "SELECT * FROM $table";

        $data = $this->pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function findAllLike(string $table, array $data)
    {
        $sqlFields = [];
        foreach ($data as $key => $value) {
            $sqlFields[] = "$key LIKE :$key";
        }

        $query = $this->pdo->prepare("SELECT * FROM $table WHERE " . implode(" OR ", $sqlFields));
        $query->execute($data);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // This method takes the name of the table and the id of what you wants to get the informations of (assuming the field you want to search in is called id)
    public function find(string $table, int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM $table WHERE id = :id ");
        $query->execute(["id" => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // This method takes the name of the table, the name of the field to search in and the value to research. This doesn't use a prepare execute methods because we aren't using forms input on this method so the data we give it are safe.
    public function findWhere(string $table, string $where, string $value)
    {
        $query = $this->pdo->query("SELECT * FROM $table WHERE $where = '$value'");
        return $query;
    }

    // This method takes the name of the table and an array to add a new line into the database. The array has a key (the name of the field in the database) and a value (the value to assign).
    public function create(string $table, array $data)
    {
        $sqlFields = [];

        foreach ($data as $key => $value) {
            $sqlFields[] = "$key = :$key";
        }

        $query = $this->pdo->prepare("INSERT INTO $table SET " . implode(", ", $sqlFields));
        if (!$query->execute(array_merge($data))){
            alert("error", "Erreur de la base de donnée.");
        }
    }

    // This method takes the name of the table, an array and an id where to update the line into the database. The array has a key (the name of the field in the database) and a value (the value to assign).
    public function update(string $table, array $data, int $id)
    {
        $sqlFields = [];
        foreach ($data as $key => $value){
            $sqlFields[] = "$key = :$key";
        }
        $query = $this->pdo->prepare("UPDATE $table SET " . implode(", ", $sqlFields) .
            " WHERE id = :id");
        if (!$query->execute(array_merge($data, ["id" => $id]))){
            alert("error", "Erreur de base de donnée");
        }
    }

    // This method takes the name of the table and the id to delete (assuming the field name is id)
    public function delete(string $table, int $id)
    {
        $query = $this->pdo->prepare("DELETE FROM ". $table . " WHERE id = ?");
        if (!$query->execute([$id])){
            alert("error", "Erreur de base de donnée."); 
        }
    }

    // This method takes the name of the table and an array (useful to delete from a table with multiple primary keys)
    public function deleteMultipleKey(string $table, array $data)
    {
        $sqlFields = [];
        foreach ($data as $key => $value){
            $sqlFields[] = "$key = :$key";
        }
        $query = $this->pdo->prepare("DELETE FROM ". $table . " WHERE " . implode(" AND ", $sqlFields));

        foreach ($data as $key => $value) {
            $query->bindValue(":$key", $value, PDO::PARAM_INT);
        }

        if (!$query->execute()){
            alert("error", "Erreur de base de donnée.");            
        }
    }

    // This method is like a findwhere but it won't return the data, only a boolean
    public function Exist(string $table, string $where, string $value)
    {
        $exist = false;
        $data = $this->findWhere($table, $where, $value)->rowCount();
        if ($data > 0){
            $exist = true;
        }
        return $exist;
    }

    // This method will return you the id of the last inserted things into the database. Useful to get the id of the last new user (to add it to the session to prevent the user to have to re login after signing in)
    public function getLastIdInserted()
    {
        return $this->pdo->query("SELECT LAST_INSERT_ID()")->fetch(PDO::FETCH_ASSOC);
    }

    // This method contains a special sql query so it just takes an id
    public function getTagsNameOfAnime(int $id) {
        $query = $this->pdo->prepare("SELECT * FROM animes_tags JOIN tags ON animes_tags.id_tag = tags.id WHERE animes_tags.id_anime = :id");
        $query->execute(["id" => $id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // This method allows you to know if the anime is in the user watchlist. It just returns a boolean
    public function isInWatchlist(int $id_user, int $id_anime)
    {
        $exist = false;
        $data = $this->pdo->query("SELECT id_anime FROM watchlist WHERE id_user = $id_user AND id_anime = $id_anime")->rowCount();
        if ($data > 0){
            $exist = true;
        }
        return $exist;
    }

    // This method will return you all the anime in the user watchlist. You can add an optionnal parameter to say if you want to get all the animes or just the ones the user has finished watching
    public function findAnimesInWatchlist(int $id, bool $getDateEndNull = true)
    {
        if($getDateEndNull) {
            $sql = "SELECT * FROM watchlist JOIN animes ON watchlist.id_anime = animes.id WHERE watchlist.id_user = :id AND watchlist.date_end_watching IS NULL";
        } else {
            $sql = "SELECT * FROM watchlist JOIN animes ON watchlist.id_anime = animes.id WHERE watchlist.id_user = :id AND watchlist.date_end_watching IS NOT NULL";
        }
        $query = $this->pdo->prepare($sql);
        $query->execute(["id" => $id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findAnimesInWatchlistLike(int $id, array $data, bool $getDateEndNull = true)
    {
        $sqlFields = [];
        foreach ($data as $key => $value) {
            $sqlFields[] = "$key LIKE :$key";
        }

        if($getDateEndNull) {
            $sql = "SELECT * FROM watchlist JOIN animes ON watchlist.id_anime = animes.id WHERE watchlist.id_user = :id AND watchlist.date_end_watching IS NULL AND (" . implode(" OR ", $sqlFields) . ")";
        } else {
            $sql = "SELECT * FROM watchlist JOIN animes ON watchlist.id_anime = animes.id WHERE watchlist.id_user = :id AND watchlist.date_end_watching IS NOT NULL AND (" . implode(" OR ", $sqlFields) . ")";
        }
        
        $query = $this->pdo->prepare($sql);
        $query->execute(array_merge($data, ["id" => $id]));

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // This method allows you to get the information that a user set on a specific anime
    public function getAnimeInfoOfUser(int $id_user, int $id_anime)
    {
        $query = $this->pdo->prepare("SELECT * FROM watchlist WHERE id_user = :id_user AND id_anime = :id_anime");
        $query->execute(["id_user" => $id_user, "id_anime" => $id_anime]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // This method allows you to update the watchlist (Because this tables have multiple primary keys so we can't use the update function)
    public function updateWatchlist(array $data, int $id_user, int $id_anime)
    {
        $sqlFields = [];
        foreach ($data as $key => $value){
            $sqlFields[] = "$key = :$key";
        }
        $query = $this->pdo->prepare("UPDATE watchlist SET " . implode(", ", $sqlFields) .
            " WHERE id_user = :id_user AND id_anime = :id_anime");

        if (!$query->execute(array_merge($data, ["id_user" => $id_user, "id_anime" => $id_anime]))){
            alert("error", "Erreur de base de donnée.");
        }
    }
}

?>