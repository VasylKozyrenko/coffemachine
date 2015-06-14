<?php

class Ingredient
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var float
     */
    protected $quantity;

    /**
     * @var Ingredient[]
     */
    protected $ingredients;

    /**
     * @param string $name
     * @param float $quantity
     * @param Ingredient[] $ingredients
     */
    public function __construct($name, $quantity = 1.0, array $ingredients = [])
    {
        $this->name = $name;
        $this->quantity = $quantity;
        $this->ingredients = $ingredients;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return Ingredient[]
     */
    public function getRecipe()
    {
        return $this->ingredients;
    }
}