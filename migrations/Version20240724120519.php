<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240724120519 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add user_id column to contact table';
    }

    public function up(Schema $schema): void
    {
        // Check if the column already exists
        $table = $schema->getTable('contact');
        if (!$table->hasColumn('user_id')) {
            $this->addSql('ALTER TABLE contact ADD user_id INT NOT NULL');
            $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
            $this->addSql('CREATE INDEX IDX_4C62E638A76ED395 ON contact (user_id)');
        }
    }

    public function down(Schema $schema): void
    {
        $table = $schema->getTable('contact');
        if ($table->hasColumn('user_id')) {
            $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638A76ED395');
            $this->addSql('DROP INDEX IDX_4C62E638A76ED395 ON contact');
            $this->addSql('ALTER TABLE contact DROP user_id');
        }
    }
}