<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    protected $table = 'pessoas';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nome',
        'cpf',
        'data_nascimento',
        'telefone',
        'cep',
        'bairro',
        'cidade',
        'estado',
        'complemento',
        'perfil',
        'usuario_id',
    ];

    protected $appends = [
        'perfil_descricao',
    ];

    protected $with = [
        'usuario',
        'extrato',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }

    public function extrato()
    {
        return $this->hasMany(Extrato::class, 'pessoa_id', 'id');
    }

    public function conta()
    {
        return $this->hasOne(Conta::class, 'pessoa_id', 'id');
    }   

    protected function cpf(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $value),
            set: fn ($value) => preg_replace('/\D/', '', $value),
        );
    }

    protected function dataNascimento(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y H:i'),
            set: fn ($value) => Carbon::createFromFormat('d/m/Y H:i', $value)->format('Y-m-d'),
        );
    }

    protected function telefone(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $value),
            set: fn ($value) => preg_replace('/\D/', '', $value),
        );
    }

    protected function perfilDescricao(): Attribute
    {
        return Attribute::make(
            get: fn () => match ($this->perfil) {
                'funcionario' => 'Funcionário',
                'cliente' => 'Cliente',
                default => '-',
            }
        );
    }
}
