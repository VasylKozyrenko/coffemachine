<?php

require __DIR__ . '\vendor\autoload.php';

$coffeeMachine = new \CoffeeMachine(new \RecipesProvider('etc/recipes.xml'));
$coffeeMachine->loadIngredient('water', 2);
$coffeeMachine->loadIngredient('coffee');
$espresso = $coffeeMachine->make('americano');
var_dump($espresso);