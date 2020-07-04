<?PHP
namespace Tools;

use \PDO;
use \PDOException;

class Database
{
    private $dbname = "";

    public function __construct($db_name = DB_NAME)
    {
        $this->dbname = $db_name;
    }

    private function connect()
    {
        try {
            $conn = new PDO(
                "mysql:host=" . DB_SERVERNAME . ";dbname=$this->dbname",
                DB_USERNAME,
                DB_PASSWORD
            );
            $conn->exec("set names utf8");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return array(
                "isQuery" => true,
                "result" => $conn,
            );
        } catch (PDOException $e) {
            return array(
                "isQuery" => false,
                "result" => $e->getMessage(),
            );
        }
    }

    public function query($sql_command)
    {
        $db = $this->connect();
        if ($db['isQuery']) {
            try {
                $conn = $db['result'];
                $stmt = $conn->prepare($sql_command);
                $result = $stmt->execute();
                $db = null;
                try {
                    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    return array(
                        "isQuery" => true,
                        "result" => $stmt->fetchAll(),
                        "rowCount" => $stmt->rowCount(),
                        "colCount" => $stmt->columnCount(),
                    );
                } catch (PDOException $e) {
                    return array(
                        "isQuery" => true,
                        "result" => $result,
                        "rowCount" => $stmt->rowCount(),
                        "colCount" => $stmt->columnCount(),
                    );
                }
            } catch (PDOException $e) {
                return array(
                    "isQuery" => false,
                    "result" => $e->getMessage(),
                );
            }
        } else {
            return $db;
        }
    }
}
