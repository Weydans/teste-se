<?php

declare(strict_types=1);

namespace App\Infrastructure\Db\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231021200607 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE Sale_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE SaleItem_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE Sale (id INT NOT NULL, totalTaxes DOUBLE PRECISION NOT NULL, totalSale DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE SaleItem (id INT NOT NULL, product_id INT DEFAULT NULL, sale_id INT DEFAULT NULL, quantity INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_23C30E3D4584665A ON SaleItem (product_id)');
        $this->addSql('CREATE INDEX IDX_23C30E3D4A7E4868 ON SaleItem (sale_id)');
        $this->addSql('ALTER TABLE SaleItem ADD CONSTRAINT FK_23C30E3D4584665A FOREIGN KEY (product_id) REFERENCES Product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE SaleItem ADD CONSTRAINT FK_23C30E3D4A7E4868 FOREIGN KEY (sale_id) REFERENCES Sale (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE Sale_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE SaleItem_id_seq CASCADE');
        $this->addSql('ALTER TABLE SaleItem DROP CONSTRAINT FK_23C30E3D4584665A');
        $this->addSql('ALTER TABLE SaleItem DROP CONSTRAINT FK_23C30E3D4A7E4868');
        $this->addSql('DROP TABLE Sale');
        $this->addSql('DROP TABLE SaleItem');
    }
}
