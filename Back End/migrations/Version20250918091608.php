<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250918091608 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE calendrier_collecte (id INT AUTO_INCREMENT NOT NULL, adresse VARCHAR(255) NOT NULL, type_dechet VARCHAR(255) NOT NULL, jour_collecte DATE NOT NULL, remarque LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE centre_recyclage (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, latitude DOUBLE PRECISION DEFAULT NULL, longitude DOUBLE PRECISION DEFAULT NULL, horaires LONGTEXT NOT NULL, types_dechets JSON NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE point_fidelite (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, action VARCHAR(255) NOT NULL, points INT NOT NULL, date DATETIME NOT NULL, INDEX IDX_7D270141FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE signalement (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, adresse VARCHAR(255) NOT NULL, commentaire LONGTEXT DEFAULT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', latitude DOUBLE PRECISION DEFAULT NULL, longitude DOUBLE PRECISION DEFAULT NULL, INDEX IDX_F4B55114FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE point_fidelite ADD CONSTRAINT FK_7D270141FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE signalement ADD CONSTRAINT FK_F4B55114FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE point_fidelite DROP FOREIGN KEY FK_7D270141FB88E14F');
        $this->addSql('ALTER TABLE signalement DROP FOREIGN KEY FK_F4B55114FB88E14F');
        $this->addSql('DROP TABLE calendrier_collecte');
        $this->addSql('DROP TABLE centre_recyclage');
        $this->addSql('DROP TABLE point_fidelite');
        $this->addSql('DROP TABLE signalement');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
