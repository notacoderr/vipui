<?php

namespace Hytlenz;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use jojoe77777\FormAPI;
use pocketmine\Player;
use pocketmine\Server;

class DonatorUI extends PluginBase implements Listener{
    
    public function onEnable() : void
    {
        $this->getLogger()->info("[HytFormUI] - DonatorUI Enabled!");
        Server::getInstance()->getPluginManager()->registerEvents($this, $this);
        $this->checkDepends();
	    
        $this->api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
	    
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->getResource("config.yml");

    }

    public function checkDepends() : void
    {
        if(is_null(Server::getInstance()->getPluginManager()->getPlugin("FormAPI"))){
            $this->getLogger()->info("§4Please install FormAPI Plugin, disabling plugin...");
            $this->getPluginLoader()->disablePlugin($this);
        }
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool
    {
        switch($cmd->getName()){
        case "vip":
        if(!($sender instanceof Player))
	{
        	$sender->sendMessage("§7This command must be used ingame!");
                return true;
    	}
			
        
			
        $form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 0:
                        break;
                    case 1:
			    $sender->setHealth(20);
			    $sender->setFood(20);
			    $sender->sendMessage($this->getConfig()->get("cure.msg"));
				break;
                    case 2:
                    $this->flyUI($sender);
                        break;
                    case 3:
                    $this->vanishUI($sender);
                        break;
                    case 4:
                    $this->lightsUI($sender);
                        break;
                    case 5:
                    $this->gmUI($sender);
                        break;
                    case 6:
                    $this->nickUI($sender);
                        break;

            }
        });
        $form->setTitle($this->getConfig()->get("donator.title"));
        $form->setContent($this->getConfig()->get("donator.content"));
        $form->addButton("§4Exit");
        $form->addButton("§lCure");
        $form->addButton("§lFly");
        $form->addButton("§lVanish");
        $form->addButton("§lLights");
        $form->addButton("§lGamemode");
        $form->addButton("§lNickname");
        $form->sendToPlayer($sender);       
        }
        return true;
    }
    
     public function vanishUI($sender){
      $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
      $form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 0:
                    $sender->addTitle("§bCancelled", "§aYour Request");
                        break;
                    case 1:
                    $sender->addEffect(new EffectInstance(Effect::getEffect(Effect::INVISIBILITY), 99999999, 0, false));
                    $sender->addTitle("§bVanish", "§aEnabled!");
                    $sender->sendMessage($this->getConfig()->get("vanish.on"));
                        break;
                    case 2:
                    $sender->removeEffect(Effect::INVISIBILITY);
                    $sender->addTitle("§bVanish", "§cDisabled!");
                    $sender->sendMessage($this->getConfig()->get("vanish.off"));
                        break;
                    case 3:
                    $command = "donator" ;
                    $this->getServer()->getCommandMap()->dispatch($sender, $command);
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
        
      public function lightsUI($sender){
      $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
      $form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 0:
                    $sender->addTitle("§bCancelled", "§aYour Request");
                        break;
                    case 1:
                    $sender->addEffect(new EffectInstance(Effect::getEffect(Effect::NIGHT_VISION), 99999999, 0, false));
                    $sender->addTitle("§bLights", "§aOn");
                    $sender->sendMessage($this->getConfig()->get("lights.on"));
                        break;
                    case 2:
                    $sender->removeEffect(Effect::NIGHT_VISION);
                    $sender->addTitle("§bLights", "§cOff");
                    $sender->sendMessage($this->getConfig->get("lights.off"));
                        break;
                    case 3:
                    $command = "donator" ;
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
        
      public function flyUI($sender){
      $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
      $form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 0:
                    $sender->addTitle("§bCancelled", "§aYour Request");
                        break;
                    case 1:
                    $sender->setAllowFlight(true);
                    $sender->sendMessage($this->getConfig()->get("fly.on"));
                    $sender->addTitle("§bFly", "§aEnabled!");
                        break;
                    case 2:
                    $sender->setAllowFlight(false);
                    $sender->sendMessage($this->getConfig()->get("fly.off"));
                    $sender->addTitle("§bFly", "§cDisabled!");
                        break;
                    case 3:
                    $command = "donator" ;
                    $this->getServer()->getCommandMap()->dispatch($sender, $command);
                        break;
            }
        });
        $form->setTitle($this->getConfig()->get("fly.title"));
        $form->setContent($this->getConfig()->get("fly.content"));
        $form->addButton("§lExit");
        $form->addButton("§l§2On");
        $form->addButton("§l§4Off");
        $form->addButton("§lBack");
        $form->sendToPlayer($sender);
        }
        
    public function gmUI($sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
	    $form = $api->createCustomForm(function (Player $sender, $data){
              if( !is_null($data)) {
                 switch($data[1]) {
               case 0:
                $sender->setGamemode(Player::SURVIVAL);
                $sender->addTitle("§bSurvival", "§aMode");
                $sender->sendMessage($this->getConfig()->get("gms"));
                    break;
                case 1:
                $sender->setGamemode(Player::CREATIVE);
                $sender->addTitle("§bCreative", "§aMode");
                $sender->sendMessage($this->getConfig()->get("gmc"));
                    break;
                case 2:
                $sender->setGamemode(Player::SPECTATOR);
                $sender->addTitle("§bSpectator", "§aMode");
                $sender->sendMessage($this->getConfig()->get("gmsp"));
                    break;
               default:
                   return;
            }
  }

    });
    $form->setTitle($this->getConfig()->get("gm.title"));
    $form->addLabel($this->getConfig()->get("gm.content"));
    $form->addDropdown("Gamemodes", ["Survival", "Creative", "Spectator"]);
    $form->sendToPlayer($sender);
    }
     
    public function nickUI($sender){
    	$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
	    $form = $api->createCustomForm(function (Player $sender, $data){
                    if($data !== null){
				        $sender->setDisplayName("$data[1]");
						$sender->setNameTag("$data[1]");
						$sender->sendMessage($this->getConfig()->get("nick.message"));
				    }
				});
				$form->setTitle($this->getConfig()->get("nick.title"));
				$form->addLabel($this->getConfig()->get("nick.label"));
				$form->addInput("Put your nick name here:", "Nickname");
				$form->sendToPlayer($sender);
		}

    public function onDisable(){
        $this->getLogger()->info("[HytFormUI] - DonatorUI Disabled!");
    }
}
