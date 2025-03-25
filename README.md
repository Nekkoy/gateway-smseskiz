# gateway-smseskiz
SMS Gateway для сервиса [eskiz.uz](https://eskiz.uz/sms)

Установка:
```
composer require nekkoy/gateway-smseskiz
```

Конфигурация `.env`
===============
```
# Включить/выключить модуль
SMSESKIZ_ENABLED=true

# Логин
SMSESKIZ_LOGIN=

# Пароль
SMSESKIZ_PASSWORD=

# Имя отправителя в СМС
SMSESKIZ_SMS_NAME=
```

Использование
===============

Создайте DTO сообщения, передав первым параметром текст, а вторым — номер получателя:
```
$message = new \Nekkoy\GatewayAbstract\DTO\MessageDTO("test", "+380123456789");
```

Затем вызовите метод отправки сообщения через фасад:
```
/** @var \Nekkoy\GatewayAbstract\DTO\ResponseDTO $response */
$response = \Nekkoy\GatewaySmseskiz\Facades\GatewaySmseskiz::send($message);
```

Метод возвращает DTO-ответ с параметрами:
 - message - сообщение об успешной отправке или ошибке
 - code - код ответа:
   - code < 0 - ошибка модуля
   - code > 0 - ошибка HTTP
   - code = 0 - успех
 - id - ID сообщения
