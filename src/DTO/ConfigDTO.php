<?php

namespace Nekkoy\GatewaySmseskiz\DTO;

use Nekkoy\GatewayAbstract\DTO\AbstractConfigDTO;

/**
 *
 */
class ConfigDTO extends AbstractConfigDTO
{
    /**
     * Логин
     * @var string
     */
    public $login;

    /**
     * Пароль
     * @var string
     */
    public $password;

    /**
     * Имя при отправке через СМС
     * @var string
     */
    public $name_sms;

    /**
     * @var string
     */
    public $handler = \Nekkoy\GatewaySmseskiz\Services\SendMessageService::class;
}
