<?php

namespace Nekkoy\GatewaySmseskiz\Services;

use Nekkoy\GatewaySmseskiz\DTO\ConfigDTO;
use Nekkoy\GatewayAbstract\DTO\MessageDTO;
use Nekkoy\GatewayAbstract\DTO\ResponseDTO;

/**
 *
 */
class GatewaySmseskizService
{
	/**
	* @return ResponseDTO
	*/
    public function send(MessageDTO $message)
    {
        /** @var ConfigDTO $config */
        $config = app(GatewayService::class)->getConfig();

        /** @var SendMessageService $gateway */
        $gateway = new $config->handler($config, $message);

        return $gateway->send();
    }
}
