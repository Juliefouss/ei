<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220902111457 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hourly_request ADD service_id INT NOT NULL');
        $this->addSql('ALTER TABLE hourly_request ADD CONSTRAINT FK_E03DDA9EED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('CREATE INDEX IDX_E03DDA9EED5CA9E6 ON hourly_request (service_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hourly_request DROP FOREIGN KEY FK_E03DDA9EED5CA9E6');
        $this->addSql('DROP INDEX IDX_E03DDA9EED5CA9E6 ON hourly_request');
        $this->addSql('ALTER TABLE hourly_request DROP service_id');
    }
}
