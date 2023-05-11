<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230511032121 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE business_category (business_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_E7C1757A89DB457 (business_id), INDEX IDX_E7C175712469DE2 (category_id), PRIMARY KEY(business_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE business_category ADD CONSTRAINT FK_E7C1757A89DB457 FOREIGN KEY (business_id) REFERENCES business (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE business_category ADD CONSTRAINT FK_E7C175712469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE business CHANGE phone phone VARCHAR(20) DEFAULT NULL, CHANGE city city VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE category CHANGE name name VARCHAR(60) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE business_category DROP FOREIGN KEY FK_E7C1757A89DB457');
        $this->addSql('ALTER TABLE business_category DROP FOREIGN KEY FK_E7C175712469DE2');
        $this->addSql('DROP TABLE business_category');
        $this->addSql('ALTER TABLE business CHANGE phone phone VARCHAR(20) NOT NULL, CHANGE city city VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE category CHANGE name name VARCHAR(35) NOT NULL');
    }
}
