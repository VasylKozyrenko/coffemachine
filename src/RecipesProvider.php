<?php

class RecipesProvider {

    /**
     * @var string
     */
    protected $recipes;

    /**
     * @var string
     */
    protected $fileName;

    /**
     * @var string
     */
    protected $recipesNode;

    public function __construct($fileName, $recipesNode = 'ingredients')
    {
        $this->fileName = $fileName;
        $this->recipesNode = $recipesNode;
        $xml = simplexml_load_file(__DIR__ . DIRECTORY_SEPARATOR . $fileName);
        $this->recipes = $this->convert($xml);
    }

    /**
     * @param string $name
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function getRecipe($name)
    {
        if (!isset($this->recipes[$name])) {
            throw new \InvalidArgumentException(
                sprintf('Requested recipe "%s" is not specified in %s', $name, $this->fileName)
            );
        }
        return $this->recipes[$name];
    }

    /**
     * @param SimpleXMLElement $xml
     * @return mixed
     */
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