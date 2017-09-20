<?php
namespace App;

trait Labels {
    
    public function getLabels()
    {
        foreach ($this->labels as $attribute => $label) {
            if ($this->$attribute) {
                $this->$attribute = $label[$this->$attribute];
            }
        }
        return $this;
    }
}