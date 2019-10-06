<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191006063602 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category_blog (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE articles_blog ADD category_blog_id INT NOT NULL');
        $this->addSql('ALTER TABLE articles_blog ADD CONSTRAINT FK_9AE996041D383EE9 FOREIGN KEY (category_blog_id) REFERENCES category_blog (id)');
        $this->addSql('CREATE INDEX IDX_9AE996041D383EE9 ON articles_blog (category_blog_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE articles_blog DROP FOREIGN KEY FK_9AE996041D383EE9');
        $this->addSql('DROP TABLE category_blog');
        $this->addSql('DROP INDEX IDX_9AE996041D383EE9 ON articles_blog');
        $this->addSql('ALTER TABLE articles_blog DROP category_blog_id');
    }
}
