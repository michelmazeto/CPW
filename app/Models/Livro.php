<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Autor;
use App\Models\Genero;
use App\Models\Editora;

class Livro extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'titulo',
        'quantidade',
        'foto',
        'id_genero',
        'id_autor',
        'id_editora',
    ];

    public function autor()
    {
        return $this->belongsTo(Autor::class);
    }

    public function genero()
    {
        return $this->belongsTo(Genero::class);
    }

    public function editora()
    {
        return $this->belongsTo(Editora::class);
    }
}
