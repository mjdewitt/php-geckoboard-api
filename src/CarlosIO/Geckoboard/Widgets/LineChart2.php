<?php

namespace CarlosIO\Geckoboard\Widgets;

//use CarlosIO\Geckoboard\Data\LineChart2\Entry;

/**
 * Class LineChart2.
 */
class LineChart2 extends Widget
{
    protected $dataset = array();
    

    public function addEntry($entry)
    {
        $this->dataset[] = $entry;

        return $this;
    }
    
    

    public function getData()
    {
        $data = array();

        foreach ($this->dataset as $entry) {
            $data = $entry->toArray();
        }

        return $data;
    }
}
