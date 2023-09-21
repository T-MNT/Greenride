<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230329134838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chat DROP FOREIGN KEY FK_User_2_ID_chat');
        $this->addSql('ALTER TABLE chat DROP FOREIGN KEY FK_User_1_ID_chat');
        $this->addSql('ALTER TABLE message_chat DROP FOREIGN KEY FK_Chat_ID_message_chat');
        $this->addSql('ALTER TABLE message_chat DROP FOREIGN KEY FK_User_ID_message_chat');
        $this->addSql('ALTER TABLE tastes DROP FOREIGN KEY FK_User_ID_tastes');
        $this->addSql('ALTER TABLE tastes DROP FOREIGN KEY FK_Music_ID_tastes');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_User_1_ID');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_User_2_ID');
        $this->addSql('DROP TABLE chat');
        $this->addSql('DROP TABLE message_chat');
        $this->addSql('DROP TABLE tastes');
        $this->addSql('DROP TABLE transaction');
        $this->addSql('DROP TABLE user_trajet');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_User_ID_car');
        $this->addSql('DROP INDEX FK_User_ID_car ON car');
        $this->addSql('ALTER TABLE car DROP id_user, CHANGE photos_url photos_url VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_Trajet_ID');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_User_ID');
        $this->addSql('DROP INDEX FK_User_ID ON comment');
        $this->addSql('DROP INDEX FK_Trajet_ID ON comment');
        $this->addSql('ALTER TABLE comment DROP id_user, DROP id_trajet');
        $this->addSql('ALTER TABLE role CHANGE value value VARCHAR(24) NOT NULL');
        $this->addSql('ALTER TABLE user ADD role_id INT NOT NULL, DROP roles, DROP musique');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649D60322AC ON user (role_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chat (id INT AUTO_INCREMENT NOT NULL, id_user_1 INT NOT NULL, id_user_2 INT NOT NULL, topic VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date DATE NOT NULL, INDEX FK_User_2_ID_chat (id_user_2), INDEX FK_User_1_ID_chat (id_user_1), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE message_chat (id INT AUTO_INCREMENT NOT NULL, id_user INT NOT NULL, id_chat INT NOT NULL, text VARCHAR(500) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date DATETIME NOT NULL, INDEX FK_User_ID_message_chat (id_user), INDEX FK_Chat_ID_message_chat (id_chat), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE tastes (id_user INT NOT NULL, id_music INT NOT NULL, INDEX FK_User_ID_tastes (id_user), INDEX IDX_7ED7C01323D7637A (id_music), PRIMARY KEY(id_music, id_user)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE transaction (id INT AUTO_INCREMENT NOT NULL, id_user_1 INT NOT NULL, id_user_2 INT NOT NULL, token_number INT NOT NULL, price_euros INT NOT NULL, date DATE NOT NULL, INDEX FK_User_2_ID (id_user_2), INDEX FK_User_1_ID (id_user_1), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user_trajet (id_user INT NOT NULL, id_trajet INT NOT NULL, INDEX FK_TrajetID (id_trajet), PRIMARY KEY(id_user, id_trajet)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE chat ADD CONSTRAINT FK_User_2_ID_chat FOREIGN KEY (id_user_2) REFERENCES user (id)');
        $this->addSql('ALTER TABLE chat ADD CONSTRAINT FK_User_1_ID_chat FOREIGN KEY (id_user_1) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message_chat ADD CONSTRAINT FK_Chat_ID_message_chat FOREIGN KEY (id_chat) REFERENCES chat (id)');
        $this->addSql('ALTER TABLE message_chat ADD CONSTRAINT FK_User_ID_message_chat FOREIGN KEY (id_user) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tastes ADD CONSTRAINT FK_User_ID_tastes FOREIGN KEY (id_user) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tastes ADD CONSTRAINT FK_Music_ID_tastes FOREIGN KEY (id_music) REFERENCES music (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_User_1_ID FOREIGN KEY (id_user_1) REFERENCES user (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_User_2_ID FOREIGN KEY (id_user_2) REFERENCES user (id)');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE car ADD id_user INT NOT NULL, CHANGE photos_url photos_url VARCHAR(1000) NOT NULL');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_User_ID_car FOREIGN KEY (id_user) REFERENCES user (id)');
        $this->addSql('CREATE INDEX FK_User_ID_car ON car (id_user)');
        $this->addSql('ALTER TABLE comment ADD id_user INT NOT NULL, ADD id_trajet INT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_Trajet_ID FOREIGN KEY (id_trajet) REFERENCES trajet (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_User_ID FOREIGN KEY (id_user) REFERENCES user (id)');
        $this->addSql('CREATE INDEX FK_User_ID ON comment (id_user)');
        $this->addSql('CREATE INDEX FK_Trajet_ID ON comment (id_trajet)');
        $this->addSql('ALTER TABLE role CHANGE value value VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D60322AC');
        $this->addSql('DROP INDEX IDX_8D93D649D60322AC ON user');
        $this->addSql('ALTER TABLE user ADD roles JSON NOT NULL, ADD musique VARCHAR(24) DEFAULT NULL, DROP role_id');
    }
}
