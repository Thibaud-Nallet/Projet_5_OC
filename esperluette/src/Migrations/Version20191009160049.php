<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191009160049 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment_blog ADD author VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD username VARCHAR(255) NOT NULL, ADD password VARCHAR(255) NOT NULL, DROP firstname, DROP lastname, DROP picture, DROP hash_password, DROP slug');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment_blog DROP author');
        $this->addSql('ALTER TABLE user ADD firstname VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD lastname VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD picture VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD hash_password VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD slug VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP username, DROP password');
    }
}
