<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250918193554 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE point_fidelite (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, action VARCHAR(255) NOT NULL, points INT NOT NULL, date DATETIME NOT NULL, INDEX IDX_7D270141FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, question VARCHAR(500) NOT NULL, options JSON NOT NULL, correct_answer INT NOT NULL, explanation VARCHAR(1000) NOT NULL, order_index INT NOT NULL, category VARCHAR(100) NOT NULL, is_active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quiz_answer (id INT AUTO_INCREMENT NOT NULL, quiz_attempt_id INT NOT NULL, question_id INT NOT NULL, selected_answer INT NOT NULL, is_correct TINYINT(1) NOT NULL, answered_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_3799BA7CF8FE9957 (quiz_attempt_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quiz_attempt (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, score INT NOT NULL, total_questions INT NOT NULL, completed_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE point_fidelite ADD CONSTRAINT FK_7D270141FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE quiz_answer ADD CONSTRAINT FK_3799BA7CF8FE9957 FOREIGN KEY (quiz_attempt_id) REFERENCES quiz_attempt (id)');
        $this->addSql('ALTER TABLE signalement CHANGE utilisateur_id utilisateur_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE point_fidelite DROP FOREIGN KEY FK_7D270141FB88E14F');
        $this->addSql('ALTER TABLE quiz_answer DROP FOREIGN KEY FK_3799BA7CF8FE9957');
        $this->addSql('DROP TABLE point_fidelite');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE quiz_answer');
        $this->addSql('DROP TABLE quiz_attempt');
        $this->addSql('ALTER TABLE signalement CHANGE utilisateur_id utilisateur_id INT DEFAULT NULL');
    }
}
