<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221111131850 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE details_circonscription CHANGE nbre_inscris nbre_inscris INT DEFAULT NULL, CHANGE nbre_suff_exprime nbre_suff_exprime INT DEFAULT NULL, CHANGE suff_valable suff_valable INT DEFAULT NULL, CHANGE suff_invalable suff_invalable INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE details_circonscription CHANGE nbre_inscris nbre_inscris INT NOT NULL, CHANGE nbre_suff_exprime nbre_suff_exprime INT NOT NULL, CHANGE suff_valable suff_valable INT NOT NULL, CHANGE suff_invalable suff_invalable INT NOT NULL');
    }
}
