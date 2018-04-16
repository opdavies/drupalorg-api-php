<?php

namespace Opdavies\Drupalorg\Entity;

class User {

  private $data;

  public static function create(\stdClass $values)
  {
    return new static($values);
  }

  public function __construct(\stdClass $data)
  {
    $this->data = collect($data);
  }

  public function getUsername()
  {
    return $this->data['username'];
  }
}
