<?php

namespace Frbr18\Dice2;

class Histogram
{
    private $series = [];
    private $min;
    private $max;
    private $forTest = [];

    public function getSerie()
    {
        return $this->series;
    }

    public function getAsText()
    {
        $stringArray = [];
        for ($i = 1; $i <= 6; $i++) {
            $stringArray[$i] = "";
        }
        
        foreach ($this->series as $serie) {
            foreach ($serie as $value) {
                $stringArray[$value] .= "*";    
            }
        }

        if ($this->min == null || $this->max == null) {
            foreach ($stringArray as $key => $value) {
                if ($value != "") {
                    print($key . ":" . $value . "\n");
                }
            }
        } else {
            for ($i = $this->min; $i <= $this->max; $i++) {
                print($i . ": " . $stringArray[$i]. "\n");
            }
        }
        $this->forTest = $stringArray;
    }

    public function getForTest()
    {
        return $this->forTest;
    }

    public function injectData(HistogramInterface $object)
    {
        array_push($this->series, $object->getHistogramSerie());
        $this->min = $object->getHistogramMin();
        $this->max = $object->getHistogramMax();
    }
}
