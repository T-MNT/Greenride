<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230417134105 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chat (id INT AUTO_INCREMENT NOT NULL, date VARCHAR(8) NOT NULL, id_user_1 INT NOT NULL, id_user_2 INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message_chat (id INT AUTO_INCREMENT NOT NULL, text VARCHAR(255) NOT NULL, id_user INT NOT NULL, id_chat INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP INDEX FK_CarID ON trajet');
        $this->addSql('DROP INDEX FK_Conducteur_UserID ON trajet');
        $this->addSql('ALTER TABLE user DROP img_profil, CHANGE roles roles JSON NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE chat');
        $this->addSql('DROP TABLE message_chat');
        $this->addSql('CREATE INDEX FK_CarID ON trajet (id_car)');
        $this->addSql('CREATE INDEX FK_Conducteur_UserID ON trajet (id_account)');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user ADD img_profil VARCHAR(255) DEFAULT NULL, CHANGE roles roles VARCHAR(24) NOT NULL');
    }
}
