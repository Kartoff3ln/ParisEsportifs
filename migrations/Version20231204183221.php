<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231204183221 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bet DROP FOREIGN KEY FK_FBF0EC9B58E0A285');
        $this->addSql('ALTER TABLE bet DROP FOREIGN KEY FK_FBF0EC9BF3801A37');
        $this->addSql('DROP INDEX IDX_FBF0EC9B58E0A285 ON bet');
        $this->addSql('DROP INDEX IDX_FBF0EC9BF3801A37 ON bet');
        $this->addSql('ALTER TABLE bet ADD userid_id INT NOT NULL, ADD teamid_id INT NOT NULL, ADD versusid_id INT NOT NULL, DROP userid, DROP teamid');
        $this->addSql('ALTER TABLE bet ADD CONSTRAINT FK_FBF0EC9B3CD472E1 FOREIGN KEY (versusid_id) REFERENCES versus (id)');
        $this->addSql('ALTER TABLE bet ADD CONSTRAINT FK_FBF0EC9B58E0A285 FOREIGN KEY (userid_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE bet ADD CONSTRAINT FK_FBF0EC9BF3801A37 FOREIGN KEY (teamid_id) REFERENCES team (id)');
        $this->addSql('CREATE INDEX IDX_FBF0EC9B3CD472E1 ON bet (versusid_id)');
        $this->addSql('CREATE INDEX IDX_FBF0EC9B58E0A285 ON bet (userid_id)');
        $this->addSql('CREATE INDEX IDX_FBF0EC9BF3801A37 ON bet (teamid_id)');
        $this->addSql('ALTER TABLE game DROP img_name');
        $this->addSql('ALTER TABLE versus DROP FOREIGN KEY FK_31AEA469C9748260');
        $this->addSql('ALTER TABLE versus DROP FOREIGN KEY FK_31AEA469E72BCFA4');
        $this->addSql('ALTER TABLE versus DROP FOREIGN KEY FK_31AEA4695DFCD4B8');
        $this->addSql('ALTER TABLE versus DROP FOREIGN KEY FK_31AEA469F59E604A');
        $this->addSql('DROP INDEX IDX_31AEA469F59E604A ON versus');
        $this->addSql('DROP INDEX IDX_31AEA4695DFCD4B8 ON versus');
        $this->addSql('DROP INDEX IDX_31AEA469C9748260 ON versus');
        $this->addSql('DROP INDEX IDX_31AEA469E72BCFA4 ON versus');
        $this->addSql('ALTER TABLE versus ADD gameid_id INT NOT NULL, ADD team1_id INT NOT NULL, ADD team2_id INT NOT NULL, DROP gameid, DROP team1, DROP team2, CHANGE winner winner_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE versus ADD CONSTRAINT FK_31AEA469C9748260 FOREIGN KEY (gameid_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE versus ADD CONSTRAINT FK_31AEA469E72BCFA4 FOREIGN KEY (team1_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE versus ADD CONSTRAINT FK_31AEA4695DFCD4B8 FOREIGN KEY (winner_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE versus ADD CONSTRAINT FK_31AEA469F59E604A FOREIGN KEY (team2_id) REFERENCES team (id)');
        $this->addSql('CREATE INDEX IDX_31AEA469F59E604A ON versus (team2_id)');
        $this->addSql('CREATE INDEX IDX_31AEA4695DFCD4B8 ON versus (winner_id)');
        $this->addSql('CREATE INDEX IDX_31AEA469C9748260 ON versus (gameid_id)');
        $this->addSql('CREATE INDEX IDX_31AEA469E72BCFA4 ON versus (team1_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bet DROP FOREIGN KEY FK_FBF0EC9B3CD472E1');
        $this->addSql('ALTER TABLE bet DROP FOREIGN KEY FK_FBF0EC9B58E0A285');
        $this->addSql('ALTER TABLE bet DROP FOREIGN KEY FK_FBF0EC9BF3801A37');
        $this->addSql('DROP INDEX IDX_FBF0EC9B3CD472E1 ON bet');
        $this->addSql('DROP INDEX IDX_FBF0EC9B58E0A285 ON bet');
        $this->addSql('DROP INDEX IDX_FBF0EC9BF3801A37 ON bet');
        $this->addSql('ALTER TABLE bet ADD userid INT NOT NULL, ADD teamid INT NOT NULL, DROP userid_id, DROP teamid_id, DROP versusid_id');
        $this->addSql('ALTER TABLE bet ADD CONSTRAINT FK_FBF0EC9B58E0A285 FOREIGN KEY (userid) REFERENCES user (id)');
        $this->addSql('ALTER TABLE bet ADD CONSTRAINT FK_FBF0EC9BF3801A37 FOREIGN KEY (teamid) REFERENCES team (id)');
        $this->addSql('CREATE INDEX IDX_FBF0EC9B58E0A285 ON bet (userid)');
        $this->addSql('CREATE INDEX IDX_FBF0EC9BF3801A37 ON bet (teamid)');
        $this->addSql('ALTER TABLE game ADD img_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE versus DROP FOREIGN KEY FK_31AEA469C9748260');
        $this->addSql('ALTER TABLE versus DROP FOREIGN KEY FK_31AEA469E72BCFA4');
        $this->addSql('ALTER TABLE versus DROP FOREIGN KEY FK_31AEA469F59E604A');
        $this->addSql('ALTER TABLE versus DROP FOREIGN KEY FK_31AEA4695DFCD4B8');
        $this->addSql('DROP INDEX IDX_31AEA469C9748260 ON versus');
        $this->addSql('DROP INDEX IDX_31AEA469E72BCFA4 ON versus');
        $this->addSql('DROP INDEX IDX_31AEA469F59E604A ON versus');
        $this->addSql('DROP INDEX IDX_31AEA4695DFCD4B8 ON versus');
        $this->addSql('ALTER TABLE versus ADD gameid INT NOT NULL, ADD team1 INT NOT NULL, ADD team2 INT NOT NULL, DROP gameid_id, DROP team1_id, DROP team2_id, CHANGE winner_id winner INT DEFAULT NULL');
        $this->addSql('ALTER TABLE versus ADD CONSTRAINT FK_31AEA469C9748260 FOREIGN KEY (gameid) REFERENCES game (id)');
        $this->addSql('ALTER TABLE versus ADD CONSTRAINT FK_31AEA469E72BCFA4 FOREIGN KEY (team1) REFERENCES team (id)');
        $this->addSql('ALTER TABLE versus ADD CONSTRAINT FK_31AEA469F59E604A FOREIGN KEY (team2) REFERENCES team (id)');
        $this->addSql('ALTER TABLE versus ADD CONSTRAINT FK_31AEA4695DFCD4B8 FOREIGN KEY (winner) REFERENCES team (id)');
        $this->addSql('CREATE INDEX IDX_31AEA469C9748260 ON versus (gameid)');
        $this->addSql('CREATE INDEX IDX_31AEA469E72BCFA4 ON versus (team1)');
        $this->addSql('CREATE INDEX IDX_31AEA469F59E604A ON versus (team2)');
        $this->addSql('CREATE INDEX IDX_31AEA4695DFCD4B8 ON versus (winner)');
    }
}
