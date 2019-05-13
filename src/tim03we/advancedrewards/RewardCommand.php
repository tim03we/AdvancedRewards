<?php

/*
 * Copyright (c) 2019 tim03we  < https://github.com/tim03we >
 * Discord: tim03we | TP#9129
 *
 * This software is distributed under "GNU General Public License v3.0".
 * This license allows you to use it and/or modify it but you are not at
 * all allowed to sell this plugin at any cost. If found doing so the
 * necessary action required would be taken.
 *
 * AdvancedRewards is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License v3.0 for more details.
 *
 * You should have received a copy of the GNU General Public License v3.0
 * along with this program. If not, see
 * <https://opensource.org/licenses/GPL-3.0>.
 */


namespace tim03we\advancedrewards;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\Player;

class RewardCommand extends Command {

    public function __construct(Main $plugin)
    {
        parent::__construct("advancedrewards", "Get your Reward", "/reward", ["reward"]);
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if(empty($this->plugin->pcfg->get($sender->getName()))) {
            $this->plugin->pcfg->set($sender->getName(), 0);
        }
        $time = time();
        if($sender instanceof Player) {
            if($this->plugin->pcfg->get($sender->getName()) <= $time){
                $new = $time + ($this->plugin->cfg->get("time") * 60);
                $this->plugin->pcfg->set($sender->getName(), $new);
                $sender->sendMessage($this->plugin->cfg->getNested("messages.success"));
                $this->plugin->pcfg->save();
                foreach ($this->plugin->cfg->get("rewards") as $reward) {
                    $reward = str_replace('{player}', '""' . $sender->getName() . '""', $reward);
                    $this->plugin->getServer()->dispatchCommand(new ConsoleCommandSender(), $reward);
                }
            } else {
                $remaining = $this->plugin->pcfg->get($sender->getName()) - $time;
                $message = $this->plugin->cfg->getNested("messages.error");
                $message = str_replace("{time}", $this->plugin->convertSeconds($remaining), $message);
                $sender->sendMessage($message);
            }
        } else {
            $sender->sendMessage("Run this command InGame!");
        }
        return false;
    }
}