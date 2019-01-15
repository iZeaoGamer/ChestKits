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
            case "starter":
                $helmet = Item::get(302, 0, 1);
                $helmet->addEnchantment(new EnchantmentInstance("protection", 2));
                $helmet->setCustomName("§bStarter §3Helmet");
                $chestplate = Item::get(303, 0, 1);
                $chestplate->addEnchantment(new EnchantmentInstance("protection", 2));
                $chestplate->setCustomName("§bStarter §3Chestplate");
                $leggings = Item::get(304, 0, 1);
                $leggings->addEnchantment(new EnchantmentInstance("protection", 2));
                $leggings->setCustomName("§bStarter §3Leggings");
                $boots = Item::get(309, 0, 1);
                $boots->addEnchantment(new EnchantmentInstance("protection", 2));
                $boots->setCustomName("§bStarter §3Boots");
                $sword = Item::get(272, 0, 1);
                $sword->addEnchantment(new EnchantmentInstance("sharpness", 5));
                $sword->setCustomName("§bStarter §3Sword");
                $pickaxe = Item::get(274, 0, 1);
                $pickaxe->addEnchantment(new EnchantmentInstance("efficiency", 4));
                $pickaxe->setCustomName("§bStarter §3Pickaxe");
                $axe = Item::get(275, 0, 1);
                $axe->addEnchantment(new EnchantmentInstance("efficiency", 4));
                $nbt = new CompoundTag("BlockEntityTag", [new ListTag("Items", [$helmet->nbtSerialize(0), $chestplate->nbtSerialize(1), $leggings->nbtSerialize(2), $boots->nbtSerialize(3), $sword->nbtSerialize(4), $pickaxe->nbtSerialize(5), $axe->nbtSerialize(6)])]);
                $chest = ItemFactory::get(Block::CHEST, 0, 1);
                $chest->setNamedTagEntry($nbt);
                $chest->setCustomName("Kit");
                $sender->getInventory()->addItem($chest);
                break;
        }
        return true; 
    }
}
