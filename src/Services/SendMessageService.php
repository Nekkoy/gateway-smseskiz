<?php

namespace Nekkoy\GatewaySmseskiz\Services;

use Illuminate\Support\Facades\Cache;
use Nekkoy\GatewayAbstract\Services\AbstractSendMessageService;
use Nekkoy\GatewaySmseskiz\DTO\ConfigDTO;

/**
 *
 */
class SendMessageService extends AbstractSendMessageService
{
    /** @var string */
    protected $api_url = 'https://notify.eskiz.uz';

    protected $method = '/api/message/sms/send';

    protected $api_key = "";

    /** @var ConfigDTO */
    protected $config;

    /**  */
    protected function init() {
        $this->api_key = Cache::get("SMSEskiz_API_KEY");
        if( empty($this->api_key) ) {
            try {
                $this->login();
            } catch (\Exception $e) {
                $this->response_code = -1;
                $this->response_message = $e->getMessage();
            }
        }

        $this->header = [
            sprintf('Authorization: Bearer %s', $this->api_key)
        ];
    }

    /**  */
    protected function login() {
        $this->method = '/api/auth/login';

        $this->send();
        $response = json_decode($this->response, true);
        if ( !isset($response['data']['token']) ) {
            throw new \Exception('SMSEskiz login error');
        }

        $this->api_key = $response['data']['token'];
        Cache::put("SMSEskiz_API_KEY", $this->api_key, 2419200); // 28 дней

        $this->method = '/api/message/sms/send';
    }

    /** @return string */
    protected function url()
    {
        return $this->api_url . $this->method;
    }

    /** @return mixed */
    protected function data()
    {
        if( $this->method == '/api/auth/login' ) {
            return [
                'email'    => $this->config->login,
                'password' => $this->config->password
            ];
        } else {
            return [
                'from'         => $this->config->name_sms,
                'mobile_phone' => $this->message->destination,
                'message'      => $this->message->text,
            ];
        }
    }

    /** @return mixed */
    protected function development()
    {
        if( $this->method == '/api/auth/login' ) {
            return '{
                "message": "token_generated",
                "token_type": "bearer",
                "data": {
                    "token": "Ваш токен"
                }
            }';
        } else {
            return '{
                "id": "59bf10a2-aba8-4694-8fd5-0be20102a580",
                "message": "Waiting for SMS provider",
                "status": "waiting"
            }';
        }
    }

    /**
     * @return void
     */
    protected function response()
    {
        $response = json_decode($this->response, true);
        if( !isset($response['status']) || $response['status'] == 'error' ) {
            $this->response_code = -1;
        } else {
            $this->response_code = 0;
        }

        if( isset($response["id"]) ) {
            $this->message_id = $response["id"];
        }
    }
}
