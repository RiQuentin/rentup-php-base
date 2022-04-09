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