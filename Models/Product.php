<?php

abstract class Product extends Model
{
    protected $sku = null;
    protected $name = null;
    protected $price = null;
    protected $productType_list = ['DVD' => 1, 'Furniture' => 2, 'Book' => 3];
    protected $productType = null;
    protected $attributes = [];
    protected $conn;


    public function __construct($sku, $name, $price)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;

        $this->table_name = 'view_product';
    }

    abstract function setValues($values): void;

    public function save(): array
    {
        $this->databaseConnection();
        return ['error_message' => 'SKU already exists!'];
        if(!$this->isUnqiue($this->getSku())){
            return ['error_message' => 'SKU already exists!'];
        }

        $stmt = $this->conn->prepare("
    INSERT INTO {$this->table_name}
                (sku,
                 name,
                 price,
                 product_type_id,
                 book_weight,
                 dvd_size,
                 furniture_height,
                 furniture_width,
                 furniture_length)
    VALUES      (?,
                 ?,
                 ?,
                 ?,
                 ?,
                 ?,
                 ?,
                 ?,
                 ?)
");

        if (!$stmt) {
            return ['error_message' => 'prepare() failed: ' . htmlspecialchars($this->conn->error)];
        }

        $bind_param_stmt = $stmt->bind_param("ssdsddddd",
            $this->getSku(),
            $this->getName(),
            $this->getPrice(),
            $this->getProductType(),
            $this->getAttributes('weight'),
            $this->getAttributes('size'),
            $this->getAttributes('height'),
            $this->getAttributes('width'),
            $this->getAttributes('length')
        );

        if (!$bind_param_stmt) {

            return ['error_message' => 'bind_param() failed: ' . htmlspecialchars($stmt->error)];
        }

        $stmt_executed = $stmt->execute();
        if (!$stmt_executed) {
            return ['error_message' => 'execute() failed: ' . htmlspecialchars($stmt->error)];
        } else {
            return ['success_message' => 'Product successfully added'];
        }
    }

    /**
     * @return mixed
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return null
     */
    public function getProductType()
    {
        return $this->productType;
    }

    /**
     * @return int[]
     */
    public function getProductTypeList($value)
    {
        return $this->productType_list[$value];
    }

    /**
     * @return mixed
     */
    public function getAttributes($value)
    {
        return $this->attributes[$value];
    }
}