<?php
use App\Models\User;

$users = User::all();
if ($users->count() > 0) {
    foreach ($users as $user) {
        echo "User: {$user->email}, Role: {$user->role}\n";
    }
} else {
    echo "No users found.\n";
}
