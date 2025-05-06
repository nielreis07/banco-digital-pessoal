<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    use HasFactory;

    protected $table = 'contas';

    protected $primaryKey = 'id';

    protected $fillable = [
        'pessoa_id',
        'tipo',
        'numero',
        'saldo',
        'agencia',
    ];

    protected $with = ['pessoa', 'extrato'];

    protected $appends = ['tipo_descricao'];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class, 'pessoa_id', 'id');
    }

    public function extrato()
    {
        return $this->hasMany(Extrato::class, 'conta_id', 'id');
    }

    protected function tipoDescricao(): Attribute
    {
        return Attribute::make(
            get: fn () => match ($this->tipo) {
                'corrente' => 'Conta Corrente',
                'poupanca' => 'Conta Poupança',
                default => '-',
            }
        );
    }
}
