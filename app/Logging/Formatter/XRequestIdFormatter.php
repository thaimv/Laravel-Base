<?php
namespace App\Logging\Formatter;

use Monolog\Formatter\LineFormatter;

class XRequestIdFormatter
{
    public function __invoke($logger)
    {
        $requestId = request()->header('X-Request-ID');
        $requestIdFormatted = $requestId ? "[$requestId]" : "";
        $format = "[%datetime%]$requestIdFormatted %level_name%: %message% %context%\n";

        //// Use with XRequestIdProcessor
        //$format = "[%datetime%][%extra.x_request_id%] %level_name%: %message% %context%\n";

        $formatter = new LineFormatter($format, "Y-m-d H:i:s", true, true);

        foreach ($logger->getHandlers() as $handler) {
            $handler->setFormatter($formatter);
        }
    }
}
