<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220823140000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hourly ADD service_id INT NOT NULL');
        $this->addSql('ALTER TABLE hourly ADD CONSTRAINT FK_A502CDABED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('CREATE INDEX IDX_A502CDABED5CA9E6 ON hourly (service_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hourly DROP FOREIGN KEY FK_A502CDABED5CA9E6');
        $this->addSql('DROP INDEX IDX_A502CDABED5CA9E6 ON hourly');
        $this->addSql('ALTER TABLE hourly DROP service_id');
    }
}
