<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190401094820 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE contributor_document (contributor_id INT NOT NULL, document_id INT NOT NULL, INDEX IDX_EEAF0F407A19A357 (contributor_id), INDEX IDX_EEAF0F40C33F7837 (document_id), PRIMARY KEY(contributor_id, document_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contributor_document ADD CONSTRAINT FK_EEAF0F407A19A357 FOREIGN KEY (contributor_id) REFERENCES contributor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contributor_document ADD CONSTRAINT FK_EEAF0F40C33F7837 FOREIGN KEY (document_id) REFERENCES document (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE contributor_document');
    }
}
