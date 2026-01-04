<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Hexters\HexaLite\HexaLiteRolePermission;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HexaLiteRolePermission;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'level'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function orders()
    {
        return $this->hasMany(\App\Models\Order::class, 'user_id');
    }

    public function listings()
    {
        return $this->hasMany(\App\Models\Listing::class, 'user_id');
    }

    public function paymentCards()
    {
        return $this->hasMany(\App\Models\PaymentCard::class, 'user_id');
    }

    // Comments this user has received from other users
    public function commentReceiver(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Comment::class, 'comment_receiver_id');
    }

    // Comments this user has written to other users
    public function commentWriter(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Comment::class, 'comment_writer_id');
    }

    /**
     * Get the user's status based on order count
     *
     * @return string
     */
    public function getUserStatus(): string
    {
        $orderCount = $this->orders()->count();

        if ($orderCount >= 30) {
            return 'Diamond';
        } elseif ($orderCount >= 15) {
            return 'Gold';
        } elseif ($orderCount >= 5) {
            return 'Silver';
        }

        return 'Bronze';
    }

    /**
     * Get the color classes for the user's status badge
     *
     * @return string
     */
    public function getStatusColor(): string
    {
        $status = $this->getUserStatus();

        return match($status) {
            'Diamond' => 'bg-cyan-200 text-cyan-800',
            'Gold' => 'bg-yellow-200 text-yellow-800',
            'Silver' => 'bg-gray-300 text-gray-800',
            'Bronze' => 'bg-orange-200 text-orange-800',
            default => 'bg-gray-200 text-gray-800',
        };
    }
}
