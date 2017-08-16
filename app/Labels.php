<?php
namespace App;

trait Labels {
    
    public function getLabels()
    {
        foreach ($this->labels as $attribute => $label) {
            $this->$attribute = $label[$this->$attribute];
        }
        return $this;
    }
}