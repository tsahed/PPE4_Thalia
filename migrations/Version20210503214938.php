<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210503214938 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE positionobstacle DROP FOREIGN KEY positionobstacle_ibfk_2');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY reservation_ibfk_3');
        $this->addSql('CREATE TABLE obstacle_obstacle (obstacle_source INT NOT NULL, obstacle_target INT NOT NULL, INDEX IDX_C354CB9E3EA709B6 (obstacle_source), INDEX IDX_C354CB9E27425939 (obstacle_target), PRIMARY KEY(obstacle_source, obstacle_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partie (id INT AUTO_INCREMENT NOT NULL, photo_client_id INT DEFAULT NULL, jour DATETIME NOT NULL, nb_joueurs INT NOT NULL, nb_obstacles INT NOT NULL, reussite TINYINT(1) DEFAULT NULL, INDEX IDX_59B1F3D14153F00 (photo_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partie_position_obstacle (partie_id INT NOT NULL, position_obstacle_id INT NOT NULL, INDEX IDX_A6267ED1E075F7A4 (partie_id), INDEX IDX_A6267ED11B80BED3 (position_obstacle_id), PRIMARY KEY(partie_id, position_obstacle_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo_client (id INT AUTO_INCREMENT NOT NULL, photo LONGBLOB NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE position_obstacle (id INT AUTO_INCREMENT NOT NULL, position INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE relation (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE obstacle_obstacle ADD CONSTRAINT FK_C354CB9E3EA709B6 FOREIGN KEY (obstacle_source) REFERENCES obstacle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE obstacle_obstacle ADD CONSTRAINT FK_C354CB9E27425939 FOREIGN KEY (obstacle_target) REFERENCES obstacle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT FK_59B1F3D14153F00 FOREIGN KEY (photo_client_id) REFERENCES photo_client (id)');
        $this->addSql('ALTER TABLE partie_position_obstacle ADD CONSTRAINT FK_A6267ED1E075F7A4 FOREIGN KEY (partie_id) REFERENCES partie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partie_position_obstacle ADD CONSTRAINT FK_A6267ED11B80BED3 FOREIGN KEY (position_obstacle_id) REFERENCES position_obstacle (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE positionobstacle');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE transactions');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY avis_ibfk_1');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY avis_ibfk_2');
        $this->addSql('DROP INDEX idClient ON avis');
        $this->addSql('DROP INDEX idSalle ON avis');
        $this->addSql('ALTER TABLE avis ADD commentaire VARCHAR(255) NOT NULL, DROP idClient, DROP idSalle, DROP avis, DROP note');
        $this->addSql('ALTER TABLE client ADD partie_id INT DEFAULT NULL, ADD avis_id INT DEFAULT NULL, ADD mail VARCHAR(255) NOT NULL, ADD telportable VARCHAR(10) NOT NULL, ADD login VARCHAR(255) NOT NULL, ADD mdp VARCHAR(255) NOT NULL, DROP Email, DROP TelephonePortable, DROP Credit, CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE prenom prenom VARCHAR(255) NOT NULL, CHANGE photo photo LONGBLOB NOT NULL, CHANGE adresse adresse VARCHAR(255) NOT NULL, CHANGE DateNaissance datenaissance DATE NOT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455E075F7A4 FOREIGN KEY (partie_id) REFERENCES partie (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455197E709F FOREIGN KEY (avis_id) REFERENCES avis (id)');
        $this->addSql('CREATE INDEX IDX_C7440455E075F7A4 ON client (partie_id)');
        $this->addSql('CREATE INDEX IDX_C7440455197E709F ON client (avis_id)');
        $this->addSql('ALTER TABLE obstacle ADD id INT AUTO_INCREMENT NOT NULL, ADD type_obstacle VARCHAR(255) NOT NULL, ADD echec INT DEFAULT NULL, ADD temps_passage TIME NOT NULL, DROP UneDefinition, DROP typeObstacle, CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE Photo photo LONGBLOB DEFAULT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE salle DROP FOREIGN KEY salle_ibfk_1');
        $this->addSql('DROP INDEX idTheme ON salle');
        $this->addSql('ALTER TABLE salle ADD avis_id INT DEFAULT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE ville ville VARCHAR(255) NOT NULL, CHANGE idtheme partie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE salle ADD CONSTRAINT FK_4E977E5CE075F7A4 FOREIGN KEY (partie_id) REFERENCES partie (id)');
        $this->addSql('ALTER TABLE salle ADD CONSTRAINT FK_4E977E5C197E709F FOREIGN KEY (avis_id) REFERENCES avis (id)');
        $this->addSql('CREATE INDEX IDX_4E977E5CE075F7A4 ON salle (partie_id)');
        $this->addSql('CREATE INDEX IDX_4E977E5C197E709F ON salle (avis_id)');
        $this->addSql('ALTER TABLE themes ADD salle_id INT DEFAULT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE theme theme VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE themes ADD CONSTRAINT FK_154232DEDC304035 FOREIGN KEY (salle_id) REFERENCES salle (id)');
        $this->addSql('CREATE INDEX IDX_154232DEDC304035 ON themes (salle_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455E075F7A4');
        $this->addSql('ALTER TABLE partie_position_obstacle DROP FOREIGN KEY FK_A6267ED1E075F7A4');
        $this->addSql('ALTER TABLE salle DROP FOREIGN KEY FK_4E977E5CE075F7A4');
        $this->addSql('ALTER TABLE partie DROP FOREIGN KEY FK_59B1F3D14153F00');
        $this->addSql('ALTER TABLE partie_position_obstacle DROP FOREIGN KEY FK_A6267ED11B80BED3');
        $this->addSql('CREATE TABLE positionobstacle (id INT AUTO_INCREMENT NOT NULL, nomObstacle VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, idReservation INT DEFAULT NULL, PositionObstacle INT DEFAULT NULL, INDEX idReservation (idReservation), INDEX nomObstacle (nomObstacle), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reservation (id INT NOT NULL, idClient INT DEFAULT NULL, DateReservation DATETIME DEFAULT NULL, nbJoueurs INT DEFAULT NULL, nbObstacle INT DEFAULT NULL, idSalle INT DEFAULT NULL, idTransaction INT DEFAULT NULL, INDEX idClient (idClient), INDEX idSalle (idSalle), INDEX idTransaction (idTransaction), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE transactions (id INT NOT NULL, idClient INT DEFAULT NULL, MontantTransaction DOUBLE PRECISION DEFAULT NULL, INDEX idClient (idClient), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE utilisateur (id INT NOT NULL, Login VARCHAR(75) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, MotDePasse VARCHAR(30) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, UNIQUE INDEX Login (Login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE positionobstacle ADD CONSTRAINT positionobstacle_ibfk_1 FOREIGN KEY (nomObstacle) REFERENCES obstacle (nom) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE positionobstacle ADD CONSTRAINT positionobstacle_ibfk_2 FOREIGN KEY (idReservation) REFERENCES reservation (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT reservation_ibfk_1 FOREIGN KEY (idClient) REFERENCES client (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT reservation_ibfk_2 FOREIGN KEY (idSalle) REFERENCES salle (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT reservation_ibfk_3 FOREIGN KEY (idTransaction) REFERENCES transactions (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE transactions ADD CONSTRAINT transactions_ibfk_1 FOREIGN KEY (idClient) REFERENCES client (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP TABLE obstacle_obstacle');
        $this->addSql('DROP TABLE partie');
        $this->addSql('DROP TABLE partie_position_obstacle');
        $this->addSql('DROP TABLE photo_client');
        $this->addSql('DROP TABLE position_obstacle');
        $this->addSql('DROP TABLE relation');
        $this->addSql('ALTER TABLE avis ADD idClient INT DEFAULT NULL, ADD idSalle INT DEFAULT NULL, ADD avis VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, ADD note INT DEFAULT NULL, DROP commentaire');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT avis_ibfk_1 FOREIGN KEY (idClient) REFERENCES client (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT avis_ibfk_2 FOREIGN KEY (idSalle) REFERENCES salle (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('CREATE INDEX idClient ON avis (idClient)');
        $this->addSql('CREATE INDEX idSalle ON avis (idSalle)');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455197E709F');
        $this->addSql('DROP INDEX IDX_C7440455E075F7A4 ON client');
        $this->addSql('DROP INDEX IDX_C7440455197E709F ON client');
        $this->addSql('ALTER TABLE client ADD Email VARCHAR(150) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, ADD TelephonePortable CHAR(10) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, ADD Credit DOUBLE PRECISION DEFAULT NULL, DROP partie_id, DROP avis_id, DROP mail, DROP telportable, DROP login, DROP mdp, CHANGE id id INT NOT NULL, CHANGE nom nom VARCHAR(30) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE prenom prenom VARCHAR(30) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE photo photo VARCHAR(200) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE adresse adresse VARCHAR(150) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE datenaissance DateNaissance DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE obstacle MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE obstacle DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE obstacle ADD UneDefinition VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, ADD typeObstacle VARCHAR(75) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, DROP id, DROP type_obstacle, DROP echec, DROP temps_passage, CHANGE nom nom VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE photo Photo VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`');
        $this->addSql('ALTER TABLE obstacle ADD PRIMARY KEY (nom)');
        $this->addSql('ALTER TABLE salle DROP FOREIGN KEY FK_4E977E5C197E709F');
        $this->addSql('DROP INDEX IDX_4E977E5CE075F7A4 ON salle');
        $this->addSql('DROP INDEX IDX_4E977E5C197E709F ON salle');
        $this->addSql('ALTER TABLE salle ADD idTheme INT DEFAULT NULL, DROP partie_id, DROP avis_id, CHANGE id id INT NOT NULL, CHANGE ville ville VARCHAR(45) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`');
        $this->addSql('ALTER TABLE salle ADD CONSTRAINT salle_ibfk_1 FOREIGN KEY (idTheme) REFERENCES themes (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('CREATE INDEX idTheme ON salle (idTheme)');
        $this->addSql('ALTER TABLE themes DROP FOREIGN KEY FK_154232DEDC304035');
        $this->addSql('DROP INDEX IDX_154232DEDC304035 ON themes');
        $this->addSql('ALTER TABLE themes DROP salle_id, CHANGE id id INT NOT NULL, CHANGE theme theme VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`');
    }
}
