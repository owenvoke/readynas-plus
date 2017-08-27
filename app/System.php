<?php

namespace App;

use Guzzle\Http\Client;
use Guzzle\Http\Message\Response;
use Illuminate\Database\Eloquent\Model;

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
        $this->guzzle = new Client('https://' . env('NAS_IP') . '/dbbroker');
        $this->guzzle->setDefaultOption('verify', false);
    }

    public function getDeviceInfo()
    {
        $response = $this->sendRequest('SystemInfo', 'SystemInfo');

        $device_info = $this->xmlToValues($response);

        return $device_info;
    }

    public function getHealthInfo()
    {
        $response = $this->sendRequest('HealthInfo', 'Health_Collection');

        $result = $this->xmlToValues($response);

        return $result;
    }

    private function sendRequest(string $resourceId, string $resourceType)
    {
        $xml = new \SimpleXMLElement(
            '<xs:nml
            xmlns:xs="http://www.netgear.com/protocol/transaction/NMLSchema-0.9"
            xmlns="urn:netgear:nas:readynasd"/>'
        );
        $xml->addAttribute('src', 'dpv_' . time());
        $xml->addAttribute('dst', 'nas');
        $transaction = $xml->addChild('xs:transaction');
        $get = $transaction->addChild('xs:get');

        $get->addAttribute('resource-id', $resourceId);
        $get->addAttribute('resource-type', $resourceType);

        $response = $this->guzzle
            ->post('/dbbroker', [], $xml->asXML())
            ->setAuth(env('NAS_USER'), env('NAS_PASS'))
            ->send();

        return $response;
    }

    private function xmlToValues(Response $response)
    {
        $data = [];
        $p = xml_parser_create();
        xml_parse_into_struct(
            $p,
            $response->getBody(),
            $values
        );
        xml_parser_free($p);

        foreach ($values as $value) {
            if ($value['type'] !== 'complete' || !isset($value['value'])) {
                continue;
            }

            $data[$value['tag']] = $value['value'];
        }

        return $data;
    }
}
