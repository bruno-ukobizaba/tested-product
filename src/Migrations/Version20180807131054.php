<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180807131054 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE caracteristique (id INT AUTO_INCREMENT NOT NULL, produit_teste_id INT DEFAULT NULL, langue_id INT DEFAULT NULL, nom_chimique VARCHAR(255) NOT NULL, nom_commun VARCHAR(255) NOT NULL, nom_commercial VARCHAR(255) DEFAULT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_D14FBE8BA9B53321 (produit_teste_id), INDEX IDX_D14FBE8B2AADBACD (langue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dangerosite (id INT AUTO_INCREMENT NOT NULL, langue_id INT DEFAULT NULL, type_danger VARCHAR(255) NOT NULL, phrase_risque VARCHAR(255) NOT NULL, url_picto VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, INDEX IDX_372131602AADBACD (langue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fichier (id INT AUTO_INCREMENT NOT NULL, produit_teste_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, is_restricted TINYINT(1) NOT NULL, INDEX IDX_9B76551FA9B53321 (produit_teste_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE langue (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, url_image VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE melange (id INT AUTO_INCREMENT NOT NULL, produit_teste_id INT DEFAULT NULL, produit_melange_id INT DEFAULT NULL, concentration VARCHAR(255) NOT NULL, INDEX IDX_A541E805A9B53321 (produit_teste_id), INDEX IDX_A541E8055ECE3691 (produit_melange_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_teste (id INT AUTO_INCREMENT NOT NULL, dangerosite_id INT DEFAULT NULL, solution_id INT DEFAULT NULL, iupac VARCHAR(255) NOT NULL, numero_cas VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, modified_at DATETIME DEFAULT NULL, is_melange TINYINT(1) NOT NULL, is_tested TINYINT(1) NOT NULL, is_active TINYINT(1) NOT NULL, INDEX IDX_D6282E9BA4A219CB (dangerosite_id), INDEX IDX_D6282E9B1C0BE183 (solution_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE solution (id INT AUTO_INCREMENT NOT NULL, langue_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, INDEX IDX_9F3329DB2AADBACD (langue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE caracteristique ADD CONSTRAINT FK_D14FBE8BA9B53321 FOREIGN KEY (produit_teste_id) REFERENCES produit_teste (id)');
        $this->addSql('ALTER TABLE caracteristique ADD CONSTRAINT FK_D14FBE8B2AADBACD FOREIGN KEY (langue_id) REFERENCES langue (id)');
        $this->addSql('ALTER TABLE dangerosite ADD CONSTRAINT FK_372131602AADBACD FOREIGN KEY (langue_id) REFERENCES langue (id)');
        $this->addSql('ALTER TABLE fichier ADD CONSTRAINT FK_9B76551FA9B53321 FOREIGN KEY (produit_teste_id) REFERENCES produit_teste (id)');
        $this->addSql('ALTER TABLE melange ADD CONSTRAINT FK_A541E805A9B53321 FOREIGN KEY (produit_teste_id) REFERENCES produit_teste (id)');
        $this->addSql('ALTER TABLE melange ADD CONSTRAINT FK_A541E8055ECE3691 FOREIGN KEY (produit_melange_id) REFERENCES produit_teste (id)');
        $this->addSql('ALTER TABLE produit_teste ADD CONSTRAINT FK_D6282E9BA4A219CB FOREIGN KEY (dangerosite_id) REFERENCES dangerosite (id)');
        $this->addSql('ALTER TABLE produit_teste ADD CONSTRAINT FK_D6282E9B1C0BE183 FOREIGN KEY (solution_id) REFERENCES solution (id)');
        $this->addSql('ALTER TABLE solution ADD CONSTRAINT FK_9F3329DB2AADBACD FOREIGN KEY (langue_id) REFERENCES langue (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE produit_teste DROP FOREIGN KEY FK_D6282E9BA4A219CB');
        $this->addSql('ALTER TABLE caracteristique DROP FOREIGN KEY FK_D14FBE8B2AADBACD');
        $this->addSql('ALTER TABLE dangerosite DROP FOREIGN KEY FK_372131602AADBACD');
        $this->addSql('ALTER TABLE solution DROP FOREIGN KEY FK_9F3329DB2AADBACD');
        $this->addSql('ALTER TABLE caracteristique DROP FOREIGN KEY FK_D14FBE8BA9B53321');
        $this->addSql('ALTER TABLE fichier DROP FOREIGN KEY FK_9B76551FA9B53321');
        $this->addSql('ALTER TABLE melange DROP FOREIGN KEY FK_A541E805A9B53321');
        $this->addSql('ALTER TABLE melange DROP FOREIGN KEY FK_A541E8055ECE3691');
        $this->addSql('ALTER TABLE produit_teste DROP FOREIGN KEY FK_D6282E9B1C0BE183');
        $this->addSql('DROP TABLE caracteristique');
        $this->addSql('DROP TABLE dangerosite');
        $this->addSql('DROP TABLE fichier');
        $this->addSql('DROP TABLE langue');
        $this->addSql('DROP TABLE melange');
        $this->addSql('DROP TABLE produit_teste');
        $this->addSql('DROP TABLE solution');
    }
}
