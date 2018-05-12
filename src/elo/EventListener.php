<?php

namespace elo;

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use elo\Elo;
use pocketmine\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerJoinEvent;

Class EventListener implements Listener{

    private $deathloss;
    private $main;

	public function __construct(Elo $main) {
		$this->main = $main;
                $this->deathloss = $this->main->getConfig()->get("Death-Elo-Loss");
    }

     public function onDeath(PlayerDeathEvent $ev){
         if($this->main->config->get("Lose-Elo-onDeath") === true){
             $eloloss = $this->main->config->get("Death-Elo-Loss");
             $this->main->removeElo($ev->getPlayer()->getName(), $eloloss);
         }
         if($this->main->config->get("Get-Elo-On-Kill") === true){
             $cause = $ev->getPlayer()->getLastDamageCause();
             if($cause instanceof EntityDamageByEntityEvent and $cause->getDamager() instanceof Player){
              $killername = $cause->getDamager()->getName();
                 $elo = $this->main->config->get("Elo-On-Kill");
                 $this->main->addElo($killername, $elo);
             }
         }
     }

    public function onJoin(PlayerJoinEvent $ev){
        if(!($this->main->eloyaml->exists($ev->getPlayer()->getName()))){
            $this->main->createDataFor($ev->getPlayer()->getName());
        }
    }
}
