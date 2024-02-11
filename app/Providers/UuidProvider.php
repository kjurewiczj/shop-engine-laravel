<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class UuidProvider extends ServiceProvider
{
    public function boot()
    {
        // Providing for user which not extends Model
        User::creating(function ($userModel) {
            $userModel->uuid = Str::uuid();
        });

        // Providing the rest
        Model::creating(function ($model) {
            if (!Schema::hasColumn((new $model)->getTable(), 'uuid')) {
                return null;
            }

            $model->uuid = Str::uuid();
        });
    }
}
