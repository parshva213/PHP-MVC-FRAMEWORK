<?php

namespace models;

use core\Application;
use core\UpdateUser;
use PDO;

class ForgetPasswordChange extends UpdateUser
{

    public string $identifier = "";
    public string $password = "";
    public string $conform_password = "";

    public array $rule = [
        'identifier' => [self::RULE_REQUIRED],
        'val' => [self::RULE_REQUIRED],
        'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 24]],
        'conform_password' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
    ];

    public array $attributes = ['password'];

    public function __construct()
    {
        if (isset($_POST['identifier']))
            $this->identifier = trim($_POST['identifier']);
        if (isset($_POST['val']))
            $this->val = trim($_POST['val']);
        if (isset($_POST['password']))
            $this->password = trim($_POST['password']);
        if (isset($_POST['conform_password']))
            $this->conform_password = trim($_POST['conform_password']);
    }

    public static function tableNAME(): string
    {
        return 'ausers';
    }
    public function attributes(): array
    {
        return $this->attributes;
    }
    public static function primaryKey(): string
    {
        return 'uid';
    }

    public function rules(): array
    {
        return $this->rule;;
    }

    public function save()
    {
        // array_push($this->attributes, $this->identifier);
        if ($this->validate()) {
?>
            <script>
                console.log("validate")
            </script>
<?php
            $db = Application::$app->db->pdo;
            // echo "<pre>";
            // var_dump($this->identifier . "=====" . $this->val);
            // echo "</pre>";
            // exit();

            $user = $db->query("SELECT * from ausers where $this->identifier = '$this->val' ")->fetchAll(PDO::FETCH_ASSOC);
            if ($user) {
                // echo "<pre>";
                // var_dump($user);
                // echo "</pre>";
                // exit();
                $user = $user[0]['uid'];
                $password = md5($this->password);
                $statement = $db->prepare("UPDATE ausers SET password = :password WHERE uid = :uid");
                $statement->bindValue(':password', $password);  // Or use hashed value
                $statement->bindValue(':uid', $user);                // Use your UID variable
                return $statement->execute();
            } else {
                $this->addError('val', self::RULE_MATCH, ['match' => 'stored password']);
                return false;
            }
        } else {
            return false;
        }
        return false;
    }
}
