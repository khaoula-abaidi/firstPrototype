<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190401112828 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE contributor (id INT AUTO_INCREMENT NOT NULL, decision_id INT DEFAULT NULL, civility VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, firstname VARCHAR(255) DEFAULT NULL, complement_name VARCHAR(255) DEFAULT NULL, login VARCHAR(255) NOT NULL, pwd VARCHAR(255) NOT NULL, INDEX IDX_DA6F9793BDEE7539 (decision_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, decision_id INT DEFAULT NULL, doi VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, summuray LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, modified_at DATETIME DEFAULT NULL, INDEX IDX_D8698A76BDEE7539 (decision_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document_contributor (document_id INT NOT NULL, contributor_id INT NOT NULL, INDEX IDX_58C6A0F9C33F7837 (document_id), INDEX IDX_58C6A0F97A19A357 (contributor_id), PRIMARY KEY(document_id, contributor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE structure (id INT AUTO_INCREMENT NOT NULL, sigle VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, pays VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE decision (id INT AUTO_INCREMENT NOT NULL, content VARCHAR(255) DEFAULT NULL, allowed_at DATETIME NOT NULL, is_taken TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contributor ADD CONSTRAINT FK_DA6F9793BDEE7539 FOREIGN KEY (decision_id) REFERENCES decision (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76BDEE7539 FOREIGN KEY (decision_id) REFERENCES decision (id)');
        $this->addSql('ALTER TABLE document_contributor ADD CONSTRAINT FK_58C6A0F9C33F7837 FOREIGN KEY (document_id) REFERENCES document (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document_contributor ADD CONSTRAINT FK_58C6A0F97A19A357 FOREIGN KEY (contributor_id) REFERENCES contributor (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE document_contributor DROP FOREIGN KEY FK_58C6A0F97A19A357');
        $this->addSql('ALTER TABLE document_contributor DROP FOREIGN KEY FK_58C6A0F9C33F7837');
        $this->addSql('ALTER TABLE contributor DROP FOREIGN KEY FK_DA6F9793BDEE7539');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76BDEE7539');
        $this->addSql('DROP TABLE contributor');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE document_contributor');
        $this->addSql('DROP TABLE structure');
        $this->addSql('DROP TABLE decision');
    }
}
