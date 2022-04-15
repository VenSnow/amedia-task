<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'theme',
        'message',
        'user_name',
        'client_email',
        'file',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatus()
    {
        if ($this->status == 'OPEN') {
            return 'Открыта';
        }
        return 'Отвечено';
    }

    public function isDone()
    {
        return $this->status == 'ANSWERED';
    }
}
