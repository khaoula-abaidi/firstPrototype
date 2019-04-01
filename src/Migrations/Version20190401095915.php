<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190401095915 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE contributor_document');
        $this->addSql('DROP TABLE decision_contributor');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76BDEE7539');
        $this->addSql('DROP INDEX IDX_D8698A76BDEE7539 ON document');
        $this->addSql('ALTER TABLE document DROP decision_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE contributor_document (contributor_id INT NOT NULL, document_id INT NOT NULL, INDEX IDX_EEAF0F407A19A357 (contributor_id), INDEX IDX_EEAF0F40C33F7837 (document_id), PRIMARY KEY(contributor_id, document_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE decision_contributor (decision_id INT NOT NULL, contributor_id INT NOT NULL, INDEX IDX_379D0AFABDEE7539 (decision_id), INDEX IDX_379D0AFA7A19A357 (contributor_id), PRIMARY KEY(decision_id, contributor_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE contributor_document ADD CONSTRAINT FK_EEAF0F407A19A357 FOREIGN KEY (contributor_id) REFERENCES contributor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contributor_document ADD CONSTRAINT FK_EEAF0F40C33F7837 FOREIGN KEY (document_id) REFERENCES document (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE decision_contributor ADD CONSTRAINT FK_379D0AFA7A19A357 FOREIGN KEY (contributor_id) REFERENCES contributor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE decision_contributor ADD CONSTRAINT FK_379D0AFABDEE7539 FOREIGN KEY (decision_id) REFERENCES decision (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document ADD decision_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76BDEE7539 FOREIGN KEY (decision_id) REFERENCES decision (id)');
        $this->addSql('CREATE INDEX IDX_D8698A76BDEE7539 ON document (decision_id)');
    }
}
