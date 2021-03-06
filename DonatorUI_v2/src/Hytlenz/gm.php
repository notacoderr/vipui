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
	  
  $form = $this->main->api->createCustomForm(function (Player $player, array $data) {
  
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
  
    $form->setTitle($this->main->getConfig()->get("gm.title"));
    $form->addLabel($this->main->getConfig()->get("gm.content"));
    $form->addDropdown("Gamemodes", ["§lSurvival", "§lCreative", "§lAdventure", "§lSpectator"]);
    
    $form->sendToPlayer($sender);
    
  }
  
}
