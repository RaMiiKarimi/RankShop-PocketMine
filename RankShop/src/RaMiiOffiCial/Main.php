<?php

namespace RaMiiOffiCial;

use pocketmine\block\Sandstone;
use pocketmine\entity\Effect;
use pocketmine\event\player\PlayerRespawnEvent;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDeathEvent;
use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\player\PlayerExhaustEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\Item;
use pocketmine\item\ItemBlock;
use pocketmine\level\Position;
use pocketmine\level\sound\AnvilFallSound;
use pocketmine\level\sound\ClickSound;
use pocketmine\level\sound\EndermanTeleportSound;
use pocketmine\level\sound\GhastShootSound;
use pocketmine\level\sound\PopSound;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacketV2;
use pocketmine\network\mcpe\protocol\RemoveObjectivePacket;
use pocketmine\network\mcpe\protocol\SetDisplayObjectivePacket;
use pocketmine\network\mcpe\protocol\SetScorePacket;
use pocketmine\network\mcpe\protocol\types\ScorePacketEntry;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use jojoe77777\FormAPI;
use pocketmine\entity\EffectInstance;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;
use pocketmine\level\sound\AnvilUseSound;
use onebone\economyapi\EconomyAPI;

class Main extends PluginBase implements Listener 
{
    public $prefix = "§4RankShop" ;

    public function onLoad()
    {
        $this->getLogger()->info(TextFormat::AQUA . "Plugin $this->prefix  Dar Hal Load Ast!");
    }

    public function onEnable()
    {

        $this->getLogger()->info(TextFormat::GREEN. "Plugin $this->prefix  Ba Movafaqiat Load Shod!");
        
    }

    public function onDisable()
    {

        $this->getLogger()->error(TextFormat::RED . "Plugin $this->prefix  Gheyr Faal Shod!");

    }


    public function onCommand(CommandSender $player, Command $cmd, string $label, array $args): bool
    {

        switch ($cmd->getName()) {
            case "rankshop":
                if ($player instanceof Player) {
                    if ($player->hasPermission("rs.use")) {
                        $this->Shop($player);
                    } else {
                        $player->sendMessage(TextFormat::RED ."$this->prefix Shoma Permission Nadarid !");
                    }
                }
                break;
        }
        return true;


    }


    public function Bronze($player)
    {

        $m = EconomyAPI::getInstance()->myMoney($player);
        if ($m >= 500){
            EconomyAPI::getInstance()->reduceMoney($player, 500);
            $purePerms = $this->getServer()->getPluginManager()->getPlugin("PurePerms");
            $group = $purePerms->getGroup("Bronze");
            $purePerms->setGroup($player, $group);
            $player->sendMessage("§b Shoma Rank $group Ra Ba Movafaqiat Kharidari Kardid.");
        } else {
            $player->sendMessage("§cShoma Pool Kafi Baraye Kharid Rank Ra Nadarid");
        }
    }


    public function Silver($player)
    {
        $m = EconomyAPI::getInstance()->myMoney($player);
        if ($m >= 750){
            EconomyAPI::getInstance()->reduceMoney($player, 750);
            $purePerms = $this->getServer()->getPluginManager()->getPlugin("PurePerms");
            $group = $purePerms->getGroup("Silver");
            $purePerms->setGroup($player, $group);
            $player->sendMessage("§b Shoma Rank $group Ra Ba Movafaqiat Kharidari Kardid.");
        } else {
            $player->sendMessage("§cShoma Pool Kafi Baraye Kharid Rank Ra Nadarid");
        }
    }



    public function Gold($player)
    {

        $m = EconomyAPI::getInstance()->myMoney($player);
        if ($m >= 1000){
            EconomyAPI::getInstance()->reduceMoney($player, 1000);
            $purePerms = $this->getServer()->getPluginManager()->getPlugin("PurePerms");
            $group = $purePerms->getGroup("Gold");
            $purePerms->setGroup($player, $group);
            $player->sendMessage("§b Shoma Rank $group Ra Ba Movafaqiat Kharidari Kardid.");
        } else {
            $player->sendMessage("§cShoma Pool Kafi Baraye Kharid Rank Ra Nadarid");
        }
    }

    

    public function Shop($player){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $player, int $data = null) {
            $result = $data;
            if ($result === null){
                return true;
            }
            switch ($result){
                case 0:
                    $this->Bronze($player);
                    break;
            }
            switch ($result) {
                case 1:
                    $this->Silver($player);
                    break;
            }
            switch ($result) {
                case 2:
                    $this->Gold($player);
                    break;
                }
                switch ($result){
                    case 3:
                        break;
                }
            });
            $form->setTitle("$this->prefix");
            $form->addButton("§6Bronze \n §0[500$]");
            $form->addButton("§5Silver  \n §0[750$]");
            $form->addButton("§4Gold  \n §0[1000$]");
            $form->addButton("§cKhrooj");
            $form->sendToPlayer($player);
            return true;
        }
            

}