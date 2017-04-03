<?php
/**
 * @file
 * Contains a simple confluence class capable of writing a page to confluence.
 */

namespace surangapg\confluence;

use Guzzle\Http\Client;
use Guzzle\Http\Message\Response;

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
   * Load in a page from confluence based on it's id.
   *
   * @param $id
   *   Page id from confluence.
   *
   * @return object|false
   *  Page object from confluence if it could be loaded or false.
   */
  public function getPage($id) {
    /** @var Response $response */
    $response = $this->client->get('/wiki/rest/api/content/' . $id, $this->options);
    if ($response->getStatusCode() == 200) {
      $response = json_decode($response->getBody()->getContents());
      return $response;
    }
    return FALSE;
  }

  /**
   * Overwrite the page on confluence.
   *
   * @param integer $id
   *   The id of the page to overwrite.
   * @param array $data
   *   The array of data, see the confluence api documentation for more info.
   *
   * @return Response
   */
  public function setPage($id, $data) {
    return $this->client->put('/wiki/rest/api/content/' . $id, $this->options + ['json' => $data]);
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