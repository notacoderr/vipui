<?php

namespace Hytlenz;

use pocketmine\Player;

use Hytlenz\DonatorUI;

class shout {

  public $main;
  
  public function __construct(DonatorUI $pg) {
    $this->main = $pg;
  }

  public function sendUI($sender) {
    $form = $this->main->api->createCustomForm(function (Player $player, array $data) {

      if(is_string($data[1]) && strlen($data[1]) >= 1 ) {
      
        $sender->sendMessage("§l§a☄ " . (string) $data[1]);
        
        foreach($this->main->getServer()->getOnlinePlayers() as $player) {
          $player->addTitle( $sender->getDisplayName() , (string) $data[1]);
        }
        
      }
      
    });

    $form->setTitle($this->main->getConfig()->get("shout.title"));
    $form->addLabel($this->main->getConfig()->get("shout.label"));
    $form->addInput("Put your nick name here:", "Nickname");
    $form->sendToPlayer($sender);
    
  }
}
