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


    $sqlQuery = 'SELECT *
                    FROM property
                    INNER JOIN propertytype ON property.property_type_id = propertytype.id';
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

function getNbPropertyBySeller($idSeller): array
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

    return $sellerIdStatement->fetchAll();
}