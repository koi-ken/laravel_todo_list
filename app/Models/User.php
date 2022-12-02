<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasFactory;

		protected $hidden = [
			'password',
			'remember_token'
		];

	public function tasks()
	{
		return $this->hasMany(Task::class);
	}

	public static function boot()
	{
		parent::boot();

		static::deleting(function ($user)
		{
			$user->tasks()->delete();
		});
	}
}
