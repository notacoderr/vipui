<?php

namespace Hytlenz;

use pocketmine\entity\{Effect,
		       EffectInstance};

use pocketmine\Player;
use Hytlenz\DonatorUI;

class vanish {

	public $main;

	public function __construct(DonatorUI $pg)
	{
		$this->main = $pg;
	}

	public function sendUI($sender)
	{
		$form = $this->main->api->createSimpleForm(function (Player $player, array $data) {
		      
		    $result = $data;
		      
		    if ($result == null) {
		    }
		      
		    switch ($result) {
			    case 0:
			      break;
				    
			    case 1:
			      $sender->addEffect(new EffectInstance(Effect::getEffect(Effect::INVISIBILITY), 99999999, 0, false));
			      $sender->addTitle("§Vanish", "§aEnabled!");
			      break;
				    
			    case 2:
			      $sender->removeEffect(Effect::INVISIBILITY);
			      $sender->addTitle("§bVanish", "§cDisabled!");
			      break;
				    
			    case 3:
			      $this->main->getServer()->getCommandMap()->dispatch($sender, "vip");
			      break;
		    }
		});
		
		$form->setTitle($this->getConfig()->get("vanish.title"));
		$form->setContent($this->getConfig()->get("vanish.content"));
		$form->addButton("§lExit");
		$form->addButton("§l§2On");
		$form->addButton("§l§4Off");
		$form->addButton("§lBack");
		$form->sendToPlayer($sender);
		
	}
}
