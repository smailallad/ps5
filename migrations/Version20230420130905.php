<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230420130905 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27647D1D30');
        $this->addSql('DROP INDEX IDX_29A5EC27647D1D30 ON produit');
        $this->addSql('ALTER TABLE produit CHANGE categiries_id categirie_id INT NOT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27DF25D217 FOREIGN KEY (categirie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27DF25D217 ON produit (categirie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27DF25D217');
        $this->addSql('DROP INDEX IDX_29A5EC27DF25D217 ON produit');
        $this->addSql('ALTER TABLE produit CHANGE categirie_id categiries_id INT NOT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27647D1D30 FOREIGN KEY (categiries_id) REFERENCES categorie (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_29A5EC27647D1D30 ON produit (categiries_id)');
    }
}
