<?php
require_once("init.php");

class AddNewRas extends Request
{
    public function __construct($ras_ip, $ras_description, $ras_type, $radius_secret, $comment)
    {
        parent::__construct("ras.addNewRas", [
            "ras_ip" => $ras_ip,
            "ras_description" => $ras_description,
            "ras_type" => $ras_type,
            "radius_secret" => $radius_secret,
            "comment" => $comment
        ]);
    }
}

class GetRasInfo extends Request
{
    public function __construct($ras_ip)
    {
        parent::__construct("ras.getRasInfo", [
            "ras_ip" => $ras_ip
        ]);
    }
}

class GetActiveRasIPs extends Request
{
    public function __construct()
    {
        parent::__construct("ras.getActiveRasIPs", []);
    }
}

class GetRasDescriptions extends Request
{
    public function __construct()
    {
        parent::__construct("ras.getRasDescriptions", []);
    }
}

class GetInActiveRases extends Request
{
    public function __construct()
    {
        parent::__construct("ras.getInActiveRases", []);
    }
}

class GetRasTypes extends Request
{
    public function __construct()
    {
        parent::__construct("ras.getRasTypes", []);
    }
}

class GetRasAttributes extends Request
{
    public function __construct($ras_ip)
    {
        parent::__construct("ras.getRasAttributes", ["ras_ip" => $ras_ip]);
    }
}

class GetRasPorts extends Request
{
    public function __construct($ras_ip)
    {
        parent::__construct("ras.getRasPorts", ["ras_ip" => $ras_ip]);
    }
}

class UpdateRasInfo extends Request
{
    public function __construct($ras_id, $ras_ip, $ras_description, $ras_type, $radius_secret, $comment)
    {
        parent::__construct("ras.updateRasInfo", [
            "ras_id" => $ras_id,
            "ras_ip" => $ras_ip,
            "ras_description" => $ras_description,
            "ras_type" => $ras_type,
            "radius_secret" => $radius_secret,
            "comment" => $comment
        ]);
    }
}



class UpdateRasAttributes extends Request
{
    public function __construct($ras_ip, $attrs)
    {
        parent::__construct("ras.updateAttributes", [
            "ras_ip" => $ras_ip,
            "attrs" => $attrs
        ]);
    }
}

class ResetRasAttributes extends Request
{
    public function __construct($ras_ip)
    {
        parent::__construct("ras.resetAttributes", ["ras_ip" => $ras_ip]);
    }
}

class AddRasPort extends Request
{
    public function __construct($ras_ip, $port_name, $type, $phone, $comment)
    {
        parent::__construct("ras.addPort", [
            "ras_ip" => $ras_ip,
            "port_name" => $port_name,
            "phone" => $phone,
            "type" => $type,
            "comment" => $comment
        ]);
    }
}

class GetPortTypes extends Request
{
    public function __construct()
    {
        parent::__construct("ras.getPortTypes", []);
    }
}

class DelRasPort extends Request
{
    public function __construct($ras_ip, $port_name)
    {
        parent::__construct("ras.delPort", [
            "ras_ip" => $ras_ip,
            "port_name" => $port_name
        ]);
    }
}

class GetRasPortInfo extends Request
{
    public function __construct($ras_ip, $port_name)
    {
        parent::__construct("ras.getRasPortInfo", [
            "ras_ip" => $ras_ip,
            "port_name" => $port_name
        ]);
    }
}

class UpdateRasPort extends Request
{
    public function __construct($ras_ip, $port_name, $type, $phone, $comment)
    {
        parent::__construct("ras.updatePort", [
            "ras_ip" => $ras_ip,
            "port_name" => $port_name,
            "phone" => $phone,
            "type" => $type,
            "comment" => $comment
        ]);
    }
}


class DeActiveRas extends Request
{
    public function __construct($ras_ip)
    {
        parent::__construct("ras.deactivateRas", ["ras_ip" => $ras_ip]);
    }
}

class ReActiveRas extends Request
{
    public function __construct($ras_ip)
    {
        parent::__construct("ras.reactivateRas", ["ras_ip" => $ras_ip]);
    }
}

class GetRasIPpools extends Request
{
    public function __construct($ras_ip)
    {
        parent::__construct("ras.getRasIpPools", ["ras_ip" => $ras_ip]);
    }
}

class AddIPpoolToRas extends Request
{
    public function __construct($ras_ip, $ippool_name)
    {
        parent::__construct("ras.addIpPoolToRas", ["ras_ip" => $ras_ip, "ippool_name" => $ippool_name]);
    }
}

class DelIPpoolFromRas extends Request
{
    public function __construct($ras_ip, $ippool_name)
    {
        parent::__construct("ras.delIpPoolFromRas", ["ras_ip" => $ras_ip, "ippool_name" => $ippool_name]);
    }
}

function getAllActiveRasInfos()
{
    /*
        return a list of associative dictionaries containing all active ras informations
    */
    /*
        return a list of associative dictionaries containing all active ras informations
    */
    $ras_infos = [];

    $ras_ips_request = new GetActiveRasIPs();
    list($success_ips, $ras_ips) = $ras_ips_request->send();

    if (!$success_ips) {
        return [false, $ras_ips];
    }

    $ras_info_request = new GetRasInfo("");

    foreach ($ras_ips as $ras_ip) {
        $ras_info_request->changeParam("ras_ip", $ras_ip);
        list($success_info, $ras_info) = $ras_info_request->send();

        if (!$success_info) {
            return [false, $ras_info];
        }

        $ras_infos[] = $ras_info;
    }

    return [true, $ras_infos];
}

