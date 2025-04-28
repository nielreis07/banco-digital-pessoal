<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extrato extends Model
{
    use HasFactory;

    protected $table = 'extrato';

    protected $primaryKey = 'id';

    protected $fillable = [
        'conta_id',
        'pessoa_id',
        'operacao',
        'valor',
    ];

    const OPERACAO_SAQUE = 'saque';

    const OPERACAO_DEPOSITO = 'deposito';

    const OPERACAO_TRANSFERENCIA = 'transferencia';
}
