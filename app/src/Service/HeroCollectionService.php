<?php
namespace App\Service;

use App\Entity\HeroCollection;
use App\Service\FileService;

class HeroCollectionService extends FileService
{
    
    public function save(HeroCollection $heroCollection): bool
    {
        return $this->saveToFile($heroCollection);
    }
    
    public function load(): HeroCollection
    {
        return $this->loadFromFile();
    }
    
    public function refreshHeroCollection(HeroService $heroService)
    {
        $heroCollection = $heroService->getHeroes();
        
        $this->save($heroService->getHeroes());
        
        return $heroCollection;
    }
}
