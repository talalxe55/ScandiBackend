<?php

class Model extends SchemaDB
{
    protected $table_name;

    public function fetchAll(): array
    {
        $this->databaseConnection();


        $sql = "SELECT * FROM `view_product`";

        $result = $this->conn->query($sql);
        $resultArray = [];
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $resultArray[] = $row;
            }

        }
        return $resultArray;
    }

    public function delete(array $product_ids): array
    {

        $product_ids = implode(",", $product_ids);

        $conn = $this->databaseConnection();
        $sql = "DELETE FROM view_product WHERE id IN($product_ids)";
        $result = $conn->query($sql);

        
        if (!mysqli_error($conn)) {

            return ["success_message" => "Product(s) successfully deleted"];
        } else {
            return ["error_message" => mysqli_error($conn)];

        }
    }

    public function save()
    {
        // TODO: to be implemented in the Product Class
    }

}