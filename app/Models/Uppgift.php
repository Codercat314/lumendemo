<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class uppgift extends Model {
    use HasFactory;

    protected $table = 'todos';
    protected $fillable=['id', 'text', 'done'];

    protected $primaryKey='id';

    public $incrementing=true;

    protected $keytype='integer';
}