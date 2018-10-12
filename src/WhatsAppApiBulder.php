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

class WhatsAppApiBulder
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $method;

    /**
     * Constructor.
     *
     * @param string $url
     * @param string $method
     */
    public function __construct($url, $method)
    {
        $this->url = $url;
        $this->method = $method;
    }

    public function build()
    {
        $url = $this->url;

        $slash = '/';
        if (substr($url, -1) !== $slash) {
            $url .= $slash;
        }

        $method = $this->method;

        return sprintf(
            '%s%s', $url, $method
        );
    }
}
