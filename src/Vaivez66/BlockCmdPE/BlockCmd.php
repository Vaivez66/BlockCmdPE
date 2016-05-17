<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 15/02/2016
 * Time: 9:46
 */
namespace Vaivez66\BlockCmdPE;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as TF;

class BlockCmd extends PluginBase{

    public $cfg;
    private $format;

    public function onEnable(){
        $this->saveDefaultConfig();
        $this->getServer()->getLogger()->info(TF::GREEN . 'BlockCmdPE is ready!');
        $this->getServer()->getPluginManager()->registerEvents(new BlockCmdListener($this), $this);
        $this->cfg = new Config($this->getDataFolder() . 'config.yml', Config::YAML, array());
        $this->format = new BlockCmdFormat($this);
    }

    /**
     * @return array
     */

    public function getAllLevels(){
        return (array) $this->cfg->get('active.levels');
    }

    /**
     * @return array
     */

    public function getCmd(){
        return (array) $this->cfg->get('block.cmd');
    }

    /**
     * @return mixed
     */

    public function getMsg(){
        $m = $this->cfg->get('block.message');
        $m = $this->getFormat()->translate($m);
        return $m;
    }

    /**
     * @return mixed
     */

    public function getFormat(){
        return $this->format;
    }

    public function onDisable(){
        $this->getServer()->getLogger()->info(TF::RED . 'BlockCmdPE was disabled!');
    }

}
