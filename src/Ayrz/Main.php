<?php

namespace Ayrz;

use pocketmine\utils\TextFormat;
use pocketmine\entity\Entity;
use pocketmine\plugin\PluginBase;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\utils\Random;
use pocketmine\event\entity\ExplosionPrimeEvent;
use pocketmine\event\Listener;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\math\Vector3;

class Main extends PluginBase implements Listener {
	
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

public function BlockPlace(BlockPlaceEvent $event){
    $b = $event->getBlock();
    $p = $event->getPlayer();
 
    if($b->getId()===46){
        $event->setCancelled();
        $rnd = (new Random())->nextSignedFloat() * M_PI * 2;
        $nbt = Entity::createBaseNBT($b, new Vector3(-sin($rnd) * 0.02, 0.2, -cos($rnd) * 0.02));
        $nbt->setShort("Fuse", 90);
        $tnt = Entity::createEntity("PrimedTNT", $b->getLevel(), $nbt);
        $tnt->spawnToAll();
      return true;
    } 
  }
/* Eğer Bloğu Kırmasını Engellemek İstiyorsan "/ * , * /" silmen gerekli
public function ExplosionPrimeEvent(ExplosionPrimeEvent $p){
  $p->setBlockBreaking(false);
}
*/

  public function onDamage(EntityDamageEvent $event){
    $p = $event->getEntity();
      if($p instanceof Player && $event->getCause() === EntityDamageEvent::CAUSE_ENTITY_EXPLOSION){
        switch(mt_rand(1,2)){
          case 1:
            $event->setDamage(10);
          break;
          case 2:
            $event->setDamage(8);	
          break;
          }
        }
      }
    }
