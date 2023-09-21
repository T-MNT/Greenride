<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230511143103 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annonces (id INT AUTO_INCREMENT NOT NULL, vendeur_id INT NOT NULL, nb_tokens INT NOT NULL, montant INT NOT NULL, date VARCHAR(10) NOT NULL, statut VARCHAR(20) NOT NULL, INDEX IDX_CB988C6F858C065E (vendeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, message VARCHAR(500) NOT NULL, date VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, value VARCHAR(255) NOT NULL, date DATETIME NOT NULL, INDEX IDX_D87F7E0C79F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6F858C065E FOREIGN KEY (vendeur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE test ADD CONSTRAINT FK_D87F7E0C79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_User_2_ID');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_User_1_ID');
        $this->addSql('DROP TABLE transaction');
        $this->addSql('ALTER TABLE alert DROP INDEX UNIQ_17FD46C1115E8EC8, ADD INDEX IDX_17FD46C1115E8EC8 (user_signal)');
        $this->addSql('ALTER TABLE alert DROP INDEX UNIQ_17FD46C1EBFABED6, ADD INDEX IDX_17FD46C1EBFABED6 (user_plaint)');
        $this->addSql('ALTER TABLE alert ADD CONSTRAINT FK_17FD46C1EBFABED6 FOREIGN KEY (user_plaint) REFERENCES user (id)');
        $this->addSql('ALTER TABLE alert ADD CONSTRAINT FK_17FD46C1115E8EC8 FOREIGN KEY (user_signal) REFERENCES user (id)');
        $this->addSql('ALTER TABLE alert ADD CONSTRAINT FK_17FD46C12B5BA98C FOREIGN KEY (trajet) REFERENCES trajet (id)');
        $this->addSql('ALTER TABLE car DROP INDEX FK_User_ID_car, ADD UNIQUE INDEX UNIQ_773DE69D6B3CA4B (id_user)');
        $this->addSql('ALTER TABLE car CHANGE photos_url photos_url VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE chat DROP FOREIGN KEY FK_User_2_ID_chat');
        $this->addSql('ALTER TABLE chat DROP FOREIGN KEY FK_User_1_ID_chat');
        $this->addSql('DROP INDEX FK_User_2_ID_chat ON chat');
        $this->addSql('DROP INDEX FK_User_1_ID_chat ON chat');
        $this->addSql('ALTER TABLE chat DROP topic, CHANGE date date VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C7D700B4B FOREIGN KEY (rating_user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C11B965DB FOREIGN KEY (rated_user_id_id) REFERENCES user (id)');
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
        $this->addSql('ALTER TABLE trajet DROP FOREIGN KEY trajet_ibfk_2');
        $this->addSql('ALTER TABLE trajet DROP FOREIGN KEY FK_Conducteur_UserID');
        $this->addSql('ALTER TABLE trajet RENAME INDEX trajet_ibfk_1 TO IDX_2B5BA98CA3ABFFD4');
        $this->addSql('ALTER TABLE trajet RENAME INDEX trajet_ibfk_2 TO IDX_2B5BA98CE9990EC7');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY user_ibfk_1');
        $this->addSql('ALTER TABLE user ADD date_inscrit VARCHAR(10) NOT NULL, CHANGE date_unban date_unban INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user RENAME INDEX email TO UNIQ_8D93D649E7927C74');
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
        $this->addSql('CREATE TABLE transaction (id INT AUTO_INCREMENT NOT NULL, id_user_1 INT NOT NULL, id_user_2 INT NOT NULL, token_number INT NOT NULL, price_euros INT NOT NULL, date DATE NOT NULL, INDEX FK_User_1_ID (id_user_1), INDEX FK_User_2_ID (id_user_2), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_User_2_ID FOREIGN KEY (id_user_2) REFERENCES user (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_User_1_ID FOREIGN KEY (id_user_1) REFERENCES user (id)');
        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6F858C065E');
        $this->addSql('ALTER TABLE test DROP FOREIGN KEY FK_D87F7E0C79F37AE5');
        $this->addSql('DROP TABLE annonces');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE test');
        $this->addSql('ALTER TABLE alert DROP INDEX IDX_17FD46C1EBFABED6, ADD UNIQUE INDEX UNIQ_17FD46C1EBFABED6 (user_plaint)');
        $this->addSql('ALTER TABLE alert DROP INDEX IDX_17FD46C1115E8EC8, ADD UNIQUE INDEX UNIQ_17FD46C1115E8EC8 (user_signal)');
        $this->addSql('ALTER TABLE alert DROP FOREIGN KEY FK_17FD46C1EBFABED6');
        $this->addSql('ALTER TABLE alert DROP FOREIGN KEY FK_17FD46C1115E8EC8');
        $this->addSql('ALTER TABLE alert DROP FOREIGN KEY FK_17FD46C12B5BA98C');
        $this->addSql('ALTER TABLE car DROP INDEX UNIQ_773DE69D6B3CA4B, ADD INDEX FK_User_ID_car (id_user)');
        $this->addSql('ALTER TABLE car CHANGE photos_url photos_url VARCHAR(2000) DEFAULT NULL');
        $this->addSql('ALTER TABLE chat ADD topic VARCHAR(255) DEFAULT NULL, CHANGE date date VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE chat ADD CONSTRAINT FK_User_2_ID_chat FOREIGN KEY (id_user_2) REFERENCES user (id)');
        $this->addSql('ALTER TABLE chat ADD CONSTRAINT FK_User_1_ID_chat FOREIGN KEY (id_user_1) REFERENCES user (id)');
        $this->addSql('CREATE INDEX FK_User_2_ID_chat ON chat (id_user_2)');
        $this->addSql('CREATE INDEX FK_User_1_ID_chat ON chat (id_user_1)');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C7D700B4B');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C11B965DB');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C6B3CA4B');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CD6C1C61');
        $this->addSql('ALTER TABLE message_chat CHANGE text text VARCHAR(500) NOT NULL');
        $this->addSql('CREATE INDEX FK_User_ID_message_chat ON message_chat (id_user)');
        $this->addSql('CREATE INDEX FK_Chat_ID_message_chat ON message_chat (id_chat)');
        $this->addSql('ALTER TABLE messenger_messages CHANGE id id BIGINT AUTO_INCREMENT NOT NULL, CHANGE body body LONGTEXT NOT NULL, CHANGE headers headers LONGTEXT NOT NULL, CHANGE created_at created_at DATETIME NOT NULL, CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('ALTER TABLE role CHANGE value value VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE trajet RENAME INDEX idx_2b5ba98ce9990ec7 TO trajet_ibfk_2');
        $this->addSql('ALTER TABLE trajet RENAME INDEX idx_2b5ba98ca3abffd4 TO trajet_ibfk_1');
        $this->addSql('ALTER TABLE user DROP date_inscrit, CHANGE date_unban date_unban VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user RENAME INDEX idx_8d93d64923d7637a TO FK_USER_1');
        $this->addSql('ALTER TABLE user RENAME INDEX uniq_8d93d649e7927c74 TO email');
        $this->addSql('ALTER TABLE user_trajet DROP FOREIGN KEY FK_4E09B2B1D6C1C61');
        $this->addSql('ALTER TABLE user_trajet DROP FOREIGN KEY FK_4E09B2B16B3CA4B');
        $this->addSql('DROP INDEX IDX_4E09B2B16B3CA4B ON user_trajet');
        $this->addSql('DROP INDEX `PRIMARY` ON user_trajet');
        $this->addSql('ALTER TABLE user_trajet ADD PRIMARY KEY (id_user, id_trajet)');
        $this->addSql('ALTER TABLE user_trajet RENAME INDEX idx_4e09b2b1d6c1c61 TO FK_TrajetID');
    }
}
