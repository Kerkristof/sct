<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221017094240 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact_message_user (contact_message_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_8B17FA494C34ABE (contact_message_id), INDEX IDX_8B17FA4A76ED395 (user_id), PRIMARY KEY(contact_message_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contact_message_user ADD CONSTRAINT FK_8B17FA494C34ABE FOREIGN KEY (contact_message_id) REFERENCES contact_message (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contact_message_user ADD CONSTRAINT FK_8B17FA4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE contact_message_user');
    }
}
