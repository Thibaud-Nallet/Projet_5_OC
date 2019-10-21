<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191021072117 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD name_livraison VARCHAR(255) DEFAULT NULL, ADD first_name_livraison VARCHAR(255) DEFAULT NULL, ADD adress_first VARCHAR(255) DEFAULT NULL, ADD adress_second VARCHAR(255) DEFAULT NULL, ADD city VARCHAR(255) DEFAULT NULL, ADD code_city INT DEFAULT NULL, ADD country VARCHAR(255) DEFAULT NULL, ADD phone INT DEFAULT NULL, ADD more_info LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP name_livraison, DROP first_name_livraison, DROP adress_first, DROP adress_second, DROP city, DROP code_city, DROP country, DROP phone, DROP more_info');
    }
}
