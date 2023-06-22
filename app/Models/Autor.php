<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Livro;

class Autor extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nome',
        'foto',
    ];  

    public function livros()
    {
        return $this->HasMany(Livro::class);
    }
}
