<?php
namespace App\Service;

use App\Entity\FileWritable;
use Symfony\Component\Config\Definition\Exception\InvalidTypeException;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

abstract class FileService
{
    
    const FILE_PATH = '/tmp/';
    
    private $className;
    private $serializer;
    
    private function __construct(string $className)
    {
        $this->className = $className;
        $this->serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
    }
    
    protected function saveToFile(FileWritable $object): bool
    {
        $this->checkObjectValidity($object);
        
        return $this->writeToFile($this->serialize($object));
    }
    
    protected function loadFromFile(): FileWritable
    {
        $object = $this->deserialize($this->readFromFile());
        
        $this->checkObjectValidity($object);
        
        return $object;
    }
    
    private function writeToFile(string $jsonString): bool
    {
        return (bool) file_put_contents($this->getFilename(), $jsonString);
    }
    
    private function readFromFile(): string
    {
        $this->fileExists();
        
        return file_get_contents($this->getFilename());
    }
    
    private function serialize(FileWritable $object): string
    {
        $this->checkObjectValidity($object);
        
        return $this->serializer->serialize($object, 'json');
    }
    
    private function deserialize(string $jsonString): FileWritable
    {
        return $this->serializer->deserialize($jsonString, $this->className, 'json');
    }
    
    private function checkObjectValidity(FileWritable $object): bool
    {
        if (!is_subclass_of($object, $this->className)) {
            throw new InvalidTypeException('Object of class ' . get_class($object) . ' is not a derivative of ' . $this->className);
        }
        
        return true;
    }
    
    private function fileExists(): bool
    {
        if (!file_exists($this->getFilename())) {
            throw new FileNotFoundException('The file ' . $this->getFilename() . ' does not exist.');
        }
        
        return true;
    }
    
    private function getFilename()
    {
        return self::FILE_PATH . $this->className . '.json';
    }
}
