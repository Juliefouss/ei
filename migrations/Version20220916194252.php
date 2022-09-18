<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220916194252 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin_message DROP FOREIGN KEY FK_7281B2F62336BF3B');
        $this->addSql('DROP INDEX IDX_7281B2F62336BF3B ON admin_message');
        $this->addSql('ALTER TABLE admin_message ADD hospital_id INT NOT NULL, DROP hourly_id');
        $this->addSql('ALTER TABLE admin_message ADD CONSTRAINT FK_7281B2F663DBB69 FOREIGN KEY (hospital_id) REFERENCES hospital (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7281B2F663DBB69 ON admin_message (hospital_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin_message DROP FOREIGN KEY FK_7281B2F663DBB69');
        $this->addSql('DROP INDEX UNIQ_7281B2F663DBB69 ON admin_message');
        $this->addSql('ALTER TABLE admin_message ADD hourly_id INT DEFAULT NULL, DROP hospital_id');
        $this->addSql('ALTER TABLE admin_message ADD CONSTRAINT FK_7281B2F62336BF3B FOREIGN KEY (hourly_id) REFERENCES hourly (id)');
        $this->addSql('CREATE INDEX IDX_7281B2F62336BF3B ON admin_message (hourly_id)');
    }
}
