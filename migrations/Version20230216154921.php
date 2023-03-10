<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230216154921 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE abonnement (id INT AUTO_INCREMENT NOT NULL, stripe_id INT DEFAULT NULL, user_id INT DEFAULT NULL, statut TINYINT(1) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, INDEX IDX_351268BB3F1B1098 (stripe_id), UNIQUE INDEX UNIQ_351268BBA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, vendeur_id INT DEFAULT NULL, client_id INT DEFAULT NULL, microservice_id INT DEFAULT NULL, contenu LONGTEXT NOT NULL, type VARCHAR(255) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, INDEX IDX_8F91ABF0858C065E (vendeur_id), INDEX IDX_8F91ABF019EB6921 (client_id), INDEX IDX_8F91ABF0FDDA4EF4 (microservice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, hex_color VARCHAR(7) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, microservice_id INT DEFAULT NULL, client_id INT DEFAULT NULL, vendeur_id INT DEFAULT NULL, destinataire_id INT DEFAULT NULL, offre VARCHAR(255) DEFAULT NULL, montant DOUBLE PRECISION NOT NULL, validate TINYINT(1) NOT NULL, deliver TINYINT(1) NOT NULL, cancel TINYINT(1) NOT NULL, deliver_at DATETIME DEFAULT NULL, cancel_at DATETIME DEFAULT NULL, validate_at DATETIME DEFAULT NULL, statut VARCHAR(255) DEFAULT NULL, confirmation_client TINYINT(1) NOT NULL, lu TINYINT(1) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, INDEX IDX_6EEAA67DFDDA4EF4 (microservice_id), INDEX IDX_6EEAA67D19EB6921 (client_id), INDEX IDX_6EEAA67D858C065E (vendeur_id), INDEX IDX_6EEAA67DA4F84F6E (destinataire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conversation (id INT AUTO_INCREMENT NOT NULL, microservice_id INT DEFAULT NULL, user1_id INT NOT NULL, user2_id INT NOT NULL, last_message_id INT DEFAULT NULL, sender_id INT DEFAULT NULL, terminee TINYINT(1) NOT NULL, created DATETIME NOT NULL, INDEX IDX_8A8E26E9FDDA4EF4 (microservice_id), INDEX IDX_8A8E26E956AE248B (user1_id), INDEX IDX_8A8E26E9441B8B65 (user2_id), INDEX IDX_8A8E26E9BA0E79C3 (last_message_id), INDEX IDX_8A8E26E9F624B39D (sender_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favoris (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, microservice_id INT DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, INDEX IDX_8933C43219EB6921 (client_id), INDEX IDX_8933C432FDDA4EF4 (microservice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, image_name VARCHAR(255) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, conversation_id INT DEFAULT NULL, auteur_id INT NOT NULL, destinataire_id INT NOT NULL, commande_id INT DEFAULT NULL, contenu LONGTEXT NOT NULL, lu TINYINT(1) NOT NULL, created DATETIME NOT NULL, INDEX IDX_B6BD307F9AC0396 (conversation_id), INDEX IDX_B6BD307F60BB6FE6 (auteur_id), INDEX IDX_B6BD307FA4F84F6E (destinataire_id), INDEX IDX_B6BD307F82EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE microservice (id INT AUTO_INCREMENT NOT NULL, vendeur_id INT DEFAULT NULL, categorie_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, online TINYINT(1) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, INDEX IDX_770EA0AF858C065E (vendeur_id), INDEX IDX_770EA0AFBCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE microservice_media (microservice_id INT NOT NULL, media_id INT NOT NULL, INDEX IDX_C91878DBFDDA4EF4 (microservice_id), INDEX IDX_C91878DBEA9FDD75 (media_id), PRIMARY KEY(microservice_id, media_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE microservice_prix (microservice_id INT NOT NULL, prix_id INT NOT NULL, INDEX IDX_7F36493CFDDA4EF4 (microservice_id), INDEX IDX_7F36493C944722F2 (prix_id), PRIMARY KEY(microservice_id, prix_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE portefeuille (id INT AUTO_INCREMENT NOT NULL, vendeur_id INT DEFAULT NULL, solde_disponible DOUBLE PRECISION NOT NULL, solde_en_cours DOUBLE PRECISION DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, UNIQUE INDEX UNIQ_2955FFFE858C065E (vendeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prix (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, tarif DOUBLE PRECISION NOT NULL, description LONGTEXT DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stripe (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, tarif DOUBLE PRECISION NOT NULL, stripe_key VARCHAR(255) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE suivis (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, vendeur_id INT DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, INDEX IDX_6627ED7019EB6921 (client_id), INDEX IDX_6627ED70858C065E (vendeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, genre VARCHAR(255) DEFAULT NULL, avatar VARCHAR(255) DEFAULT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, compte VARCHAR(255) NOT NULL, apropos LONGTEXT DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', name_url VARCHAR(255) NOT NULL, pays VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE abonnement ADD CONSTRAINT FK_351268BB3F1B1098 FOREIGN KEY (stripe_id) REFERENCES stripe (id)');
        $this->addSql('ALTER TABLE abonnement ADD CONSTRAINT FK_351268BBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0858C065E FOREIGN KEY (vendeur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF019EB6921 FOREIGN KEY (client_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0FDDA4EF4 FOREIGN KEY (microservice_id) REFERENCES microservice (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DFDDA4EF4 FOREIGN KEY (microservice_id) REFERENCES microservice (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D19EB6921 FOREIGN KEY (client_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D858C065E FOREIGN KEY (vendeur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA4F84F6E FOREIGN KEY (destinataire_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE conversation ADD CONSTRAINT FK_8A8E26E9FDDA4EF4 FOREIGN KEY (microservice_id) REFERENCES microservice (id)');
        $this->addSql('ALTER TABLE conversation ADD CONSTRAINT FK_8A8E26E956AE248B FOREIGN KEY (user1_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE conversation ADD CONSTRAINT FK_8A8E26E9441B8B65 FOREIGN KEY (user2_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE conversation ADD CONSTRAINT FK_8A8E26E9BA0E79C3 FOREIGN KEY (last_message_id) REFERENCES message (id)');
        $this->addSql('ALTER TABLE conversation ADD CONSTRAINT FK_8A8E26E9F624B39D FOREIGN KEY (sender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_8933C43219EB6921 FOREIGN KEY (client_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_8933C432FDDA4EF4 FOREIGN KEY (microservice_id) REFERENCES microservice (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F9AC0396 FOREIGN KEY (conversation_id) REFERENCES conversation (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F60BB6FE6 FOREIGN KEY (auteur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FA4F84F6E FOREIGN KEY (destinataire_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE microservice ADD CONSTRAINT FK_770EA0AF858C065E FOREIGN KEY (vendeur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE microservice ADD CONSTRAINT FK_770EA0AFBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE microservice_media ADD CONSTRAINT FK_C91878DBFDDA4EF4 FOREIGN KEY (microservice_id) REFERENCES microservice (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE microservice_media ADD CONSTRAINT FK_C91878DBEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE microservice_prix ADD CONSTRAINT FK_7F36493CFDDA4EF4 FOREIGN KEY (microservice_id) REFERENCES microservice (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE microservice_prix ADD CONSTRAINT FK_7F36493C944722F2 FOREIGN KEY (prix_id) REFERENCES prix (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE portefeuille ADD CONSTRAINT FK_2955FFFE858C065E FOREIGN KEY (vendeur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE suivis ADD CONSTRAINT FK_6627ED7019EB6921 FOREIGN KEY (client_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE suivis ADD CONSTRAINT FK_6627ED70858C065E FOREIGN KEY (vendeur_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE microservice DROP FOREIGN KEY FK_770EA0AFBCF5E72D');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F82EA2E54');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F9AC0396');
        $this->addSql('ALTER TABLE microservice_media DROP FOREIGN KEY FK_C91878DBEA9FDD75');
        $this->addSql('ALTER TABLE conversation DROP FOREIGN KEY FK_8A8E26E9BA0E79C3');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0FDDA4EF4');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DFDDA4EF4');
        $this->addSql('ALTER TABLE conversation DROP FOREIGN KEY FK_8A8E26E9FDDA4EF4');
        $this->addSql('ALTER TABLE favoris DROP FOREIGN KEY FK_8933C432FDDA4EF4');
        $this->addSql('ALTER TABLE microservice_media DROP FOREIGN KEY FK_C91878DBFDDA4EF4');
        $this->addSql('ALTER TABLE microservice_prix DROP FOREIGN KEY FK_7F36493CFDDA4EF4');
        $this->addSql('ALTER TABLE microservice_prix DROP FOREIGN KEY FK_7F36493C944722F2');
        $this->addSql('ALTER TABLE abonnement DROP FOREIGN KEY FK_351268BB3F1B1098');
        $this->addSql('ALTER TABLE abonnement DROP FOREIGN KEY FK_351268BBA76ED395');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0858C065E');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF019EB6921');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D19EB6921');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D858C065E');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA4F84F6E');
        $this->addSql('ALTER TABLE conversation DROP FOREIGN KEY FK_8A8E26E956AE248B');
        $this->addSql('ALTER TABLE conversation DROP FOREIGN KEY FK_8A8E26E9441B8B65');
        $this->addSql('ALTER TABLE conversation DROP FOREIGN KEY FK_8A8E26E9F624B39D');
        $this->addSql('ALTER TABLE favoris DROP FOREIGN KEY FK_8933C43219EB6921');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F60BB6FE6');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FA4F84F6E');
        $this->addSql('ALTER TABLE microservice DROP FOREIGN KEY FK_770EA0AF858C065E');
        $this->addSql('ALTER TABLE portefeuille DROP FOREIGN KEY FK_2955FFFE858C065E');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE suivis DROP FOREIGN KEY FK_6627ED7019EB6921');
        $this->addSql('ALTER TABLE suivis DROP FOREIGN KEY FK_6627ED70858C065E');
        $this->addSql('DROP TABLE abonnement');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE conversation');
        $this->addSql('DROP TABLE favoris');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE microservice');
        $this->addSql('DROP TABLE microservice_media');
        $this->addSql('DROP TABLE microservice_prix');
        $this->addSql('DROP TABLE portefeuille');
        $this->addSql('DROP TABLE prix');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE stripe');
        $this->addSql('DROP TABLE suivis');
        $this->addSql('DROP TABLE user');
    }
}
