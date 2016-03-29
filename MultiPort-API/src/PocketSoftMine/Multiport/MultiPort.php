<?php

namespace PocketSoftMine\Multiport\MultiPort;

use pocketmine\network\protocol\Info;
use pocketmine\plugin\PluginBase;

class MultiPort extends PluginBase{

	const TARGET_PROTOCOL = 45;

	const CURRENT_MINECRAFT_VERSION_NETWORK = "0.14.0";

	public function onEnable(){
		$this->saveDefaultConfig();

		$ports = (int) $this->getConfig()->get("Ports");
		if($ports === $this->getServer()->getPort()){
			$this->getLogger()->error("port error in config.yml");
			return;
		}


		$this->getLogger()->info("Starting Minecraft PE server ".$this->getDescription()->getVersion()." on port $ports");
		$interface = new NewInterface($this->getServer(), $ports);
		$this->getServer()->getNetwork()->registerInterface($interface);
	}
}
