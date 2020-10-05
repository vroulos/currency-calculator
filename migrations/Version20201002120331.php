<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201002120331 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE currency_exchangerate (id INT AUTO_INCREMENT NOT NULL, currency_exchangerate_id INT NOT NULL, from_current_id INT NOT NULL, to_currency_id INT NOT NULL, rate_date DATE NOT NULL, exchange_rate NUMERIC(5, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE currency_exchanerate');
        $this->addSql('DROP INDEX currency_id ON currencies');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE currency_exchanerate (id INT AUTO_INCREMENT NOT NULL, from_current_id INT NOT NULL, to_currency_id INT NOT NULL, currency_exchangerate_id INT NOT NULL, rate_date DATE NOT NULL, exchange_rate NUMERIC(20, 10) NOT NULL, INDEX to_fk (to_currency_id), INDEX from_fk (from_current_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE currency_exchanerate ADD CONSTRAINT from_fk FOREIGN KEY (from_current_id) REFERENCES currencies (currency_id)');
        $this->addSql('ALTER TABLE currency_exchanerate ADD CONSTRAINT to_fk FOREIGN KEY (to_currency_id) REFERENCES currencies (currency_id)');
        $this->addSql('DROP TABLE currency_exchangerate');
        $this->addSql('CREATE INDEX currency_id ON currencies (currency_id)');
    }
}
