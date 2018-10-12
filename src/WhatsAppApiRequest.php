<?php

/**
 * This file is part of package le-risen/WhatsApp.
 *
 * @author Miroslav Lepichev <lemmas.online@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace leRisen\whatsapp;

use GuzzleHttp\Client as HttpClient;
use leRisen\WhatsApp\Enums\WhatsAppAuxiliary;
use Psr\Http\Message\ResponseInterface;

class WhatsAppApiRequest
{
    protected const HEADER_ACCEPT = 'application/json';
    protected const CONNECTION_TIMEOUT = 15.0;
    protected const HTTP_ERRORS = false;

    /**
     * @var HttpClient
     */
    private $client;

    /**
     * @var string
     */
    private $apiUrl;

    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $dispatchMethod;

    /**
     * @var array
     */
    private $data;

    /**
     * @var bool
     */
    private $ignoreError;

    /**
     * @var callable
     */
    private $successHandler;

    /**
     * @var callable
     */
    private $errorHandler;

    /**
     * Constructor.
     *
     * @param string      $apiUrl
     * @param string      $token
     * @param string      $method
     * @param string      $dispatchMethod
     * @param array       $data
     */
    public function __construct($apiUrl, $token, $method, $dispatchMethod, $data = [])
    {
        $this->client = new HttpClient([
            'timeout'     => static::CONNECTION_TIMEOUT,
            'http_errors' => static::HTTP_ERRORS, // disable 4xx and 5xx responses
        ]);

        $this->apiUrl = $apiUrl;
        $this->token = $token;
        $this->method = $method;
        $this->dispatchMethod = $dispatchMethod;
        $this->data = $data;
    }

    /**
     * Get data from response.
     *
     * @param ResponseInterface $response
     *
     * @return WhatsAppApiResult
     */
    private function getResponseData(ResponseInterface $response)
    {
        $result = new WhatsAppApiResult();

        $json = json_decode((string) $response->getBody(), true);
        
        $error = false;

        if (!$this->ignoreError) {
            $error = $this->hasError($json);
        }

        if ($error) {
            $result->error = true;
            $result->error_msg = $error;
            $handler = $this->errorHandler;
            if ($handler) {
                call_user_func($handler, $error);
            }
        } else {
            $result->success = true;
            $result->response = $json;
            $handler = $this->successHandler;
            if ($handler) {
                call_user_func($handler, $json);
            }
        }

        return $result;
    }

    /**
     * Checking the result for error.
     *
     * @param array|false $result
     *
     * @return string|false
     */
    private function hasError($result)
    {
        $error = false;

        if (json_last_error() !== JSON_ERROR_NONE) {
            $error = WhatsAppAuxiliary::MSG_ERROR_JSON.json_last_error_msg();
        } elseif (!is_array($result)) {
            $error = WhatsAppAuxiliary::MSG_NOT_ARRAY;
        }

        return $error;
    }

    /**
     * Send request by reference.
     */
    public function execute()
    {
        $builder = new WhatsAppApiBuilder(
            $this->apiUrl,
            $this->method
        );

        $response = $this->client->request(
            $this->dispatchMethod, $builder->build(),
            [
                'headers' => [
                    'Accept' => static::HEADER_ACCEPT,
                ],
                'query' => [
                    $this->data,
                    [
                        'token' => $this->token
                    ]
                ]
            ]
        );

        return $this->getResponseData($response);
    }

    /**
     * Ignore error.
     *
     * @param bool $ignore
     *
     * @return WhatsAppApiRequest
     */
    public function ignoreError(bool $ignore): self
    {
        $this->ignoreError = $ignore;

        return $this;
    }

    /**
     * Set success handler.
     *
     * @param callable $func
     *
     * @return WhatsAppApiRequest
     */
    public function setSuccessHandler($func): self
    {
        $this->successHandler = $func;

        return $this;
    }

    /**
     * Set error handler.
     *
     * @param callable $func
     *
     * @return WhatsAppApiRequest
     */
    public function setErrorHandler($func): self
    {
        $this->errorHandler = $func;

        return $this;
    }
}
