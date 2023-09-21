<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230503100108 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alert DROP reason');
        $this->addSql('ALTER TABLE alert ADD CONSTRAINT FK_17FD46C1EBFABED6 FOREIGN KEY (user_plaint) REFERENCES user (id)');
        $this->addSql('ALTER TABLE alert ADD CONSTRAINT FK_17FD46C1115E8EC8 FOREIGN KEY (user_signal) REFERENCES user (id)');
        $this->addSql('ALTER TABLE alert ADD CONSTRAINT FK_17FD46C12B5BA98C FOREIGN KEY (trajet) REFERENCES trajet (id)');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_User_ID_car');
        $this->addSql('DROP INDEX FK_User_2_ID_chat ON chat');
        $this->addSql('DROP INDEX FK_User_1_ID_chat ON chat');
        $this->addSql('ALTER TABLE chat DROP topic, CHANGE date date VARCHAR(10) NOT NULL');
        $this->addSql('DROP INDEX IDX_9474526C7D700B4B ON comment');
        $this->addSql('DROP INDEX IDX_9474526C11B965DB ON comment');
        $this->addSql('ALTER TABLE comment ADD rating INT NOT NULL, ADD date DATETIME NOT NULL, ADD is_anonymized TINYINT(1) NOT NULL, DROP rating_user_id_id, DROP rated_user_id_id, DROP rate, CHANGE content text VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C6B3CA4B FOREIGN KEY (id_user) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CD6C1C61 FOREIGN KEY (id_trajet) REFERENCES trajet (id)');
        $this->addSql('DROP INDEX FK_User_ID_message_chat ON message_chat');
        $this->addSql('DROP INDEX FK_Chat_ID_message_chat ON message_chat');
        $this->addSql('ALTER TABLE message_chat CHANGE text text VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX IDX_75EA56E0E3BD61CE ON messenger_messages');
        $this->addSql('DROP INDEX IDX_75EA56E0FB7336F0 ON messenger_messages');
        $this->addSql('DROP INDEX IDX_75EA56E016BA31DB ON messenger_messages');
        $this->addSql('ALTER TABLE messenger_messages CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE body body VARCHAR(255) NOT NULL, CHANGE headers headers VARCHAR(255) NOT NULL, CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE delivered_at delivered_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE role CHANGE value value VARCHAR(24) NOT NULL');
        $this->addSql('ALTER TABLE trajet DROP FOREIGN KEY FK_2B5BA98CE9990EC7');
        $this->addSql('ALTER TABLE trajet DROP FOREIGN KEY trajet_ibfk_1');
        $this->addSql('ALTER TABLE user ADD id_music INT NOT NULL, ADD description VARCHAR(1000) DEFAULT NULL, DROP date_unban');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64923D7637A FOREIGN KEY (id_music) REFERENCES music (id)');
        $this->addSql('CREATE INDEX IDX_8D93D64923D7637A ON user (id_music)');
        $this->addSql('ALTER TABLE user RENAME INDEX uniq_8d93d649e7927c74 TO email');
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
        $this->addSql('ALTER TABLE alert DROP FOREIGN KEY FK_17FD46C1EBFABED6');
        $this->addSql('ALTER TABLE alert DROP FOREIGN KEY FK_17FD46C1115E8EC8');
        $this->addSql('ALTER TABLE alert DROP FOREIGN KEY FK_17FD46C12B5BA98C');
        $this->addSql('ALTER TABLE alert ADD reason VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE chat ADD topic VARCHAR(255) NOT NULL, CHANGE date date VARCHAR(255) NOT NULL');
        $this->addSql('CREATE INDEX FK_User_2_ID_chat ON chat (id_user_2)');
        $this->addSql('CREATE INDEX FK_User_1_ID_chat ON chat (id_user_1)');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C6B3CA4B');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CD6C1C61');
        $this->addSql('ALTER TABLE comment ADD rated_user_id_id INT NOT NULL, ADD rate INT NOT NULL, DROP date, DROP is_anonymized, CHANGE rating rating_user_id_id INT NOT NULL, CHANGE text content VARCHAR(255) NOT NULL');
        $this->addSql('CREATE INDEX IDX_9474526C7D700B4B ON comment (rating_user_id_id)');
        $this->addSql('CREATE INDEX IDX_9474526C11B965DB ON comment (rated_user_id_id)');
        $this->addSql('ALTER TABLE message_chat CHANGE text text VARCHAR(500) NOT NULL');
        $this->addSql('CREATE INDEX FK_User_ID_message_chat ON message_chat (id_user)');
        $this->addSql('CREATE INDEX FK_Chat_ID_message_chat ON message_chat (id_chat)');
        $this->addSql('ALTER TABLE messenger_messages CHANGE id id BIGINT AUTO_INCREMENT NOT NULL, CHANGE body body LONGTEXT NOT NULL, CHANGE headers headers LONGTEXT NOT NULL, CHANGE created_at created_at DATETIME NOT NULL, CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('ALTER TABLE role CHANGE value value VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64923D7637A');
        $this->addSql('DROP INDEX IDX_8D93D64923D7637A ON user');
        $this->addSql('ALTER TABLE user ADD date_unban VARCHAR(255) DEFAULT NULL, DROP id_music, DROP description');
        $this->addSql('ALTER TABLE user RENAME INDEX email TO UNIQ_8D93D649E7927C74');
        $this->addSql('ALTER TABLE user_trajet DROP FOREIGN KEY FK_4E09B2B1D6C1C61');
        $this->addSql('ALTER TABLE user_trajet DROP FOREIGN KEY FK_4E09B2B16B3CA4B');
        $this->addSql('DROP INDEX IDX_4E09B2B16B3CA4B ON user_trajet');
        $this->addSql('DROP INDEX `PRIMARY` ON user_trajet');
        $this->addSql('ALTER TABLE user_trajet ADD PRIMARY KEY (id_user, id_trajet)');
        $this->addSql('ALTER TABLE user_trajet RENAME INDEX idx_4e09b2b1d6c1c61 TO FK_TrajetID');
    }
}
