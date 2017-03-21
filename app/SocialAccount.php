<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SocialAccount
 * @package App
 */
class SocialAccount extends Model
{
    /**
     * @var string
     */
    public $table = 'social_accounts';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'provider_user_id', 'provider'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
