                                                  
<?php
abstract class Model
{
    public $id = 0;
    // déclaration d'une variable qui va contenir des objets PDO
    private static $pdo = null;

    public function __construct()
    {
        if (self::$pdo == null) {
            $chemin = substr($_SERVER['SCRIPT_FILENAME'], 0, -9);
            $fichier = file($chemin . ".env");
            $server = trim(explode('=', $fichier[1])[1]);
            $dbname = trim(explode('=', $fichier[3])[1]);
            $user = trim(explode('=', $fichier[4])[1]);
            $password = trim(explode('=', $fichier[5])[1]);
            self::$pdo = new PDO(
                'mysql:host=' . $server . ';dbname=' . $dbname,
                $user,
                $password
            );
        }
    }


    public function save()
    {
        var_dump($this);
        $data = (array) $this;
        $req = "";
        if ($this->id == 0) {
            $fields = $values = "";
            $req = "insert into " . get_class($this) . "(";
            foreach ($data as $key => $value)
                if ($key != "id") {
                    $fields .= $key . ',';
                    $values .= "'" . $value . "',";
                }
            $fields = substr($fields, 0, -1);
            $values = substr($values, 0, -1);
            $req .= $fields . ') values(' . $values . ')';
        } else {
        }
        self::$pdo->exec($req);
    }


    public function delete()
    {
        try {
            if (isset($this->id) && $this->id > 0) {
                $req = "delete from " . get_class($this) . " where id=" . $this->id;
                echo $req;
            }
        } catch (Exception $ex) {
            echo "Delete Not Completed Please recheck";
        }
        self::$pdo->exec($req);
    }


    public static function find($id)
    {   
      
       
        try {
            if (isset($id) && $id > 0) {
                $req = "select * from " . get_called_class() . " where id=" . $id;
                echo $req;
            }
        } catch (Exception $ex) {
            echo "Delete Not Completed Please recheck";
        }
        //self::$pdo->exec($req);
    }


    public static function All()
    {
    }
}
?>