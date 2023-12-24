<?php
require_once("init.php");

class AddNewCharge extends Request
{
    public function __construct($name, $charge_type, $visible_to_all, $comment)
    {
        parent::__construct("charge.addNewCharge", [
            "name" => $name,
            "comment" => $comment,
            "charge_type" => $charge_type,
            "visible_to_all" => ($visible_to_all == true) ? "t" : "f"
        ]);
    }
}

class UpdateCharge extends Request
{
    public function __construct($charge_id, $charge_name, $visible_to_all, $comment)
    {
        parent::__construct("charge.updateCharge", [
            "charge_id" => $charge_id,
            "charge_name" => $charge_name,
            "comment" => $comment,
            "visible_to_all" => ($visible_to_all == true) ? "t" : "f"
        ]);
    }
}


class GetChargeInfo extends Request
{
    public function __construct($charge_name, $charge_id = null)
    {
        /*
         * $charge_name : name of charge to get info, can be null if you want to set $charge_id
         * $charge_id: id of charge to get info, can be null if you want to use $charge_name
         */
        $params = [];

        if (!is_null($charge_name)) {
            $params["charge_name"] = $charge_name;
        } elseif (!is_null($charge_id)) {
            $params["charge_id"] = $charge_id;
        }

        parent::__construct("charge.getChargeInfo", $params);
    }
}


class AddInternetChargeRule extends Request
{
    public function __construct(
        $charge_name,
        $rule_start,
        $rule_end,
        $cpm,
        $cpk,
        $assumed_kps,
        $bandwidth_limit_kbytes,
        $tx_leaf_name,
        $rx_leaf_name,
        $ras,
        $ports,
        $dows
    ) {
        parent::__construct("charge.addInternetChargeRule", [
            "charge_name" => $charge_name,
            "rule_start" => $rule_start,
            "rule_end" => $rule_end,
            "cpm" => $cpm,
            "cpk" => $cpk,
            "assumed_kps" => $assumed_kps,
            "bandwidth_limit_kbytes" => $bandwidth_limit_kbytes,
            "tx_leaf_name" => $tx_leaf_name,
            "rx_leaf_name" => $rx_leaf_name,
            "ras" => $ras,
            "ports" => $ports,
            "dows" => $dows
        ]);
    }
}

class ListChargeRules extends Request
{
    public function __construct($charge_name)
    {
        parent::__construct("charge.listChargeRules", [
            "charge_name" => $charge_name
        ]);
    }
}

class ListCharges extends Request
{
    public function __construct($charge_type = null)
    {
        $params = is_null($charge_type) ? [] : ["charge_type" => $charge_type];

        parent::__construct("charge.listCharges", $params);
    }
}

class UpdateInternetChargeRule extends Request
{
    public function __construct(
        $charge_name,
        $charge_rule_id,
        $rule_start,
        $rule_end,
        $cpm,
        $cpk,
        $assumed_kps,
        $bandwidth_limit_kbytes,
        $tx_leaf_name,
        $rx_leaf_name,
        $ras,
        $ports,
        $dows
    ) {
        parent::__construct("charge.updateInternetChargeRule", [
            "charge_name" => $charge_name,
            "charge_rule_id" => $charge_rule_id,
            "rule_start" => $rule_start,
            "rule_end" => $rule_end,
            "cpm" => $cpm,
            "cpk" => $cpk,
            "assumed_kps" => $assumed_kps,
            "bandwidth_limit_kbytes" => $bandwidth_limit_kbytes,
            "tx_leaf_name" => $tx_leaf_name,
            "rx_leaf_name" => $rx_leaf_name,
            "ras" => $ras,
            "ports" => $ports,
            "dows" => $dows
        ]);
    }
}

class DelChargeRule extends Request
{
    public function __construct($charge_rule_id, $charge_name)
    {
        parent::__construct("charge.delChargeRule", [
            "charge_rule_id" => $charge_rule_id,
            "charge_name" => $charge_name
        ]);
    }
}

class DelCharge extends Request
{
    public function __construct($charge_name)
    {
        parent::__construct("charge.delCharge", [
            "charge_name" => $charge_name
        ]);
    }
}

class AddVoIPChargeRule extends Request
{
    public function __construct($charge_name, $rule_start, $rule_end, $tariff_name, $ras, $ports, $dows)
    {
        parent::__construct("charge.addVoIPChargeRule", [
            "charge_name" => $charge_name,
            "rule_start" => $rule_start,
            "rule_end" => $rule_end,
            "tariff_name" => $tariff_name,
            "ras" => $ras,
            "ports" => $ports,
            "dows" => $dows
        ]);
    }
}

class UpdateVoIPChargeRule extends Request
{
    public function __construct(
        $charge_name,
        $charge_rule_id,
        $rule_start,
        $rule_end,
        $tariff_name,
        $ras,
        $ports,
        $dows
    ) {
        parent::__construct("charge.updateVoIPChargeRule", [
            "charge_name" => $charge_name,
            "charge_rule_id" => $charge_rule_id,
            "rule_start" => $rule_start,
            "rule_end" => $rule_end,
            "tariff_name" => $tariff_name,
            "ras" => $ras,
            "ports" => $ports,
            "dows" => $dows
        ]);
    }
}



