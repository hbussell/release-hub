<?php

namespace ConfRunner\Type;

use ConfRunner\Type;

class Exec extends Type {


  public function run() {

  }



  public function supports($data) {
    if (array_key_exists('run', $data)) {        
      return TRUE;
    }
    return FALSE;
  }



}
