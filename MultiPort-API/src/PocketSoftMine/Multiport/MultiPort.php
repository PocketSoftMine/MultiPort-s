<?php

namespace PocketSoftMine\Multiport\MultiPort;

use Multiport\task\LoggerTask;

use pocketmine\network\AdvancedSourceInterface;
use pocketmine\event\player\PlayerCreationEvent;
use pocketmine\network\protocol\BatchPacket;
use pocketmine\network\protocol\DataPacket;
use pocketmine\network\protocol\Info as ProtocolInfo;
use pocketmine\utils\Binary;
use pocketmine\utils\MainLogger;
use pocketmine\Player;
use pocketmine\Server;
use raklib\protocol\EncapsulatedPacket;
use raklib\RakLib;
use raklib\server\RakLibServer;
use raklib\server\ServerHandler;
use raklib\server\ServerInstance;
use pocketmine\network\Network;
use pocketmine\network\CachedEncapsulatedPacket;
use pocketmine\plugin\PluginBase;

class MultiPort extends PluginBase{

	const TARGET_PROTOCOL = 45;

	const CURRENT_MINECRAFT_VERSION_NETWORK = "0.14.0";
	const GET_PORT = "19132";
	
	/** @var Server */
	private $server;

	/** @var Network */
	private $network;

	/** @var RakLibServer */
	private $rakLib;

	/** @var Player[] */
	private $players = [];

	/** @var string[] */
	private $identifiers;

	/** @var int[] */
	private $identifiersACK = [];

	/** @var ServerHandler */
	private $interface;
	
	private $port;
	private $upnp;
	
	private $getIP;
	private $loaderPort;

	public function onEnable(){
		$this->saveDefaultConfig();
		$this->getPlugin() = "MultiLobbyAPI";
	}
	
	public function loadPort($port, $upnp){
		$loaderPort = new LoggerTask($this->getPlugin(), [], ($this instanceof Player ? $this : false));
		$upnp = new upnpLoggerTask($this->getPlugin() == $getIP, ["0.0.0.0"], ($this instanceof Server ? $this : false));
		$port = new portLoggerTask($this->upnpLoggerTask() == "19132", ["19133"], ($port->getPlugin(), [], ($this instanceof Server ? $this : true)));
	}
	
	public function __construct(Server $server, $port = 19133){

		$this->server = $server;
		$this->identifiers = [];

		$this->rakLib = new RakLibServer($this->server->getLogger(), $this->server->getLoader(), $port, $this->server->getIp() === "" ? "0.0.0.0" : $this->server->getIp());
		$this->interface = new ServerHandler($this->rakLib, $this);
	}
	
	public function setNetwork(Network $network){
		$this->network = $network;
	}
	
	public function process(){
		$work = false;
		if($this->interface->handlePacket()){
			$work = true;
			while($this->interface->handlePacket()){
		}
	} if($this->rakLib->isTerminated()){
			$this->network->unregisterInterface($this);

			throw new \Exception("RakLib Thread crashed");
		}

		return $work;
	}
}
