<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220126154753 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE galery_picture_tag (galery_picture_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_5A0275B687C6452C (galery_picture_id), INDEX IDX_5A0275B6BAD26311 (tag_id), PRIMARY KEY(galery_picture_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE galery_picture_tag ADD CONSTRAINT FK_5A0275B687C6452C FOREIGN KEY (galery_picture_id) REFERENCES galery_picture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE galery_picture_tag ADD CONSTRAINT FK_5A0275B6BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE galery_picture_tag');
    }
}
