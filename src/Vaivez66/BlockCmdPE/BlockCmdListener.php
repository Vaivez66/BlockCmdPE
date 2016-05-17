<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 15/02/2016
 * Time: 9:52
 */
namespace Vaivez66\BlockCmdPE;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerCommandPreprocessEvent;

class BlockCmdListener implements Listener{

    public function __construct(BlockCmd $plugin){
        $this->plugin = $plugin;
    }

    public function onCmd(PlayerCommandPreprocessEvent $event){
        $p = $event->getPlayer();
        $msg = $event->getMessage();
        if(!in_array($p->getLevel()->getName(), $this->plugin->getAllLevels())){
            return;
        }
        if($p->hasPermission('block.cmd.pe.bypass')){
            return;
        }
        foreach($this->plugin->getCmd() as $cmd){
            if(stripos($msg, $cmd) === 0){
                $event->setCancelled(true);
                $p->sendMessage($this->plugin->getMsg());
            }
        }
    }

}
