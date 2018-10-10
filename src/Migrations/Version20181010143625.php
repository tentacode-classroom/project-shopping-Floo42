<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181010143625 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE jedi (id INT AUTO_INCREMENT NOT NULL, species_id INT NOT NULL, name VARCHAR(50) NOT NULL, saber_color VARCHAR(25) DEFAULT NULL, price DOUBLE PRECISION NOT NULL, description VARCHAR(255) DEFAULT NULL, view_counter INT DEFAULT NULL, INDEX IDX_E3CB6EFB2A1D860 (species_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE species (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag_jedi (tag_id INT NOT NULL, jedi_id INT NOT NULL, INDEX IDX_E0330959BAD26311 (tag_id), INDEX IDX_E0330959590F271A (jedi_id), PRIMARY KEY(tag_id, jedi_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE jedi ADD CONSTRAINT FK_E3CB6EFB2A1D860 FOREIGN KEY (species_id) REFERENCES species (id)');
        $this->addSql('ALTER TABLE tag_jedi ADD CONSTRAINT FK_E0330959BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_jedi ADD CONSTRAINT FK_E0330959590F271A FOREIGN KEY (jedi_id) REFERENCES jedi (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tag_jedi DROP FOREIGN KEY FK_E0330959590F271A');
        $this->addSql('ALTER TABLE jedi DROP FOREIGN KEY FK_E3CB6EFB2A1D860');
        $this->addSql('ALTER TABLE tag_jedi DROP FOREIGN KEY FK_E0330959BAD26311');
        $this->addSql('DROP TABLE jedi');
        $this->addSql('DROP TABLE species');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE tag_jedi');
        $this->addSql('DROP TABLE user');
    }
}
