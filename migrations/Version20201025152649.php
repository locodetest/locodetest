<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201025152649 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE locode (id INT AUTO_INCREMENT NOT NULL, country VARCHAR(2) NOT NULL, location VARCHAR(3) NOT NULL, name VARCHAR(1000) NOT NULL, name_wo_diacritics VARCHAR(1000) NOT NULL, subdivision VARCHAR(3) NOT NULL, function SET("unknown","port","rail","road","airport","postal","multimodal","fixedtransport","border") NOT NULL, status VARCHAR(2) NOT NULL, date DATE NOT NULL, iata VARCHAR(3) NOT NULL, coordinates VARCHAR(12) NOT NULL, remarks VARCHAR(1000) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE locode');
    }
}
