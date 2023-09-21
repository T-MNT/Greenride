<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230512121629 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonces ADD acheteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6F96A7BB5F FOREIGN KEY (acheteur_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_CB988C6F96A7BB5F ON annonces (acheteur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6F96A7BB5F');
        $this->addSql('DROP INDEX IDX_CB988C6F96A7BB5F ON annonces');
        $this->addSql('ALTER TABLE annonces DROP acheteur_id');
    }
}
