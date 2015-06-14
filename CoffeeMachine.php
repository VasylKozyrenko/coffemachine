<?php

class CoffeeMachine
{
    /**
     * @var RecipesProvider
     */
    protected $configuration;

    /**
     * @var []
     */
    protected $loadedIngredients;

    public function __construct($configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @param string $name
     * @param float $quantity
     */
    public function loadIngredient($name, $quantity = 1.0)
    {
        $totalQuantity = isset($this->loadedIngredients[$name])
            ? $this->loadedIngredients[$name] + $quantity
            : $quantity;
        $this->loadedIngredients[$name] = $totalQuantity;
    }

    protected function useIngredient($name, $quantity = 1.0)
    {
        if (!isset($this->loadedIngredients[$name])) {
            throw new \Exception(sprintf('Ingredient "%s" is not loaded to coffee machine!', $name));
        }
        $remainingQuantity = $this->loadedIngredients[$name] - $quantity;
        if ($remainingQuantity < 0) {
            throw new \Exception(sprintf('Not enough %s! Additional %s required!', $name, abs($remainingQuantity)));
        }
        $this->loadedIngredients[$name] = $remainingQuantity;
    }

    public function make($name, $quantity = 1.0)
    {
        $ingredients = $this->configuration->getRecipe($name);
        $madeIngredients = [];
        if (!empty($ingredients)) {
            foreach ($ingredients as $ingredientName => $ingredientQuantity) {
                $madeIngredients[] = $this->make($ingredientName, $ingredientQuantity);
            }
        } else {
            $this->useIngredient($name, $quantity);
        }
        return new \Ingredient($name, $quantity, $madeIngredients);
    }
}