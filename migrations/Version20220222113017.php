<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220222113017 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, company_historic_id INT NOT NULL, number INT NOT NULL, channel_type VARCHAR(60) NOT NULL, channel_name VARCHAR(60) NOT NULL, city VARCHAR(60) NOT NULL, postal_code INT NOT NULL, INDEX IDX_D4E6F814B22F0FC (company_historic_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, siren VARCHAR(9) NOT NULL, UNIQUE INDEX UNIQ_4FBF094FDB8BBA08 (siren), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_historic (id INT AUTO_INCREMENT NOT NULL, legal_status_id INT NOT NULL, company_id INT NOT NULL, name VARCHAR(60) NOT NULL, registration_city VARCHAR(60) NOT NULL, registration_date DATETIME NOT NULL, capital INT NOT NULL, updated_date DATETIME NOT NULL, INDEX IDX_B5C5FA3B873E3FEC (legal_status_id), INDEX IDX_B5C5FA3B979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE legal_status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F814B22F0FC FOREIGN KEY (company_historic_id) REFERENCES company_historic (id)');
        $this->addSql('ALTER TABLE company_historic ADD CONSTRAINT FK_B5C5FA3B873E3FEC FOREIGN KEY (legal_status_id) REFERENCES legal_status (id)');
        $this->addSql('ALTER TABLE company_historic ADD CONSTRAINT FK_B5C5FA3B979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company_historic DROP FOREIGN KEY FK_B5C5FA3B979B1AD6');
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F814B22F0FC');
        $this->addSql('ALTER TABLE company_historic DROP FOREIGN KEY FK_B5C5FA3B873E3FEC');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE company_historic');
        $this->addSql('DROP TABLE legal_status');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
