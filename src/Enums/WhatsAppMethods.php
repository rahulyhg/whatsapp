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

class WhatsAppMethods
{
    const STATUS = 'status';
    const QR_CODE = 'qr_code';
    const WEBHOOK = 'webhook';

    const SEND_MESSAGE = 'sendMessage';
    const SEND_FILE = 'sendFile';
    const MESSAGES = 'messages';
    const GROUP = 'group';
    const SHOW_MESSAGES_QUEUE = 'showMessagesQueue';
    const CLEAR_MESSAGES_QUEUE = 'clearMessagesQueue';

    const NOTIFICATIONS = 'settings/ackNotificationsOn';
    const LOGOUT = 'logout';
    const REBOOT = 'reboot';
}
