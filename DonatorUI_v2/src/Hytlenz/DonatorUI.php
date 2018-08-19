<?php

namespace Hytlenz;

use jojoe77777\FormAPI;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

use pocketmine\{Player,
		Server};

use pocketmine\command\{Command,
			CommandSender};

class DonatorUI extends PluginBase implements Listener {
    
    	public function onEnable() : void
    	{
		$this->getLogger()->info("[HytFormUI] - DonatorUI - VIP UI Enabled!");
		
		Server::getInstance()->getPluginManager()->registerEvents($this, $this);

		$this->checkDepends();

		$this->api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");

		$this->vanish = new vanish($this);
		$this->fly = new fly($this);
		$this->lights = new lights($this);
		$this->gm = new gm($this);
		$this->shout = new shout($this);

		@mkdir($this->getDataFolder());
		
		$this->saveDefaultConfig();
		$this->getResource("config.yml");

    	}

    	public function checkDepends() : void
    	{
        	if(is_null(Server::getInstance()->getPluginManager()->getPlugin("FormAPI")))
		{
			$this->getLogger()->info("§4Please install FormAPI Plugin, disabling plugin...");
			$this->getPluginLoader()->disablePlugin($this);
        	}
	}

	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool
	{
        	if(strtolower($cmd->getName()) === "vip")
		{
			if(!($sender instanceof Player))
			{
        			$sender->sendMessage("This command must be used ingame!");
                		return true;
    			}
			
			if(!( $sender->hasPermission("sakura.vip") ) )
			{
        			$sender->sendMessage("§cPlease upgrade to VIP to use this feature. If you are already a VIP, please contact a staff ASAP.");
                		return true;
			}
			
        		$form = $this->api->createSimpleForm(function (Player $sender, $data){
            		$result = $data;
				
            			if ($result == null) {
					return;
            			}
            			switch ($result) {
						
                    		case 0:
					$sender->setHealth(20);
			    		$sender->setFood(20);
			    		$sender->addTitle("§l§aRegenerating..", "§fHealth and Hunger filled..");
                        		break;
                    		case 1:
			    		$sender->removeAllEffects();
					$sender->addTitle("§l§bCleansing..", "§fLift all effects..");
					break;
                    		case 2:
                    			$this->fly->sendUI($sender);
                        		break;
                    		case 3:
                    			$this->vanish->sendUI($sender);
                        		break;
                    		case 4:
                    			$this->lights->sendUI($sender);
                        		break;
                   		case 5:
                    			$this->gm->sendUI($sender);
                        		break;
                    		case 6:
                   			$this->shout->sendUI($sender);
                        		break;
            			}

        		});
			
			$form->setTitle($this->getConfig()->get("donator.title"));
			$form->setContent($this->getConfig()->get("donator.content"));
			$form->addButton("§lRegen");
			$form->addButton("§lCleanse");
			$form->addButton("§lFly");
			$form->addButton("§lVanish");
			$form->addButton("§lLights");
			$form->addButton("§lGamemode");
			$form->addButton("§lShoutout");
			$form->sendToPlayer($sender);
			
        	}
		
        	return true;
	}
 
	public function onDisable() : void
	{
		$this->getLogger()->info("[HytFormUI] - DonatorUI - VIPUI Disabled!");
	}
	
}
