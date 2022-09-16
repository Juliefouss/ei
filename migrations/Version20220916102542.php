<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220916102542 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE hourly_user (hourly_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_8392A2CC2336BF3B (hourly_id), INDEX IDX_8392A2CCA76ED395 (user_id), PRIMARY KEY(hourly_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hourly_user ADD CONSTRAINT FK_8392A2CC2336BF3B FOREIGN KEY (hourly_id) REFERENCES hourly (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE hourly_user ADD CONSTRAINT FK_8392A2CCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE hourly_user');
    }
}
