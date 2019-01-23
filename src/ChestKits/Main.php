<?php

declare(strict_types=1);

namespace ChestKits;

use pocketmine\block\Block;

use pocketmine\command\{Command, CommandSender};

use pocketmine\inventory\ChestInventory;

use pocketmine\item\{Item, ItemFactory};

use pocketmine\{Player, Server};

use pocketmine\plugin\PluginBase;

use pocketmine\nbt\{NBT, tag\CompoundTag, tag\IntTag, tag\ListTag, tag\StringTag};

use pocketmine\tile\{Tile, Chest};

use pocketmine\utils\TextFormat as C;

class Main extends PluginBase {

    public function onEnable() : void {
        $this->getLogger()->info("ChestKits Enabled");
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool {

        if(!$sender instanceof Player){
            $sender->sendMessage(TextFormat::RED . "Command must be used in-game.");
            return true;
        }
        switch($command){
            case "kit":
                $helmet = Item::get(306, 0, 1);
                $helmet->setCustomName("Kit Helmet");
                $chestplate = Item::get(307, 0, 1);
                $chestplate->setCustomName("Kit Chestplate");
                $leggings = Item::get(308, 0, 1);
                $leggings->setCustomName("Kit Leggings");
                $boots = Item::get(309, 0, 1);
                $boots->setCustomName("Kit Boots");
                $sword = Item::get(267, 0, 1);
                $sword->setCustomName("Kit Sword");
                $nbt = new CompoundTag("BlockEntityTag", [new ListTag("Items", [$helmet->nbtSerialize(0), $chestplate->nbtSerialize(1), $leggings->nbtSerialize(2), $boots->nbtSerialize(3), $sword->nbtSerialize(4)])]);
                $chest = ItemFactory::get(Block::CHEST, 10, 1);
                $chest->setNamedTagEntry($nbt);
                $chest->setCustomName("Kit");
                $sender->getInventory()->addItem($chest);
                break;
        }
        return true; 
    }
}
