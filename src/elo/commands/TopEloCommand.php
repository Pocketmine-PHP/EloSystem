<?php

namespace elo\commands;

use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use elo\Elo;
use pocketmine\utils\TextFormat as TF;
use pocketmine\Player;

class TopEloCommand extends PluginCommand
{
    private $main;

    public function __construct(Elo $main, $name)
    {
        parent::__construct($name, $main);
        $this->main = $main;
        $this->setPermission("addelo.command");
    }

    public function execute(CommandSender $sender, $currentAlias, array $args)
    {
        if ($this->testPermission($sender)) {
            $this->main->sendTopEloTo($sender, 10);
        }
    }
}
