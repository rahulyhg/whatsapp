<?php

/**
 * This file is part of package le-risen/WhatsApp.
 *
 * @author Miroslav Lepichev <lemmas.online@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace leRisen\WhatsApp\Enums;

class WhatsAppAuxiliary
{
    const NEEDLE_EXTENSION = 'curl';
    const MSG_EXTENSION_REQUIRED = 'The '.self::NEEDLE_EXTENSION.' PHP extension is required';

    const MSG_ERROR_JSON = 'Error during decoding JSON: ';
    const MSG_NOT_ARRAY = 'It was expected that the output would be an array';
}
