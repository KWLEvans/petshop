<?php
    date_default_timezone_set("America/Los_Angeles");
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/animal.php";

    $app = new Silex\Application();

    $app->get("/", function() {
      $bengal = new Animal("Bengal Tiger", "India", ["Chital", "Sambar", "Gaur"], 20000);
      $tapir = new Animal("Malayan Tapir", "Malaysia", ["Shoots", "Leaves"], 5500);
      $red_panda = new Animal("Red Panda", "Tibet", ["Bamboo", "Mammals(small)", "Eggs"], 12000);
      $sugar_glider = new Animal("Sugar Glider", "New Guinea", ["Insects", "Acacia Gum", "Manna"], 2000);
      $vaquita = new Animal("Vaquita", "The Ocean", ["Fish", "Crustaceans", "Octopus", "Squid"], 8000);
      $animals_array = [$bengal, $tapir, $red_panda, $sugar_glider, $vaquita];
      $user_diet_array = explode(", ", $_GET["diet"]);
      $user_anmial = new Animal($_GET["species"], $_GET["origin"], $user_diet_array, $_GET["cost"]);
      array_push($animals_array, $user_anmial);
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
          $returned_string = $returned_string . "<li><strong>Origin: </strong>" . $animal->get("origin") . "</li>";
          $returned_string = $returned_string . "<li><strong>Diet: </strong><ul>";
          foreach ($animal->get("diet") as $food) {
              $returned_string = $returned_string . "<li>" . $food . "</li>";
          }
          $returned_string = $returned_string . "</ul></li><li><strong>Cost: </strong>$" . $animal->get("cost") . "</li>";
      }
      $returned_string = $returned_string . "</ul><a href='/add'><button>Legally sell animals here.</button></a></body></html>";

      return $returned_string;
    });

    $app->get("/add", function() {
      return
      "<!DOCTYPE html>
      <html>
          <head>
              <meta charset='utf-8'>
              <title>Totally Legal Pets Dot Com</title>
          </head>
          <body>
            <h1>Do you want to sell your animal in a totally legal way?</h1>
            <h2>Cool, this is the place for you.</h2>
            <h3>Let us know about the animal you want to sell.</h3>
              <form action='/'>
                <input id='species' type='text' name='species' placeholder='What kind of animal is your animal?'>
                <input id='origin' type='text' name='origin' placeholder='What is your animal's natural habitat?'>
                <input id='diet' type='text' name='diet' placeholder='All, foods, must, be, separated, with, a , comma, and, a, space'>
                <input id='cost' type='number' name='cost' placeholder='How much is your animal?'>
                <button type='submit'>Legally sell your pet!</button>
              </form>
          </body>
      </html>";

    });

    return $app;
?>
