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

use leRisen\WhatsApp\Enums\WhatsAppAuxiliary;
use leRisen\WhatsApp\Enums\WhatsAppMethods;
use leRisen\WhatsApp\Exceptions\WhatsAppClientException;

class WhatsAppApiClient
{
    /**
     * @var string
     */
    private $apiUrl;

    /**
     * @var string
     */
    private $token;

    /**
     * Constructor.
     *
     * @param string $url
     * @param string $token
     *
     * @throws WhatsAppClientException
     */
    public function __construct($url, $token)
    {
        /*
         * Checking for load cURL to avoid conflicts
         */
        if (extension_loaded(WhatsAppAuxiliary::NEEDLE_EXTENSION)) {
            $this->setApiUrl($url);
            $this->setToken($token);
        } else {
            throw new WhatsAppClientException(WhatsAppAuxiliary::MSG_EXTENSION_REQUIRED);
        }
    }

    /**
     * Create request.
     *
     * @param string      $method
     * @param string      $dispatchMethod
     * @param array       $data
     *
     * @return WhatsAppApiRequest
     */
    public function createRequest(string $method, string $dispatchMethod, $data = []): WhatsAppApiRequest
    {
        return new WhatsAppApiRequest($this->getApiUrl(), $this->getToken(), $method, $dispatchMethod, $data);
    }

    /**
     * Set api url.
     * 
     * @param string $url
     * 
     * @return WhatsAppApiClient
     */
    public function setApiUrl(string $url): self
    {
        $this->apiUrl = $url;

        return $this;
    }    

    /**
     * Set token.
     *
     * @param string $key
     *
     * @return WhatsAppApiClient
     */
    public function setToken(string $key): self
    {
        $this->token = $key;

        return $this;
    }

    /**
     * Get token.
     *
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * Get api url.
     */
    public function getApiUrl(): ?string
    {
        return $this->apiUrl;
    }

    /**
     * Set webhook.
     * 
     * @param string $url
     * 
     * @return WhatsAppApiRequest
     */
    public function setWebHook(string $url): WhatsAppApiRequest
    {
        return $this->createRequest(WhatsAppMethods::WEBHOOK, 'POST', ['webhookUrl' => $url]);
    }

    /**
     * Get webhook
     * 
     * @return WhatsAppApiRequest
     */
    public function getWebHook(): WhatsAppApiRequest
    {
        return $this->createRequest(WhatsAppMethods::WEBHOOK, 'POST');
    }

    /**
     * Send message.
     *
     * @param array $data
     *
     * @return WhatsAppApiRequest
     */
    public function sendMessage(array $data): WhatsAppApiRequest
    {
        return $this->createRequest(WhatsAppMethods::SEND_MESSAGE, 'POST', $data);
    }

    /**
     * Returns messages list.
     *
     * @param array $data
     * 
     * @return WhatsAppApiRequest
     */
    public function messagesList(array $data): WhatsAppApiRequest
    {
        return $this->createRequest(WhatsAppMethods::MESSAGES, 'GET', $data);
    }
}
