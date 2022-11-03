<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class L0020 extends Model
{
    protected $table = 'L0020';
    protected $fillable = [
        'message_cd',
        'message_typ',
        'message_nm',
        'message',
        'cre_user',
        'cre_ip',
        'cre_prg',
        'cre_datetime',
        'upd_user',
        'upd_ip',
        'upd_prg',
        'upd_datetime',
        'del_user',
        'del_ip',
        'del_prg',
        'del_datetime',
    ];
    use HasFactory;
}
