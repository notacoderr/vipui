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
    $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
    $form = $api->createCustomForm(function (Player $sender, $data) {

      if(is_string($data[1]) && strlen($data[1]) >= 1 ) {
      
        $sender->sendMessage("§l§a☄ " . (string) $data[1]);
        
        foreach($this->main->getServer()->getOnlinePlayers() as $player) {
          $player->addTitle( $sender->getDisplayName() , (string) $data[1]);
        }
        
      }
      
    });

    $form->setTitle($this->getConfig()->get("shout.title"));
    $form->addLabel($this->getConfig()->get("shout.label"));
    $form->addInput("Put your nick name here:", "Nickname");
    $form->sendToPlayer($sender);
    
  }
}
