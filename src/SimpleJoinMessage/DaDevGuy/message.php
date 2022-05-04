<?php
namespace SimpleJoinMessage\DaDevGuy;

use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class Main extends PluginBase
{
    public function onEnable(): void 
    {
        if($this->getConfig()->get("config-ver") !== 1){
            $this->getLogger()->info(TextFormat::RED . "!WARNING: Config.yml Of SimpleJoinMessage Is Not Uptodate Please Delete It and Restart The Server!");
        }
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->getResource("config.yml");
    }
    public function onJoin(PlayerJoinEvent $event)
    {
        $player = $event->getPlayer();
        $name = $player->getName();
        $message = str_replace("{name}", $name, $this->getConfig()->get("join-message"));
        $player->sendMessage($message);
    }
}