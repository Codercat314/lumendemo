<?php

namespace App\Repositories\Implementations;

use App\Models\Uppgift;
use App\Repositories\Interfaces\UppgiftRepo;

class JsonUppgiftRepo implements UppgiftRepo{
    private array $lista=[];

    private string $path=__DIR__ . '/../../../storage/app/uppgifter.json';

    public function __construct(){
        if (!file_exists($this->path)) {
            return;
        }

        $content=file_get_contents($this->path);
        $json=json_decode($content, true) ?? [];

        foreach ($json as $item) {
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
        file_put_contents($this->path, json_encode($this->lista));
    }

    public function update(Uppgift $uppgift):void{
        $this->add($uppgift);
    }

    public function delete(string $id): void{
        unset($this->lista[$id]);
        file_put_contents($this->path, json_encode($this->lista));
    }
}