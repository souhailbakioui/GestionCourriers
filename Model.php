                                                  
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
        $data = (array) $this;
        $req = "";
        $fields = $values = "";
        if ($this->id == 0) {
            
            $req = "insert into " . get_class($this) . "(";
            foreach ($data as $key => $value)
                if ($key != "id") {
                    $fields .= $key . ',';
                    $values .= "'" . $value . "',";
                }
            $fields = substr($fields, 0, -1);
            $values = substr($values, 0, -1);
            $req .= $fields . ') values(' . $values . ')';
            self::$pdo->exec($req);
            echo $req;
        } 
        else {
            $req="update ".get_class($this)." set ";
            foreach ($data as $key => $value)
                if ($key != "id") {
                        $req.=" $key = '$value' ,";
                }
            $req = substr($req, 0, -1);
            $values = substr($values, 0, -1);
            echo $req;

            self::$pdo->exec($req);
        }

    }


    public function delete()
    {
        try {
            if (isset($this->id) && $this->id > 0) {
                $req = "delete from " . get_class($this) . " where id=" . $this->id;
                self::$pdo->exec($req);
            }
        } catch (Exception $ex) {
            echo "Delete Not Completed Please recheck";
        }
        
    }


    public static function find($id)
    {
        $req = "";
        try {
            if (isset($id) && $id > 0) {
                $req = "select * from " . get_called_class() . " where id=" . $id;
                self::$pdo->query($req)->fetch();
            }
        } catch (Exception $ex) {
            echo "fetch $id Not Completed Please recheck";
        }
    }


    public static function All()
    {
        $req = "";
        try {

            $req = "select * from " . get_called_class();
            echo $req;
           self::$pdo->query($req)->fetch();
        } catch (Exception $ex) {
            echo "fetch all Not Completed Please recheck";
        }
    }
}
?>