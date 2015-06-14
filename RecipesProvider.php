<?php

class RecipesProvider {

    protected $recipes;

    protected $fileName;

    protected $recipesNode;

    public function __construct($fileName, $recipesNode = 'ingredients')
    {
        $this->fileName = $fileName;
        $this->recipesNode = $recipesNode;
        $xml = simplexml_load_file(__DIR__ . DIRECTORY_SEPARATOR . $fileName);
        $this->recipes = $this->convert($xml);
    }

    public function getRecipe($name)
    {
        if (!isset($this->recipes[$name])) {
            throw new \InvalidArgumentException(
                sprintf('Requested recipe "%s" is not specified in %s', $name, $this->fileName)
            );
        }
        return $this->recipes[$name];
    }

    protected function convert(\SimpleXMLElement $xml)
    {
        return $this->xmlToArray($xml)[$this->recipesNode];
    }

    /**
     * @param \SimpleXMLElement $xml
     * @return array
     */
    private function xmlToArray(\SimpleXMLElement $xml)
    {
        $array = json_decode(json_encode((array) $xml), 1);
        $array = [$xml->getName() => $array];
        return $array;
    }
}