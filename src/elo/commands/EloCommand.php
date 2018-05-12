<?php

namespace elo\commands;

use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use elo\Elo;
use pocketmine\utils\TextFormat as TF;
use pocketmine\Player;

class EloCommand extends PluginCommand {

 private $main;

	public function __construct(Elo $main, $name) {
		parent::__construct($name, $main);
		$this->main = $main;
		$this->setPermission("elo.command");
	}

	public function execute(CommandSender $sender, $currentAlias, array $args) {
          if($this->testPermission($sender)){
             if($sender instanceof Player){
             $elo = $this->main->getElo($sender->getName());
              $sender->sendMessage(Elo::prefix.TF::YELLOW."You have ".TF::BLUE.$elo.TF::YELLOW." Elo.");
       }else{
       $sender->sendMessage(TF::RED."You must run this command in game!");
    }
  }
 }
}

