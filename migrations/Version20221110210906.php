<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221110210906 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE candidat (id INT AUTO_INCREMENT NOT NULL, nom_parti VARCHAR(255) NOT NULL, identification VARCHAR(255) NOT NULL, cni VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naiss DATE NOT NULL, adresse VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE circonscription (id INT AUTO_INCREMENT NOT NULL, details_circonscription_id INT NOT NULL, region VARCHAR(255) NOT NULL, departement VARCHAR(255) NOT NULL, commune VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_FEDDA65A6C113FA2 (details_circonscription_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE details_circonscription (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, posistion_geographique VARCHAR(255) NOT NULL, nbre_inscris INT NOT NULL, nbre_suff_exprime INT NOT NULL, suff_valable INT NOT NULL, suff_invalable INT NOT NULL, suff_reparti INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE electeur (id INT AUTO_INCREMENT NOT NULL, circonscription_id INT DEFAULT NULL, candidat_id INT DEFAULT NULL, cni VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naiss DATE NOT NULL, adresse VARCHAR(255) NOT NULL, nom_centre_vote VARCHAR(255) NOT NULL, num_bureau_vote INT NOT NULL, INDEX IDX_719667F0755DBAE (circonscription_id), UNIQUE INDEX UNIQ_719667F08D0EB82 (candidat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, circonscription_id INT DEFAULT NULL, candidat_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, cni VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naiss DATE NOT NULL, adresse VARCHAR(255) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649755DBAE (circonscription_id), UNIQUE INDEX UNIQ_8D93D6498D0EB82 (candidat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE circonscription ADD CONSTRAINT FK_FEDDA65A6C113FA2 FOREIGN KEY (details_circonscription_id) REFERENCES details_circonscription (id)');
        $this->addSql('ALTER TABLE electeur ADD CONSTRAINT FK_719667F0755DBAE FOREIGN KEY (circonscription_id) REFERENCES circonscription (id)');
        $this->addSql('ALTER TABLE electeur ADD CONSTRAINT FK_719667F08D0EB82 FOREIGN KEY (candidat_id) REFERENCES candidat (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649755DBAE FOREIGN KEY (circonscription_id) REFERENCES circonscription (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6498D0EB82 FOREIGN KEY (candidat_id) REFERENCES candidat (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE circonscription DROP FOREIGN KEY FK_FEDDA65A6C113FA2');
        $this->addSql('ALTER TABLE electeur DROP FOREIGN KEY FK_719667F0755DBAE');
        $this->addSql('ALTER TABLE electeur DROP FOREIGN KEY FK_719667F08D0EB82');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649755DBAE');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6498D0EB82');
        $this->addSql('DROP TABLE candidat');
        $this->addSql('DROP TABLE circonscription');
        $this->addSql('DROP TABLE details_circonscription');
        $this->addSql('DROP TABLE electeur');
        $this->addSql('DROP TABLE user');
    }
}
