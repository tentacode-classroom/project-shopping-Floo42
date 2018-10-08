<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181008131056 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE jedi ADD species_id INT NOT NULL');
        $this->addSql('ALTER TABLE jedi ADD CONSTRAINT FK_E3CB6EFB2A1D860 FOREIGN KEY (species_id) REFERENCES species (id)');
        $this->addSql('CREATE INDEX IDX_E3CB6EFB2A1D860 ON jedi (species_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE jedi DROP FOREIGN KEY FK_E3CB6EFB2A1D860');
        $this->addSql('DROP INDEX IDX_E3CB6EFB2A1D860 ON jedi');
        $this->addSql('ALTER TABLE jedi DROP species_id');
    }
}
