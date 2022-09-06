<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220905190840 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE hourly_sold (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, hourly_id INT NOT NULL, INDEX IDX_96D3A91CF675F31B (author_id), INDEX IDX_96D3A91C2336BF3B (hourly_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hourly_sold ADD CONSTRAINT FK_96D3A91CF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE hourly_sold ADD CONSTRAINT FK_96D3A91C2336BF3B FOREIGN KEY (hourly_id) REFERENCES hourly (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE hourly_sold');
    }
}
