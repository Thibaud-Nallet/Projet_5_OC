<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191012184920 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category_shop (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_shop ADD category_shop_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product_shop ADD CONSTRAINT FK_21826E038ACE84A3 FOREIGN KEY (category_shop_id) REFERENCES category_shop (id)');
        $this->addSql('CREATE INDEX IDX_21826E038ACE84A3 ON product_shop (category_shop_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product_shop DROP FOREIGN KEY FK_21826E038ACE84A3');
        $this->addSql('DROP TABLE category_shop');
        $this->addSql('DROP INDEX IDX_21826E038ACE84A3 ON product_shop');
        $this->addSql('ALTER TABLE product_shop DROP category_shop_id');
    }
}
