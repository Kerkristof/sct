<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221014094545 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE doc_file (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, doc_folder_id INT NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT DEFAULT NULL, created_at DATE NOT NULL, file_name VARCHAR(255) NOT NULL, INDEX IDX_D58581C6F675F31B (author_id), INDEX IDX_D58581C6EAF48523 (doc_folder_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE doc_file ADD CONSTRAINT FK_D58581C6F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE doc_file ADD CONSTRAINT FK_D58581C6EAF48523 FOREIGN KEY (doc_folder_id) REFERENCES doc_folder (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE doc_file');
    }
}
