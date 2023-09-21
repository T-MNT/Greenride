<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230509131641 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone INT NOT NULL, message VARCHAR(500) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE car DROP INDEX FK_User_ID_car, ADD UNIQUE INDEX UNIQ_773DE69D6B3CA4B (id_user)');
        $this->addSql('ALTER TABLE car CHANGE photos_url photos_url VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX FK_User_1_ID_chat ON chat');
        $this->addSql('DROP INDEX FK_User_2_ID_chat ON chat');
        $this->addSql('ALTER TABLE chat DROP topic, CHANGE date date VARCHAR(10) NOT NULL');
        $this->addSql('DROP INDEX FK_User_ID_message_chat ON message_chat');
        $this->addSql('DROP INDEX FK_Chat_ID_message_chat ON message_chat');
        $this->addSql('ALTER TABLE message_chat CHANGE text text VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX IDX_75EA56E0FB7336F0 ON messenger_messages');
        $this->addSql('DROP INDEX IDX_75EA56E0E3BD61CE ON messenger_messages');
        $this->addSql('DROP INDEX IDX_75EA56E016BA31DB ON messenger_messages');
        $this->addSql('ALTER TABLE messenger_messages CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE body body VARCHAR(255) NOT NULL, CHANGE headers headers VARCHAR(255) NOT NULL, CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE delivered_at delivered_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE role CHANGE value value VARCHAR(24) NOT NULL');
        $this->addSql('ALTER TABLE trajet RENAME INDEX id_account TO IDX_2B5BA98CA3ABFFD4');
        $this->addSql('ALTER TABLE trajet RENAME INDEX id_car TO IDX_2B5BA98CE9990EC7');
        $this->addSql('ALTER TABLE user CHANGE date_unban date_unban INT DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('ALTER TABLE user RENAME INDEX fk_user_1 TO IDX_8D93D64923D7637A');
        $this->addSql('DROP INDEX `primary` ON user_trajet');
        $this->addSql('ALTER TABLE user_trajet ADD CONSTRAINT FK_4E09B2B1D6C1C61 FOREIGN KEY (id_trajet) REFERENCES trajet (id)');
        $this->addSql('ALTER TABLE user_trajet ADD CONSTRAINT FK_4E09B2B16B3CA4B FOREIGN KEY (id_user) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_4E09B2B16B3CA4B ON user_trajet (id_user)');
        $this->addSql('ALTER TABLE user_trajet ADD PRIMARY KEY (id_trajet, id_user)');
        $this->addSql('ALTER TABLE user_trajet RENAME INDEX fk_trajetid TO IDX_4E09B2B1D6C1C61');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE contact');
        $this->addSql('ALTER TABLE chat ADD topic VARCHAR(255) NOT NULL, CHANGE date date VARCHAR(255) NOT NULL');
        $this->addSql('CREATE INDEX FK_User_1_ID_chat ON chat (id_user_1)');
        $this->addSql('CREATE INDEX FK_User_2_ID_chat ON chat (id_user_2)');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user CHANGE date_unban date_unban VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user RENAME INDEX idx_8d93d64923d7637a TO FK_USER_1');
        $this->addSql('ALTER TABLE user_trajet DROP FOREIGN KEY FK_4E09B2B1D6C1C61');
        $this->addSql('ALTER TABLE user_trajet DROP FOREIGN KEY FK_4E09B2B16B3CA4B');
        $this->addSql('DROP INDEX IDX_4E09B2B16B3CA4B ON user_trajet');
        $this->addSql('DROP INDEX `PRIMARY` ON user_trajet');
        $this->addSql('ALTER TABLE user_trajet ADD PRIMARY KEY (id_user, id_trajet)');
        $this->addSql('ALTER TABLE user_trajet RENAME INDEX idx_4e09b2b1d6c1c61 TO FK_TrajetID');
        $this->addSql('ALTER TABLE trajet RENAME INDEX idx_2b5ba98ca3abffd4 TO id_account');
        $this->addSql('ALTER TABLE trajet RENAME INDEX idx_2b5ba98ce9990ec7 TO id_car');
        $this->addSql('ALTER TABLE car DROP INDEX UNIQ_773DE69D6B3CA4B, ADD INDEX FK_User_ID_car (id_user)');
        $this->addSql('ALTER TABLE car CHANGE photos_url photos_url VARCHAR(1000) NOT NULL');
        $this->addSql('ALTER TABLE messenger_messages CHANGE id id BIGINT AUTO_INCREMENT NOT NULL, CHANGE body body LONGTEXT NOT NULL, CHANGE headers headers LONGTEXT NOT NULL, CHANGE created_at created_at DATETIME NOT NULL, CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('ALTER TABLE message_chat CHANGE text text VARCHAR(500) NOT NULL');
        $this->addSql('CREATE INDEX FK_User_ID_message_chat ON message_chat (id_user)');
        $this->addSql('CREATE INDEX FK_Chat_ID_message_chat ON message_chat (id_chat)');
        $this->addSql('ALTER TABLE role CHANGE value value VARCHAR(255) NOT NULL');
    }
}
