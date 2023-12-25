<?php
require_once("init.php");

class AddNewIPpool extends Request
{
    public function __construct($ippool_name, $comment)
    {
        parent::__construct("ippool.addNewIPpool", [
            "ippool_name" => $ippool_name,
            "comment" => $comment,
        ]);
    }
}

class UpdateIPpool extends Request
{
    public function __construct($ippool_id, $ippool_name, $comment)
    {
        parent::__construct("ippool.updateIPpool", [
            "ippool_id" => $ippool_id,
            "ippool_name" => $ippool_name,
            "comment" => $comment,
        ]);
    }
}

class GetIPpoolNames extends Request
{
    public function __construct()
    {
        parent::__construct("ippool.getIPpoolNames", []);
    }
}

class GetIPpoolInfo extends Request
{
    public function __construct($ippool_name)
    {
        parent::__construct("ippool.getIPpoolInfo", [
            "ippool_name" => $ippool_name,
        ]);
    }
}

class DeleteIPpool extends Request
{
    public function __construct($ippool_name)
    {
        parent::__construct("ippool.deleteIPpool", [
            "ippool_name" => $ippool_name,
        ]);
    }
}

class DelIPfromPool extends Request
{
    public function __construct($ippool_name, $ip)
    {
        parent::__construct("ippool.delIPfromPool", [
            "ippool_name" => $ippool_name,
            "ip" => $ip,
        ]);
    }
}

class AddIPtoPool extends Request
{
    public function __construct($ippool_name, $ip)
    {
        parent::__construct("ippool.addIPtoPool", [
            "ippool_name" => $ippool_name,
            "ip" => $ip,
        ]);
    }
}
function getIPpoolInfos()
{/*    
    Return an array of all ip pool infos in format (ippool_name=>associative_ippool_info_array)
 */
    $ippool_list_req=new GetIPpoolNames();
    list($success,$ippool_names)=$ippool_list_req->send();
    if(!$success) {
        return array(FALSE, $ippool_names);
    }else {
        $ippools_info=array();
        $ippool_info_req=new GetIPpoolInfo("");
        foreach($ippool_names as $ippool_name)
        {
            $ippool_info_req->changeParam("ippool_name",$ippool_name);
            list($success,$ippool_info)=$ippool_info_req->send();
            if(!$success) {
                return [false,$ippool_info];
            }
            else {
                $ippools_info[$ippool_name] = $ippool_info;
            }
        }
        return [true,$ippools_info];
    }
}
