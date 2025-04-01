<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231204181315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE versus (id INT AUTO_INCREMENT NOT NULL, gameid_id INT NOT NULL, team1_id INT NOT NULL, team2_id INT NOT NULL, winner_id INT DEFAULT NULL, rate_team1 INT NOT NULL, rate_team2 INT NOT NULL, description VARCHAR(255) NOT NULL, date DATETIME NOT NULL, INDEX IDX_31AEA469C9748260 (gameid_id), INDEX IDX_31AEA469E72BCFA4 (team1_id), INDEX IDX_31AEA469F59E604A (team2_id), INDEX IDX_31AEA4695DFCD4B8 (winner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE versus ADD CONSTRAINT FK_31AEA469C9748260 FOREIGN KEY (gameid_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE versus ADD CONSTRAINT FK_31AEA469E72BCFA4 FOREIGN KEY (team1_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE versus ADD CONSTRAINT FK_31AEA469F59E604A FOREIGN KEY (team2_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE versus ADD CONSTRAINT FK_31AEA4695DFCD4B8 FOREIGN KEY (winner_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE bet ADD userid_id INT NOT NULL, ADD teamid_id INT NOT NULL, ADD matchid INT NOT NULL, ADD amount DOUBLE PRECISION NOT NULL, DROP bet_date, DROP bet_winner');
        $this->addSql('ALTER TABLE bet ADD CONSTRAINT FK_FBF0EC9B58E0A285 FOREIGN KEY (userid_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE bet ADD CONSTRAINT FK_FBF0EC9BF3801A37 FOREIGN KEY (teamid_id) REFERENCES team (id)');
        $this->addSql('CREATE INDEX IDX_FBF0EC9B58E0A285 ON bet (userid_id)');
        $this->addSql('CREATE INDEX IDX_FBF0EC9BF3801A37 ON bet (teamid_id)');
        $this->addSql('ALTER TABLE user CHANGE img_name img_name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE versus DROP FOREIGN KEY FK_31AEA469C9748260');
        $this->addSql('ALTER TABLE versus DROP FOREIGN KEY FK_31AEA469E72BCFA4');
        $this->addSql('ALTER TABLE versus DROP FOREIGN KEY FK_31AEA469F59E604A');
        $this->addSql('ALTER TABLE versus DROP FOREIGN KEY FK_31AEA4695DFCD4B8');
        $this->addSql('DROP TABLE versus');
        $this->addSql('ALTER TABLE bet DROP FOREIGN KEY FK_FBF0EC9B58E0A285');
        $this->addSql('ALTER TABLE bet DROP FOREIGN KEY FK_FBF0EC9BF3801A37');
        $this->addSql('DROP INDEX IDX_FBF0EC9B58E0A285 ON bet');
        $this->addSql('DROP INDEX IDX_FBF0EC9BF3801A37 ON bet');
        $this->addSql('ALTER TABLE bet ADD bet_date DATETIME NOT NULL, ADD bet_winner VARCHAR(50) DEFAULT NULL, DROP userid_id, DROP teamid_id, DROP matchid, DROP amount');
        $this->addSql('ALTER TABLE user CHANGE img_name img_name VARCHAR(255) DEFAULT NULL');
    }
}
