<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210505091056 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dog_breed (dog_id INT NOT NULL, breed_id INT NOT NULL, INDEX IDX_6309C10A634DFEB (dog_id), INDEX IDX_6309C10AA8B4A30F (breed_id), PRIMARY KEY(dog_id, breed_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dog_breed ADD CONSTRAINT FK_6309C10A634DFEB FOREIGN KEY (dog_id) REFERENCES dog (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dog_breed ADD CONSTRAINT FK_6309C10AA8B4A30F FOREIGN KEY (breed_id) REFERENCES breed (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contact ADD dog_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638634DFEB FOREIGN KEY (dog_id) REFERENCES dog (id)');
        $this->addSql('CREATE INDEX IDX_4C62E638634DFEB ON contact (dog_id)');
        $this->addSql('ALTER TABLE dog ADD annonce_id INT NOT NULL');
        $this->addSql('ALTER TABLE dog ADD CONSTRAINT FK_812C397D8805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)');
        $this->addSql('CREATE INDEX IDX_812C397D8805AB2F ON dog (annonce_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE dog_breed');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638634DFEB');
        $this->addSql('DROP INDEX IDX_4C62E638634DFEB ON contact');
        $this->addSql('ALTER TABLE contact DROP dog_id');
        $this->addSql('ALTER TABLE dog DROP FOREIGN KEY FK_812C397D8805AB2F');
        $this->addSql('DROP INDEX IDX_812C397D8805AB2F ON dog');
        $this->addSql('ALTER TABLE dog DROP annonce_id');
    }
}
