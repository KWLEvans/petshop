<?php
    date_default_timezone_set("America/Los_Angeles");
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/animal.php";

    $app = new Silex\Application();

    $app->get("/", function() {
      $bengal = new Animal("Bengal Tiger", "India", array("Chital", "Sambar", "Gaur"), 20000);
      $tapir = new Animal("Malayan Tapir", "Malaysia", array("Shoots", "Leaves"), 5500);
      $red_panda = new Animal("Red Panda", "Tibet", array("Bamboo", "Mammals(small)", "Eggs"), 12000);
      $sugar_glider = new Animal("Sugar Glider", "New Guinea", array("Insects", "Acacia Gum", "Manna"), 2000);
      $vaquita = new Animal("Vaquita", "The Ocean", array("Fish", "Crustaceans", "Octopus", "Squid"), 8000);
      $animals_array = array($bengal, $tapir, $red_panda, $sugar_glider);
      $returned_string =
      "<!DOCTYPE html>
      <html>
          <head>
              <meta charset='utf-8'>
              <title>Totally Legal Pets Dot Com</title>
          </head>
          <body>
              <h1>Here are our available animals:</h1>
              <ul>";
      foreach ($animals_array as $animal) {
          $returned_string = $returned_string . "<li><h3>Species: " . $animal->get("species") . "</h3></li>";
          $returned_string = $returned_string . "<li><strong>Origin: " . $animal->get("origin") . "</strong></li>";
          $returned_string = $returned_string . "<li><strong>Diet: </strong><ul>";
          foreach ($animal->get("diet") as $food) {
              $returned_string = $returned_string . "<li>" . $food . "</li>";
          }
          $returned_string = $returned_string . "</ul></li><li><strong>Cost: $" . $animal->get("cost") . "</strong></li></ul>";
      }
      $returned_string = $returned_string . "</body></html>";

      return $returned_string;
    });

    return $app;
?>
