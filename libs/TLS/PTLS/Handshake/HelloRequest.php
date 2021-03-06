<?php

declare(strict_types=1);

namespace PTLS\Handshake;

use PTLS\Content\Alert;
use PTLS\Core;
use PTLS\Exceptions\TLSAlertException;

class HelloRequest extends HandshakeAbstract
{
    public function __construct(Core $core)
    {
        parent::__construct($core);
    }

    public function encode($data)
    {
        $core = $this->core;

        $data = $this->encodeHeader($data);

        if ($core->isServer) {
            throw new TLSAlertException(
                Alert::create(Alert::UNEXPECTED_MESSAGE),
                'Server received Hello Request'
            );
        } else {
            // We don't re-negotiate
            throw new TLSAlertException(Alert::create(Alert::NO_RENEGOTIATION), 'No renegotiation');
        }
    }

    public function decode()
    {
    }

    public function debugInfo()
    {
        return "[HandshakeType::HelloRequest]\n";
    }
}
