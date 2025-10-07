<?php

namespace App\Repositories\Implementations;

use App\Models\Uppgift;
use App\Repositories\Interfaces\UppgiftRepo;
use App\Storage\JsonDbConnection;
use App\Storage\JsonFilehandler;

class JsonUppgiftRepo implements UppgiftRepo{
    private array $lista=[];

    private $path;

    public function __construct(JsonDbConnection $dbConnection){
        $this->path= new JsonFilehandler('uppgifter', $dbConnection);

        $content=$this->path->read();

        foreach ($content as $item) {
            $this->lista[$item['id']]= new Uppgift($item);
        }
    }

    public function all():array {
        return $this->lista;
    }

    public function get(string $id):?Uppgift {
        return isset($this->lista[$id]) ? $this->lista[$id] : null;
    }

    public function add(Uppgift $uppgift): void{
        if ($uppgift->id===0) {
            $ids=array_keys($this->lista);
            $nextId = empty($ids) ? 1 :max($ids)+1;
            $uppgift->id=$nextId;
        }
        $this->lista[$uppgift->id]=$uppgift;
        $this->path->write($this->lista);
    }

    public function update(Uppgift $uppgift):void{
        $this->add($uppgift);
    }

    public function delete(string $id): void{
        unset($this->lista[$id]);
        $this->path->write($this->lista);
    }
}