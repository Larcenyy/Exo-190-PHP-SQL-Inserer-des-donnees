<?php

class DbPDO
{
    private static string $server = 'localhost';
    private static string $username = 'root';
    private static string $password = '';
    private static string $database = 'table_test_php';
    private static ?PDO $db = null;

    public static function connect(): ?PDO {
        if (self::$db == null){
            try {
                self::$db = new PDO("mysql:host=".self::$server.";dbname=".self::$database, self::$username, self::$password);
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                self::$db->beginTransaction();
                $insertPorduit = "INSERT INTO produit (titre, prix, description_courte, description_longue) VALUES ";
                $insertUser = "INSERT INTO utilisateur (nom, prenom, email, password, adresse, code_postal, pays, date_join) VALUES ";
                $date = new DateTime();
                $dt = $date->format("Y-m-d H:i:s");

                // Je crée la request
//                $user = "
//                    INSERT INTO utilisateur (nom, prenom, email, password, adresse, code_postal, pays, date_join)
//                    VALUES ('Pichard', 'Léo', 'leoquipue@gmail.com', 'test02', '6 rues de beugnies', '59550', 'France', '$dt'),
//                            ('Pichard', 'Noémie', 'nonoquipue@gmail.com', 'test02', '6 rues de beugnies', '59550', 'Angleterre', '$dt')
//                ";

//                $produit = "
//                    INSERT INTO produit (titre, prix, description_courte, description_longue)
//                    VALUES ('Pomme', '3', 'Une petite pomme', 'Une Pomme puissante pour un text hyper puissant'),
//                            ('Micro-onde', '199.99', 'Un petit micronde', 'Un micro hyper puissant pour un text hyper puissant')
//                ";

                $sql1 = $insertUser . "('Lefoison', 'Rémy', 'remy@gmail.com', 'test02', '124 rue charpente', '59600', 'Lille', '$dt')";
                    self::$db->exec($sql1);
                $sql2 = $insertUser . "('Comeau', 'Sidonie', 'qdqd@gmail.com', 'test02', '25 rue du bat meuse', '02100', 'Saint Quentin', '$dt')";
                    self::$db->exec($sql2);
                $sql3 = $insertUser . "('Comeau', 'Brice', 'aaa@gmail.com', 'test02', '95 avenue montreuil', '59440', 'Avesnes', '$dt')";
                    self::$db->exec($sql3);

                $sql4 = $insertPorduit . "('Eau', '0.60', 'Une petite bouteille', 'Une eau puissante pour un text hyper puissant')";
                $sql5 = $insertPorduit . "('Bière', '6.77', 'Une petite bière', 'Une bière puissante pour un text hyper puissant')";
                $sql6 = $insertPorduit . "('Pain', '1.99', 'Un petit bout de pain', 'Un pain puissante pour un text hyper puissant')";
                self::$db->exec($sql4);
                self::$db->exec($sql5);
                self::$db->exec($sql6);


                self::$db->commit(); // On envoyer désormais les request vers le serveur
            }
            catch (PDOException $e) {
                echo "Erreur de la connexion à la dn : " . $e->getMessage();
                self::$db->rollBack(); // On restaure les anciens données en cas d'erreur
                //die();
            }
        }
        return self::$db;
    }
}