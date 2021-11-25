<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211125153758 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event_category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE blog_comment DROP FOREIGN KEY FK_7882EFEFF675F31B');
        $this->addSql('ALTER TABLE blog_comment ADD CONSTRAINT FK_7882EFEFF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE event_category');
        $this->addSql('ALTER TABLE blog_comment DROP FOREIGN KEY FK_7882EFEFF675F31B');
        $this->addSql('ALTER TABLE blog_comment ADD CONSTRAINT FK_7882EFEFF675F31B FOREIGN KEY (author_id) REFERENCES user (id) ON DELETE CASCADE');
    }
}
