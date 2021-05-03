<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210503124228 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, commentaire VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, partie_id INT DEFAULT NULL, avis_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, photo LONGBLOB NOT NULL, adresse VARCHAR(255) NOT NULL, datenaissance DATE NOT NULL, mail VARCHAR(255) NOT NULL, telportable VARCHAR(10) NOT NULL, login VARCHAR(255) NOT NULL, mdp VARCHAR(255) NOT NULL, INDEX IDX_C7440455E075F7A4 (partie_id), INDEX IDX_C7440455197E709F (avis_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE obstacle (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, photo LONGBLOB DEFAULT NULL, type_obstacle VARCHAR(255) NOT NULL, echec INT DEFAULT NULL, temps_passage TIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE obstacle_obstacle (obstacle_source INT NOT NULL, obstacle_target INT NOT NULL, INDEX IDX_C354CB9E3EA709B6 (obstacle_source), INDEX IDX_C354CB9E27425939 (obstacle_target), PRIMARY KEY(obstacle_source, obstacle_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partie (id INT AUTO_INCREMENT NOT NULL, photo_client_id INT DEFAULT NULL, jour DATETIME NOT NULL, nb_joueurs INT NOT NULL, nb_obstacles INT NOT NULL, reussite TINYINT(1) DEFAULT NULL, INDEX IDX_59B1F3D14153F00 (photo_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partie_position_obstacle (partie_id INT NOT NULL, position_obstacle_id INT NOT NULL, INDEX IDX_A6267ED1E075F7A4 (partie_id), INDEX IDX_A6267ED11B80BED3 (position_obstacle_id), PRIMARY KEY(partie_id, position_obstacle_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo_client (id INT AUTO_INCREMENT NOT NULL, photo LONGBLOB NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE position_obstacle (id INT AUTO_INCREMENT NOT NULL, position INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE relation (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salle (id INT AUTO_INCREMENT NOT NULL, partie_id INT DEFAULT NULL, avis_id INT DEFAULT NULL, ville VARCHAR(255) NOT NULL, INDEX IDX_4E977E5CE075F7A4 (partie_id), INDEX IDX_4E977E5C197E709F (avis_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE themes (id INT AUTO_INCREMENT NOT NULL, salle_id INT DEFAULT NULL, theme VARCHAR(255) NOT NULL, INDEX IDX_154232DEDC304035 (salle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455E075F7A4 FOREIGN KEY (partie_id) REFERENCES partie (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455197E709F FOREIGN KEY (avis_id) REFERENCES avis (id)');
        $this->addSql('ALTER TABLE obstacle_obstacle ADD CONSTRAINT FK_C354CB9E3EA709B6 FOREIGN KEY (obstacle_source) REFERENCES obstacle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE obstacle_obstacle ADD CONSTRAINT FK_C354CB9E27425939 FOREIGN KEY (obstacle_target) REFERENCES obstacle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT FK_59B1F3D14153F00 FOREIGN KEY (photo_client_id) REFERENCES photo_client (id)');
        $this->addSql('ALTER TABLE partie_position_obstacle ADD CONSTRAINT FK_A6267ED1E075F7A4 FOREIGN KEY (partie_id) REFERENCES partie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partie_position_obstacle ADD CONSTRAINT FK_A6267ED11B80BED3 FOREIGN KEY (position_obstacle_id) REFERENCES position_obstacle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE salle ADD CONSTRAINT FK_4E977E5CE075F7A4 FOREIGN KEY (partie_id) REFERENCES partie (id)');
        $this->addSql('ALTER TABLE salle ADD CONSTRAINT FK_4E977E5C197E709F FOREIGN KEY (avis_id) REFERENCES avis (id)');
        $this->addSql('ALTER TABLE themes ADD CONSTRAINT FK_154232DEDC304035 FOREIGN KEY (salle_id) REFERENCES salle (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455197E709F');
        $this->addSql('ALTER TABLE salle DROP FOREIGN KEY FK_4E977E5C197E709F');
        $this->addSql('ALTER TABLE obstacle_obstacle DROP FOREIGN KEY FK_C354CB9E3EA709B6');
        $this->addSql('ALTER TABLE obstacle_obstacle DROP FOREIGN KEY FK_C354CB9E27425939');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455E075F7A4');
        $this->addSql('ALTER TABLE partie_position_obstacle DROP FOREIGN KEY FK_A6267ED1E075F7A4');
        $this->addSql('ALTER TABLE salle DROP FOREIGN KEY FK_4E977E5CE075F7A4');
        $this->addSql('ALTER TABLE partie DROP FOREIGN KEY FK_59B1F3D14153F00');
        $this->addSql('ALTER TABLE partie_position_obstacle DROP FOREIGN KEY FK_A6267ED11B80BED3');
        $this->addSql('ALTER TABLE themes DROP FOREIGN KEY FK_154232DEDC304035');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE obstacle');
        $this->addSql('DROP TABLE obstacle_obstacle');
        $this->addSql('DROP TABLE partie');
        $this->addSql('DROP TABLE partie_position_obstacle');
        $this->addSql('DROP TABLE photo_client');
        $this->addSql('DROP TABLE position_obstacle');
        $this->addSql('DROP TABLE relation');
        $this->addSql('DROP TABLE salle');
        $this->addSql('DROP TABLE themes');
    }
}
