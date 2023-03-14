<?php

declare(strict_types=1);

namespace App\Console;

use InvalidArgumentException;

class StreamOutput implements OutputInterface
{
    private $stream;

    public function __construct($stream)
    {
        if (!is_resource($stream) || 'stream' !== get_resource_type($stream)) {
            throw new InvalidArgumentException('The StreamOutput class needs a stream as its first argument.');
        }

        $this->stream = $stream;
    }

    public function write(string $message, bool $newLine = false)
    {
        $this->doWrite($message ?? '', $newLine);
    }

    public function writeln(string $message)
    {
        $this->doWrite($message ?? '', true);
    }

    protected function doWrite(string $message, bool $newline = false)
    {
        if ($newline) {
            $message .= \PHP_EOL;
        }

        @fwrite($this->stream, $message);

        fflush($this->stream);
    }
}