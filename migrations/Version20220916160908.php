<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220916160908 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin_message ADD hourly_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE admin_message ADD CONSTRAINT FK_7281B2F62336BF3B FOREIGN KEY (hourly_id) REFERENCES hourly (id)');
        $this->addSql('CREATE INDEX IDX_7281B2F62336BF3B ON admin_message (hourly_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin_message DROP FOREIGN KEY FK_7281B2F62336BF3B');
        $this->addSql('DROP INDEX IDX_7281B2F62336BF3B ON admin_message');
        $this->addSql('ALTER TABLE admin_message DROP hourly_id');
    }
}
