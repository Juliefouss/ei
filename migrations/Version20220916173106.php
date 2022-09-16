<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220916173106 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin_message_user (admin_message_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_5D47EF7D9B44B5AC (admin_message_id), INDEX IDX_5D47EF7DA76ED395 (user_id), PRIMARY KEY(admin_message_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE admin_message_user ADD CONSTRAINT FK_5D47EF7D9B44B5AC FOREIGN KEY (admin_message_id) REFERENCES admin_message (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE admin_message_user ADD CONSTRAINT FK_5D47EF7DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE admin_message_user');
    }
}
