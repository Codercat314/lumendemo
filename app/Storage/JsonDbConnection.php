<?php

namespace App\Storage;

class JsonDbConnection{
    private string $basePath;

    public function __construct(){
        $this->basePath = env('JSON_DB_PATH', storage_path(('jsondb')));
        if (!str_starts_with($this->basePath, "/")) {
            $this-> basePath=base_path($this->basePath);

            # code...
        }
        if (!is_dir($this->basePath)) {
            mkdir($this->basePath, 0777, true);
        }
    }
    public function getPath(string $table):string{
        return $this->basePath . DIRECTORY_SEPARATOR . $table . '.json';
    }
}