<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Contracts\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements Filterable
{
    use HasApiTokens, HasFactory, Notifiable;

    const FILE_FOLDER = 'public/nid_documents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'address',
        'date_of_birth',
        'id_verification_document_path',
        'email',
        'password',
    ];

    protected $appends = [
        'name',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Generate 6 digits 2FA code for the User
     */
    public function generateTwoFactorCode()
    {
        $this->timestamps = false;

        $this->two_factor_code = rand(100000, 999999);
        $this->two_factor_expires_at = now()->addMinutes(5);
        $this->save();
    }

    /**
     * Reset the 2FA code generated earlier
     */
    public function resetTwoFactorCode()
    {
        $this->timestamps = false;

        $this->two_factor_code = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }

    public function scopeNormalUser(Builder $query)
    {
        return $query->whereHas('roles', function ($query) {
            $query->where('name', Role::ROLE_USER);
        });
    }

    public function getNameAttribute(): string
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function scopeFilter(Builder $builder, array $parameters)
    {
        return $builder->where(function ($query) use ($parameters) {

            foreach ($parameters as $column => $value) {
                $columnToSearch = $column;

                if ($column == 'name') {
                    $columnToSearch = DB::raw("CONCAT(first_name, ' ', last_name)");
                }

                $query->orWhere($columnToSearch, 'like', '%'.$value.'%');
            }

        });
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
}
