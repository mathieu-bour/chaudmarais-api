<?php


namespace App\Exceptions;


use Mathrix\Lumen\Zero\Exceptions\Http\Http400BadRequestException;
use Throwable;

/**
 * Class UnsupportedWebhookException.
 *
 * @author Mathieu Bour <mathieu@mathrix.fr>
 * @copyright Mathrix Education SA.
 * @since 1.0.0
 */
class UnsupportedWebhookException extends Http400BadRequestException
{
    public function __construct($eventType, Throwable $previous = null)
    {
        parent::__construct([
            "event_type" => $eventType
        ], "Webhook `$eventType` is not supported", $previous);
    }
}
