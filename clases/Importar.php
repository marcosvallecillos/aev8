<?php
class Importar extends Connection{
    function customer() {
        $fichero='customers.csv';
        $conn=$this->getConn();
        $csvFile = fopen($fichero, "r");

        if ($csvFile !== false) {
            while (($data = fgetcsv($csvFile, 0, "#")) !== false) {
               $id = $data[0];
               $name = $data[1];
               $query = "UPDATE `customers` SET `customerName`= '$name' WHERE `customerId`= '$id'";
               $result = mysqli_query($conn,$query);
                 
            }
            fclose($csvFile);
        }
    }

        function getBrandId($brandName) {
            $sql = "SELECT brandId FROM brands WHERE brandName = '$brandName'";
            $result = mysqli_query($this->conn, $sql);
            if ($row = mysqli_fetch_assoc($result)) {
                return $row['brandId'];
            }
        }
    
            public function brandCustomer() {
            $fichero = 'customers.csv'; 
            $csvFile = fopen($fichero, "r");
            
            if ($csvFile !== false) {
                while (($data = fgetcsv($csvFile, 0, "#")) !== false) {
                    $customerId = $data[0];
                    $brands =  explode("|", $data[2]);

                    foreach ($brands as $brand) {
                        $brandId = $this->getBrandId($brand);
                        if ($brandId !== null) {
                            $query = "INSERT INTO `brandcustomer` (`customerId`, `brandId`) VALUES ('$customerId', '$brandId')";
                            mysqli_query($this->conn, $query);
                        } 
                    }
                }
                fclose($csvFile);
        }
    }
    }
    
