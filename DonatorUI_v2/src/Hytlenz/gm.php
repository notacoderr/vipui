<?php

namespace Hytlenz;

use pocketmine\entity\{Effect, EffectInstance};
use pocketmine\Player;
use Hytlenz\DonatorUI;

class gm {
	public $main;
  
	public function __construct(DonatorUI $pg)
	{
	  $this->main = $pg;
	}
  
  public function sendUI($sender){
  $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
  $form = $api->createCustomForm(function (Player $sender, $data) {
  
      if( !is_null($data)) {

        switch($data[1]) {
          case 0:
            $sender->setGamemode(Player::SURVIVAL);
            $sender->addTitle("§bSurvival mode", " ");
              break;
                      
          case 1:
            $sender->setGamemode(Player::CREATIVE);
            $sender->addTitle("§bCreative mode", " ");
              break;
              
          case 2:
            $sender->setGamemode(Player::ADVENTURE);
            $sender->addTitle("§bAdventure mode", " ");
              break;
              
          case 3:
            $sender->setGamemode(Player::SPECTATOR);
            $sender->addTitle("§bSpectator mode", " ");
              break;
        }
    }
    
  });
  
    $form->setTitle($this->getConfig()->get("gm.title"));
    $form->addLabel($this->getConfig()->get("gm.content"));
    $form->addDropdown("Gamemodes", ["§lSurvival", "§lCreative", "§lAdventure", "§lSpectator"]);
    
    $form->sendToPlayer($sender);
    
  }
  
}
