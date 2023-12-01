<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231127124135 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE document_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE documentations ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE documentations ADD CONSTRAINT FK_AA76F38612469DE2 FOREIGN KEY (category_id) REFERENCES document_category (id)');
        $this->addSql('CREATE INDEX IDX_AA76F38612469DE2 ON documentations (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE documentations DROP FOREIGN KEY FK_AA76F38612469DE2');
        $this->addSql('DROP TABLE document_category');
        $this->addSql('DROP INDEX IDX_AA76F38612469DE2 ON documentations');
        $this->addSql('ALTER TABLE documentations DROP category_id');
    }
}
