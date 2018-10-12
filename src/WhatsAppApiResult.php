<?php

/**
 * This file is part of package le-risen/WhatsApp.
 *
 * @author Miroslav Lepichev <lemmas.online@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace leRisen\WhatsApp;

class WhatsAppApiResult
{
    public $success = false;
    public $error = false;

    public $error_msg = null;
    public $response = null;

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getResponse(): ?array
    {
        return $this->response;
    }

    public function isError(): bool
    {
        return $this->error;
    }

    public function getErrorMsg(): ?string
    {
        return $this->error_msg;
    }
}
