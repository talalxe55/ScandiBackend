<?php

class FurnitureProduct extends Product
{
    protected $productType = "Furniture";

    public function setValues($values): void
    {
        $this->productType = $this->getProductTypeList($this->getProductType());

        $this->attributes['height'] = $values['height'];
        $this->attributes['width'] = $values['width'];
        $this->attributes['length']= $values['length'];
    }




}