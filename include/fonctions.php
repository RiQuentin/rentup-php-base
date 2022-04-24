<?php

function connectDatabase() {
    try {
        $db = new PDO('mysql:host=localhost;dbname=rentup;charset=utf8', 'root', '');
        return $db;
    } catch (Exception $e) {
        die ('Erreur : ' . $e->getMessage());
    }
}

function getPropertyTypes(): array
{
    $db = connectDatabase();


    $sqlQuery = 'SELECT propertytype.*
                    FROM propertytype
                   ';
    $parameters = [];
//    }

    $propertyTypeStatement = $db->prepare($sqlQuery);
    $propertyTypeStatement->execute($parameters);

    return $propertyTypeStatement->fetchAll();
}

function getProperties(): array
{
    $db = connectDatabase();


    $sqlQuery = 'SELECT property.*
                    FROM property
                    INNER JOIN propertytype ON property.property_type_id  = propertytype.id';
    $parameters = [];
//    }

    $propertyStatement = $db->prepare($sqlQuery);
    $propertyStatement->execute($parameters);

    return $propertyStatement->fetchAll();
}


function getSellers(): array
{
    $db = connectDatabase();

    /*
     SELECT seller.*, COUNT(property.name) AS nbproperty
    FROM `seller`
    INNER JOIN property ON seller.id = property.seller_id
    GROUP BY seller.id;
     */

    $sqlQuery = 'SELECT *
                    FROM seller
                    ';
    $parameters = [];
//    }

    $sellerStatement = $db->prepare($sqlQuery);
    $sellerStatement->execute($parameters);

    return $sellerStatement->fetchAll();
}

function getNbPropertyBySeller($idSeller): int
{
    $db = connectDatabase();


    $sqlQuery = 'SELECT COUNT(property.name) AS nbproperty
                    FROM `seller`
                    INNER JOIN property ON seller.id = property.seller_id
                    WHERE seller.id = :idseller;';
    $parameters = ['idseller' => $idSeller];
//    }

    $sellerIdStatement = $db->prepare($sqlQuery);
    $sellerIdStatement->execute($parameters);
    $nbProperty = $sellerIdStatement->fetchAll();

    return $nbProperty[0]["nbproperty"];
}

function createProperty($name, $street, $city, $postalCode, $state, $country, $price, $status, $createdAt, $image, $propertyTypeId, $sellerId) {
    $db = connectDatabase();
    $sqlQuery = "INSERT INTO property(name, street, city, postal_code,state,country,price,status,created_at,image,property_type_id,seller_id) 
                VALUES ( :name, :street, :city, :postal_code, :state, :country, :price, :status, :created_at, :image, :property_type_id, :seller_id )";

    $propertyStatement = $db->prepare($sqlQuery);

    return $propertyStatement->execute([
        'name' => $name,
        'street' => $street,
        'city' => $city,
        'postal_code' => $postalCode,
        'state' => $state,
        'country'=> $country,
        'price'=> $price,
        'status'=> $status,
        'created_at'=> $createdAt,
        'image'=> $image,
        'property_type_id'=> $propertyTypeId,
        'seller_id'=> $sellerId,
    ]);
}

function getTheThreeLastPropertiesNoSold(): array
{
    $db = connectDatabase();


    $sqlQuery = 'SELECT *
                    FROM property
                    INNER JOIN propertytype ON property.property_type_id = propertytype.id
                    WHERE property.status <> \'Sold\'
                    ORDER BY created_at DESC
                    LIMIT 3';
    $parameters = [];
//    }

    $propertyStatement = $db->prepare($sqlQuery);
    $propertyStatement->execute($parameters);

    return $propertyStatement->fetchAll();
}

function updatePropertyById($id, $name, $street, $city, $postalCode, $state, $country, $price, $status, $createdAt, $image, $propertyTypeId, $sellerId) {
    $db = connectDatabase();

    $sqlQuery = "UPDATE `property` 
                    SET 
                        name = :name,
                        street = :street,
                        city = :city,
                        postal_code = :postal_code,
                        state = :state,
                        country = :country,
                        price = :price,
                        status = :status,
                        created_at = :created_at,
                        image = :image,
                        property_type_id = :property_type_id,
                        seller_id = :seller_id 
                    WHERE id = :id";

    $propertyStatement = $db->prepare($sqlQuery);

    return $propertyStatement->execute([
        'name' => $name,
        'street' => $street,
        'city' => $city,
        'postal_code' => $postalCode,
        'state' => $state,
        'country'=> $country,
        'price'=> $price,
        'status'=> $status,
        'created_at'=> $createdAt,
        'image'=> $image,
        'property_type_id'=> $propertyTypeId,
        'seller_id'=> $sellerId,
        'id'=> $id,
    ]);
}

function getPropertyById( $id ): array
{
    $db = connectDatabase();


    $sqlQuery = 'SELECT *
                    FROM property
                    INNER JOIN propertytype ON property.property_type_id = propertytype.id
                    WHERE property.id = :id;';
    $parameters = ['id' => $id];
//    }

    $propertyStatement = $db->prepare($sqlQuery);
    $propertyStatement->execute($parameters);
    $property = $propertyStatement->fetchAll();

    return $property[0];
}
