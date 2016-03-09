<?php

function connect() {
    try {
        $dbhost="localhost";
        $dbuser="example_user";
        $dbpass="Admin2015";
        $dbname="exampleDB";
        $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully\n";
        return $dbh;
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage() . "\n";
    }
}

function db_exec($dbh, $sql) {
    try {
        $dbh->exec($sql);
    } catch(PDOException $e) {
        echo "Create Table failed: " . $e->getMessage() . "\n";
    }
}

function insert_book($dbh, $book) {
    $values = sprintf("('%s', '%s', '%s', %f, %d, '%s')", $book['author'], $book['title'], $book['genre'], $book['price'], $book['publishDate'], $book['description']);
    $sql = "INSERT INTO books (author, title, genre, price, publishDate, description)
    VALUES".$values;
    db_exec($dbh, $sql);
}

$dbh = connect();

$sql_client = "CREATE TABLE books (
id INT NOT NULL AUTO_INCREMENT,
author VARCHAR(80) NOT NULL,
title VARCHAR(80) NOT NULL,
genre VARCHAR(80),
price FLOAT(2),
publishDate INT,
description VARCHAR(2000)
)";

$data = [
    [
        'author' => 'Gambardella, Matthew',
        'title' => 'XML Developer\'s Guide',
        'genre' => 'Computer',
        'price' => 44.95,
        'publishDate' => 970372800,
        'description' => 'An in-depth look at creating applications with XML.',
    ],
    [
        'author' => 'Ralls, Kim',
        'title' => 'Midnight Rain',
        'genre' => 'Fantasy',
        'price' => 5.95,
        'publishDate' => 976942800,
        'description' => 'A former architect battles corporate zombies, an evil sorceress, and her own childhood to become queen of the world.',
    ],
    [
        'author' => 'Corets, Eva',
        'title' => 'Maeve Ascendant',
        'genre' => 'Fantasy',
        'price' => 5.95,
        'publishDate' => 974437200,
        'description' => 'After the collapse of a nanotechnology society in England, the young survivors lay the foundation for a new society.',
    ],
    [
        'author' => 'Corets, Eva',
        'title' => 'Oberon\'s Legacy',
        'genre' => 'Fantasy',
        'price' => 5.95,
        'publishDate' => 984200400,
        'description' => 'In post-apocalypse England, the mysterious agent known only as Oberon helps to create a new life for the inhabitants of London. Sequel to Maeve Ascendant.',
    ],
    [
        'author' => 'Corets, Eva',
        'title' => 'The Sundered Grail',
        'genre' => 'Fantasy',
        'price' => 5.95,
        'publishDate' => 1000094400,
        'description' => 'The two daughters of Maeve, half-sisters, battle one another for control of England. Sequel to Oberon\'s Legacy.',
    ],
    [
        'author' => 'Randall, Cynthia',
        'title' => 'Lover Birds',
        'genre' => 'Romance',
        'price' => 4.95,
        'publishDate' => 967867200,
        'description' => 'When Carla meets Paul at an ornithology conference, tempers fly as feathers get ruffled.',
    ],
    [
        'author' => 'Thurman, Paula',
        'title' => 'Splish Splash',
        'genre' => 'Romance',
        'price' => 4.95,
        'publishDate' => 973141200,
        'description' => 'A deep sea diver finds true love twenty thousand leagues beneath the sea.',
    ],
    [
        'author' => 'Knorr, Stefan',
        'title' => 'Creepy Crawlies',
        'genre' => 'Horror',
        'price' => 4.95,
        'publishDate' => 976078800,
        'description' => 'An anthology of horror stories about roaches, centipedes, scorpions  and other insects.',
    ],
    [
        'author' => 'Kress, Peter',
        'title' => 'Paradox Lost',
        'genre' => 'Science Fiction',
        'price' => 6.95,
        'publishDate' => 973141200,
        'description' => 'After an inadvertant trip through a Heisenberg Uncertainty Device, James Salway discovers the problems of being quantum.',
    ],
    [
        'author' => 'O\'Brien, Tim',
        'title' => 'Microsoft .NET: The Programming Bible',
        'genre' => 'Computer',
        'price' => 36.95,
        'publishDate' => 976338000,
        'description' => 'Microsoft\'s .NET initiative is explored in detail in this deep programmer\'s reference.',
    ],
    [
        'author' => 'O\'Brien, Tim',
        'title' => 'MSXML3: A Comprehensive Guide',
        'genre' => 'Computer',
        'price' => 36.95,
        'publishDate' => 975646800,
        'description' => 'The Microsoft MSXML3 parser is covered in detail, with attention to XML DOM interfaces, XSLT processing, SAX and more.',
    ],
];

foreach ($data as $book) {
    insert_book($dbh, $book);
}

$dbh = null;
