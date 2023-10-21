<?php

declare(strict_types=1);

namespace App\Infrastructure\Db\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231021171646 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE Category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE Product_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE Category (id INT NOT NULL, name VARCHAR(255) NOT NULL, tax DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE Product (id INT NOT NULL, category_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, value DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1CF73D3112469DE2 ON Product (category_id)');
        $this->addSql('ALTER TABLE Product ADD CONSTRAINT FK_1CF73D3112469DE2 FOREIGN KEY (category_id) REFERENCES Category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE Category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE Product_id_seq CASCADE');
        $this->addSql('ALTER TABLE Product DROP CONSTRAINT FK_1CF73D3112469DE2');
        $this->addSql('DROP TABLE Category');
        $this->addSql('DROP TABLE Product');
    }
}
