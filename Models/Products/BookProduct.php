<?php

class BookProduct extends Product
{
    protected $productType = "Book";

    public function setValues($values): void
    {
        $this->productType = $this->getProductTypeList($this->getProductType());

        $this->attributes['weight'] = $values['weight'];

    }




}