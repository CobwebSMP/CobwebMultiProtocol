<?php

declare(strict_types=1);

namespace multiprotocol;

use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\network\mcpe\protocol\RequestNetworkSettingsPacket;
use pocketmine\network\mcpe\protocol\ProtocolInfo;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class CobwebMultiProtocol extends PluginBase implements Listener {

    public function onEnable():void {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onPacketReceive(DataPacketReceiveEvent $event){
		$pk = $event->getPacket();
		$or = $event->getOrigin();
		$currentProtocol = ProtocolInfo::CURRENT_PROTOCOL;
    	if($pk instanceof RequestNetworkSettingsPacket){
    		if($pk->getProtocolVersion()){
    			if($pk->getProtocolVersion() === $currentProtocol){
					
				}else{
					$or->disconnect(TextFormat::RED. " CobwebMultiProtocol disconnect: " .TextFormat::WHITE. "Protocol " .$pk->getProtocolVersion(). " is not supported. We support following protocol versions: " . $currentProtocol);
				}
    		}
		}
    }
}
