<?php
require_once("init.php");

class GetRealTimeSnapShot extends Request
{
    public function __construct($name)
    {
        parent::__construct("snapshot.getRealTimeSnapShot", [
            "name" => $name
        ]);
    }
}

class GetBWSnapShotForUser extends Request
{
    public function __construct($user_id, $ras_ip, $unique_id_val)
    {
        parent::__construct("snapshot.getBWSnapShotForUser", [
            "user_id" => $user_id,
            "ras_ip" => $ras_ip,
            "unique_id_val" => $unique_id_val
        ]);
    }
}

class GetOnlinesSnapShot extends Request
{
    public function __construct($conds, $type)
    {
        parent::__construct("snapshot.getOnlinesSnapShot", [
            "conds" => $conds,
            "type" => $type
        ]);
    }
}

class GetBWSnapShot extends Request
{
    public function __construct($conds)
    {
        parent::__construct("snapshot.getBWSnapShot", [
            "conds" => $conds
        ]);
    }
}

