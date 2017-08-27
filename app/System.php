<?php

namespace App;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Illuminate\Database\Eloquent\Model;
use Psr\Http\Message\ResponseInterface;
use twhiston\simplexml_debug\SxmlDebug;

/**
 * Class System
 * @package App
 */
class System extends Model
{
    /**
     * @var Client
     */
    private $guzzle;

    /**
     * System constructor.
     */
    public function __construct()
    {
        $this->guzzle = new Client([
            'base_uri' => 'https://' . env('NAS_IP') . '/dbbroker',
            'verify' => false
        ]);
    }

    public function getFirmwareInfo()
    {
        $response = $this->sendRequest(
            'FW_Broker',
            'FirmwareImage',
            '/fwbroker'
        );

        $device_info = $this->xmlToArray($response);

        return $device_info;
    }

    public function getDeviceInfo()
    {
        $response = $this->sendRequest('SystemInfo', 'SystemInfo');

        $device_info = $this->xmlToArray($response);

        return $device_info;
    }

    public function getHealthInfo()
    {
        $response = $this->sendRequest('HealthInfo', 'Health_Collection');

        $result = $this->xmlToArray($response);

        return $result;
    }

    public function getAppInfo()
    {
        $response = $this->sendRequest('LaunchableApp', 'LocalApp_Collection');

        $result = $this->xmlToArray($response);

        return $result;
    }

    private function sendRequest(string $resourceId, string $resourceType, string $resourceUrl = '/dbbroker')
    {
        $xml = new \SimpleXMLElement(
            '<xs:nml
            xmlns:xs="http://www.netgear.com/protocol/transaction/NMLSchema-0.9"
            xmlns="urn:netgear:nas:readynasd"/>'
        );
        $xml->addAttribute('dst', 'dpv_' . time());
        $xml->addAttribute('src', 'nas');
        $transaction = $xml->addChild('xs:transaction');
        $get = $transaction->addChild('xs:get');

        $get->addAttribute('resource-id', $resourceId);
        $get->addAttribute('resource-type', $resourceType);

        $response = $this->guzzle
            ->post($resourceUrl, [
                'body' => $xml->asXML(),
                'auth' => [
                    env('NAS_USER'),
                    env('NAS_PASS')
                ]
            ]);

        return $response;
    }

    private function xmlToArray(ResponseInterface $response)
    {
        $data = new \SimpleXMLElement(
            $response->getBody(),
            null,
            false,
            'xs',
            true
        );

        return $data->transaction->response->error ??
            $data->transaction->response->result->{'get-s'}->children() ??
            null;
    }
}
