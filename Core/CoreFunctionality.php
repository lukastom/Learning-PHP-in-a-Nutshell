<?php

/*Namespaces help to organize code
  • Similar logic to a folder (group of scripts). It is a convention to use namespace in a folder with the same name, so effectively namespace=folder.
  • When we use something from this namespace: Core\CoreClass
*/
namespace Core;

class CoreClass {
  // class definition
  public function greetings() {
    echo "<br />CoreClass greets you.";
  }
}

function coreFunction() {
  // function definition
  echo "<br />CoreFunction greets you.";
}

?>