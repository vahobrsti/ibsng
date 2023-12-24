<?php
require_once("init.php");

class AddNewUsers extends Request
{
    public function __construct($count, $credit, $owner_name, $group_name, $credit_comment)
    {
        $params = [
            "count" => $count,
            "credit" => $credit,
            "owner_name" => $owner_name,
            "group_name" => $group_name,
            "credit_comment" => $credit_comment
        ];

        parent::__construct("user.addNewUsers", $params);
    }
}

class GetUserInfo extends Request
{
    public function __construct($user_id = null, $normal_username = null, $voip_username = null)
    {
        $request = $this->buildRequestArray($user_id, $normal_username, $voip_username);
        parent::__construct("user.getUserInfo", $request);
    }

    protected function buildRequestArray($user_id, $normal_username, $voip_username): array
    {
        if (!is_null($user_id)) {
            return ["user_id" => $user_id];
        } elseif (!is_null($normal_username)) {
            return ["normal_username" => $normal_username];
        } elseif (!is_null($voip_username)) {
            return ["voip_username" => $voip_username];
        } else {
            return [];
        }
    }
}

class UpdateUserAttrs extends Request
{
    public function __construct($user_id, $attrs, $to_del_attrs)
    {
        parent::__construct("user.updateUserAttrs", [
            "user_id" => $user_id,
            "attrs" => $attrs,
            "to_del_attrs" => $to_del_attrs
        ]);
    }
}

class CheckNormalUsernameForAdd extends Request
{
    public function __construct($username, $current_username)
    {
        parent::__construct("normal_user.checkNormalUsernameForAdd", [
            "normal_username" => $username,
            "current_username" => $current_username
        ]);
    }
}

class CheckVoIPUsernameForAdd extends Request
{
    public function __construct($username, $current_username)
    {
        parent::__construct("voip_user.checkVoIPUsernameForAdd", [
            "voip_username" => $username,
            "current_username" => $current_username
        ]);
    }
}

class ChangeUserCredit extends Request
{
    public function __construct($user_id, $credit, $credit_comment)
    {
        parent::__construct("user.changeCredit", [
            "user_id" => $user_id,
            "credit" => $credit,
            "credit_comment" => $credit_comment
        ]);
    }
}

class DelUser extends Request
{
    public function __construct($user_id, $comment, $del_connection_logs, $del_audit_logs)
    {
        parent::__construct("user.delUser", [
            "user_id" => $user_id,
            "delete_comment" => $comment,
            "del_connection_logs" => $del_connection_logs,
            "del_audit_logs" => $del_audit_logs
        ]);
    }
}

class KillUser extends Request
{
    public function __construct($user_id, $ras_ip, $unique_id_val, $kill)
    {
        parent::__construct("user.killUser", [
            "user_id" => $user_id,
            "ras_ip" => $ras_ip,
            "unique_id_val" => $unique_id_val,
            "kill" => $kill
        ]);
    }
}

class SearchAddUserSaves extends Request
{
    public function __construct(&$conds, $from, $to, $order_by, $desc)
    {
        parent::__construct("addUserSave.searchAddUserSaves", [
            "conds" => $conds,
            "from" => $from,
            "to" => $to,
            "order_by" => $order_by,
            "desc" => $desc
        ]);
    }
}

class DeleteAddUserSaves extends Request
{
    public function __construct($add_user_save_ids)
    {
        parent::__construct("addUserSave.deleteAddUserSaves", [
            "add_user_save_ids" => $add_user_save_ids
        ]);
    }
}

function getUsersInfoByUserID(&$smarty,$user_ids)
{/*return a list of user_infos of users with id in $user_ids
 */
    if (empty($user_ids)) {
        return [];
    }

    $req = new GetUserInfo(join(",", $user_ids));
    $resp = $req->sendAndRecv();
    if ($resp->isSuccessful()) {
        return $resp->getResult();
    } else {
        $resp->setErrorInSmarty($smarty);
        return [];
    }
}

class ChangeNormalPassword extends Request
{
    protected $password1;
    protected $password2;

    public function __construct($username, $password1, $password2, $old_password = "")
    {
        /* username will be ignored for user requests
         old_password will be ignored for admin requests
        */
        $this->password1 = $password1;
        $this->password2 = $password2;

        parent::__construct("normal_user.changePassword", [
            "normal_username" => $username,
            "password" => $password1,
            "old_password" => $old_password
        ]);
    }

    protected function check()
    {
        return checkPasswordMatch($this->password1, $this->password2);
    }

}

class ChangeVoIPPassword extends Request
{
    protected $password1;
    protected $password2;

    public function __construct($username, $password1, $password2, $old_password = "")
    {
        parent::__construct("voip_user.changePassword", [
            "voip_username" => $username,
            "password" => $password1,
            "old_password" => $old_password
        ]);

        $this->password1 = $password1;
        $this->password2 = $password2;
    }

    protected function check()
    {
        return checkPasswordMatch($this->password1, $this->password2);
    }
}

class CalcApproxDuration extends Request
{
    public function __construct($user_id)
    {
        parent::__construct("user.calcApproxDuration", [
            "user_id" => $user_id
        ]);
    }
}


