<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180613082723 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE elevator_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE elevator_log_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "order_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE elevator (id INT NOT NULL, current_floor INT NOT NULL, is_moving BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE elevator_log (id INT NOT NULL, elevator_id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, direction VARCHAR(255) NOT NULL, to_stage INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B85B58FD332AFBB ON elevator_log (elevator_id)');
        $this->addSql('CREATE TABLE "order" (id INT NOT NULL, elevator_id INT DEFAULT NULL, from_stage INT NOT NULL, to_stage INT NOT NULL, completed_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, status VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F5299398332AFBB ON "order" (elevator_id)');
        $this->addSql('ALTER TABLE elevator_log ADD CONSTRAINT FK_B85B58FD332AFBB FOREIGN KEY (elevator_id) REFERENCES elevator (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT FK_F5299398332AFBB FOREIGN KEY (elevator_id) REFERENCES elevator (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE elevator_log DROP CONSTRAINT FK_B85B58FD332AFBB');
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT FK_F5299398332AFBB');
        $this->addSql('DROP SEQUENCE elevator_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE elevator_log_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "order_id_seq" CASCADE');
        $this->addSql('DROP TABLE elevator');
        $this->addSql('DROP TABLE elevator_log');
        $this->addSql('DROP TABLE "order"');
    }
}
