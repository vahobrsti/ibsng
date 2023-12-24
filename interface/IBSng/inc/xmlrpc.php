<?php
require_once("init.php");
require_once(XMLRPCINC."xmlrpc.inc");
require_once(IBSINC."auth.php");
require_once(IBSINC."lib.php");

class IBSxmlrpc
{
    protected  $client;

    public function __construct($server_ip = XMLRPC_SERVER_IP, $server_port = XMLRPC_SERVER_PORT)
    {
        /*
            $server_ip: xml rpc server ip address
            $server_port: xml rpc serer port
        */
        $this->client = new xmlrpc_client("/", $server_ip, $server_port);
        $this->client->setDebug(false);
    }

    function sendRequest($server_method,$params_arr,$timeout=XMLRPC_TIMEOUT): array
    {
    /*
        Send request to $server_method, with parameters $params_arr
        $server_method: method to call ex admin.addNewAdmin
        $params_arr: an array of parameters
    */
        $xml_rpc_msg=$this->createXmlRpcMsg($server_method,$params_arr);
        $response=$this->sendXmlRpcRequest($xml_rpc_msg,$timeout);
        $result=$this->returnResponse($response);
        unset($response);
        return $result;
    }

    protected function createXmlRpcMsg($server_method, $params_arr): xmlrpcmsg
    {
        $xml_val=php_xmlrpc_encode($params_arr);
        $xml_msg=new xmlrpcmsg($server_method);
        $xml_msg->addParam($xml_val);
        return $xml_msg;
    }

    protected function sendXmlRpcRequest($xml_rpc_msg, $timeout)
    {
        return $this->client->send($xml_rpc_msg,$timeout);
    }
    
    protected function returnResponse($response): array
    {
        if (!$response) {
            return $this->returnError("Error occurred while connecting to the server");
        } elseif ($response->faultCode() != 0) {
            return $this->returnError($response->faultString());
        } else {
            return $this->returnSuccess($response->value());
        }
    }

    function returnError($err_str): array
    {
        return [false, new Error($err_str)];
    }
    
    function returnSuccess($value): array
    {
        return [true, php_xmlrpc_decode($value)];
    }
    
}
