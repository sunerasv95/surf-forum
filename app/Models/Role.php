<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    /**
     * The users that belong to the Role
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'role_user', 'user_id', 'role_id');
    }

   /**
    * The permissions that belong to the Role
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
   public function permissions(): BelongsToMany
   {
       return $this->belongsToMany(Permission::class, 'role_permission', 'permission_id', 'role_id');
   }
}
