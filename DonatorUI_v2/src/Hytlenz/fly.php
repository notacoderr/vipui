<?php

namespace Hytlenz;

use pocketmine\entity\{Effect, EffectInstance};
use pocketmine\Player;
use Hytlenz\DonatorUI;

class fly {

	public $main;

	public function __construct(DonatorUI $pg)
	{
	  $this->main = $pg;
	}

  public function sendUI($sender){
      $form = $this->main->api->createSimpleForm(function (Player $player, array $data) {
            $result = $data;
            if ($result == null) {
              return;
            }
            switch ($result) {
                    case 0:
                       break;
                    case 1:
                      $sender->setAllowFlight(true);
                      $sender->addTitle("§bFlying", "§aEnabled!");
                       break;
                    case 2:
                      $sender->setAllowFlight(false);
                      $sender->addTitle("§bFlying", "§cDisabled!");
                       break;
                    case 3:
                      $this->main->getServer()->getCommandMap()->dispatch($sender, "vip");
                       break;
            }
        });
        $form->setTitle($this->main->getConfig()->get("fly.title"));
        $form->setContent($this->main->getConfig()->get("fly.content"));
        $form->addButton("§lExit");
        $form->addButton("§l§2On");
        $form->addButton("§l§4Off");
        $form->addButton("§lBack");
        $form->sendToPlayer($sender);
  }
}
