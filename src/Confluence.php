<?php
/**
 * @file
 * Contains a simple confluence class capable of writing a page to confluence.
 */

namespace surangapg\confluence;

use Guzzle\Http\Client;
use Guzzle\Http\ClientInterface;

class Confluence {

  /**
   * Guzzle client for the connection.
   * @var \Guzzle\Http\ClientInterface
   */
  protected $client;

  /**
   * Extra options for this request.
   * @var array
   */
  protected $options;

  /**
   * Generate a basic confluence object capable of writing a single page.
   *
   * @param string $endpoint
   *  The api endpoint to connect to
   * @param $username
   * @param $password
   * @return \surangapg\confluence\Confluence
   */
  public function __construct($endpoint, $username, $password) {
    $this->setClient(new Client(["base_uri" => $endpoint]));

    $options = [
      'verify' => FALSE,
      'allow_redirects' => TRUE,
      'headers' => [
        'Accept' => 'application/json',
      ],
      'auth' => [
        $username,
        $password
      ]
    ];

    $this->setOptions($options);
  }

  /**
   * @return \Guzzle\Http\ClientInterface
   */
  public function getClient() {
    return $this->client;
  }

  /**
   * @param \Guzzle\Http\ClientInterface $client
   */
  public function setClient($client) {
    $this->client = $client;
  }

  /**
   * @return array
   */
  public function getOptions() {
    return $this->options;
  }

  /**
   * @param $options
   */
  public function setOptions($options) {
    $this->options = $options;
  }
}