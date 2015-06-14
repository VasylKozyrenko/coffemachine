<?php

require 'CoffeeMachine.php';
require 'Ingredient.php';
require 'RecipesProvider.php';

$coffeeMachine = new \CoffeeMachine(new \RecipesProvider('etc/recipes.xml'));
$coffeeMachine->loadIngredient('water', 2);
$coffeeMachine->loadIngredient('coffee');
$espresso = $coffeeMachine->make('americano');
var_dump($espresso);