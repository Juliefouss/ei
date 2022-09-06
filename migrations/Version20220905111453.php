<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220905111453 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment ADD hourly_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C2336BF3B FOREIGN KEY (hourly_id) REFERENCES hourly (id)');
        $this->addSql('CREATE INDEX IDX_9474526C2336BF3B ON comment (hourly_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C2336BF3B');
        $this->addSql('DROP INDEX IDX_9474526C2336BF3B ON comment');
        $this->addSql('ALTER TABLE comment DROP hourly_id');
    }
}
