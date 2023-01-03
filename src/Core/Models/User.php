<?php

namespace Multimedia\Multistore\Core\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

	public $table = "user";
	public $primaryKey = "id_user";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_user_status'
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

    public function getRoles() {
        return UserToRole::where('id_user', $this->id_user)->pluck('id_user_role')->toArray();
    }

	public function hasBackendAccess(): Attribute {
		return Attribute::make(
			get: fn () => true
		);
	}

	protected function role(): Attribute {
		$role = UserRole::where('id_user_role', $this->getRoles()[0])->first();

		return Attribute::make(
			get: fn () => $role->name,
		);
	}
}
