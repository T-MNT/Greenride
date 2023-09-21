<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230703131056 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD isGoogleUser TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64923D7637A FOREIGN KEY (id_music) REFERENCES music (id)');
        $this->addSql('ALTER TABLE user_trajet ADD CONSTRAINT FK_4E09B2B1D6C1C61 FOREIGN KEY (id_trajet) REFERENCES trajet (id)');
        $this->addSql('ALTER TABLE user_trajet ADD CONSTRAINT FK_4E09B2B16B3CA4B FOREIGN KEY (id_user) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64923D7637A');
        $this->addSql('ALTER TABLE user DROP isGoogleUser');
        $this->addSql('ALTER TABLE user_trajet DROP FOREIGN KEY FK_4E09B2B1D6C1C61');
        $this->addSql('ALTER TABLE user_trajet DROP FOREIGN KEY FK_4E09B2B16B3CA4B');
    }
}
