<?php

namespace PocketSoftMine\Multiport\MultiPort;

use Multiport\task\LoggerTask;
use pocketmine\network\protocol\Info;
use pocketmine\plugin\PluginBase;

class MultiPort extends PluginBase{

	const TARGET_PROTOCOL = 45;

	const CURRENT_MINECRAFT_VERSION_NETWORK = "0.14.0";
	const GET_PORT = [19132, 19133, 19134, ...]
	
	private $port;
	private $upnp;
	
	private $getIP;
	private $loaderPort;

	public function onEnable(){
		$this->saveDefaultConfig();
	}
	
	public function loadPort($port, $upnp){
		$port = new LoggerTask($this->getPlugin(), [], ($this instanceof Player ? $this : false));
	}
}
