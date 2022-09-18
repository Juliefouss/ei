<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220918104004 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE delete_message (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, hourly_id INT NOT NULL, INDEX IDX_154CE429F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hourly_request (id INT AUTO_INCREMENT NOT NULL, service_id INT NOT NULL, user_id INT NOT NULL, date DATETIME NOT NULL, hour VARCHAR(255) NOT NULL, INDEX IDX_E03DDA9EED5CA9E6 (service_id), INDEX IDX_E03DDA9EA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE delete_message ADD CONSTRAINT FK_154CE429F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE hourly_request ADD CONSTRAINT FK_E03DDA9EED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE hourly_request ADD CONSTRAINT FK_E03DDA9EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE hourly ADD CONSTRAINT FK_A502CDABB27331AE FOREIGN KEY (hourly_request_id) REFERENCES hourly_request (id)');
        $this->addSql('ALTER TABLE user ADD inami_number VARCHAR(12) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hourly DROP FOREIGN KEY FK_A502CDABB27331AE');
        $this->addSql('DROP TABLE delete_message');
        $this->addSql('DROP TABLE hourly_request');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE user DROP inami_number');
    }
}
