<?php

namespace elo\commands;

use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use elo\Elo;
use pocketmine\utils\TextFormat as TF;
use pocketmine\Player;

class SeeEloCommand extends PluginCommand
{
    private $main;

    public function __construct(Elo $main, $name)
    {
        parent::__construct($name, $main);
        $this->main = $main;
        $this->setPermission("seeelo.command");
    }

    public function execute(CommandSender $sender, $currentAlias, array $args)
    {
        if ($this->testPermission($sender)) {
            if(!isset($args[0])){
                $sender->sendMessage(TF::RED."Usage: /seeelo <name>");
            }
            if(isset($args[0])) {
                $name = $args[0];
                $elo = $this->main->getElo($name);
                $sender->sendMessage(Elo::prefix.TF::YELLOW.$name." has ".$elo." Elo.");
            }
        }
    }
}