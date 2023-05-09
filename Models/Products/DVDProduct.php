<?php

class DVDProduct extends Product
{

    protected $productType = "DVD";

    public function setValues($values): void
    {
        $this->productType = $this->getProductTypeList($this->getProductType());

        $this->attributes['size'] = $values['size'];
    }




}