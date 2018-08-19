<?php

namespace Hytlenz;

use pocketmine\entity\{Effect,
                      EffectInstance};
use pocketmine\Player;
use Hytlenz\DonatorUI;

class lights {

	public $main;

	public function __construct(DonatorUI $pg)
	{
	  $this->main = $pg;
	}

public function sendUI($sender) {

      $form = $this->main->api->createSimpleForm(function (Player $player, array $data) {
      
            $result = $data;
            
            if ($result == null) {
              return;
            }
            
            switch ($result) {
                    case 0:
                        break;
                        
                    case 1:
                      $sender->addEffect(new EffectInstance(Effect::getEffect(Effect::NIGHT_VISION), 99999999, 0, false));
                      $sender->addTitle("§bLights on", "§0[§e-=-=-=-=-=-=-=-§0]");
                      //$sender->sendMessage($this->getConfig()->get("lights.on"));
                        break;
                        
                    case 2:
                      $sender->removeEffect(Effect::NIGHT_VISION);
                      $sender->addTitle("§cLights off", "§0[§7-=-=-=-=-=-=-=-§0]");
                        break;
                        
                    case 3:
                      $command = "vip";
                      $this->getServer()->getCommandMap()->dispatch($sender, $command);
                        break;
            }
        });
        
          $form->setTitle($this->getConfig()->get("lights.title"));
          $form->setContent($this->getConfig()->get("lights.content"));
          $form->addButton("§lExit");
          $form->addButton("§l§2On");
          $form->addButton("§l§4Off");
          $form->addButton("§lBack");
          $form->sendToPlayer($sender);
 
        }
}
