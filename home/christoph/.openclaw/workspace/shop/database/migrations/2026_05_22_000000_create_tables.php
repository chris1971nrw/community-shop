<?php
// Migration to create products, votes, and users tables

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('users', function ($table) {
    $table->id();
    $table->string('username')->unique();
    $table->string('email')->unique();
    $table->string('password_hash');
    $table->timestamps();
});

Capsule::schema()->create('products', function ($table) {
    $table->id();
    $table->string('title');
    $table->string('image_url');
    $table->decimal('price', 10, 2);
    $table->string('affiliate_id');
    $table->integer('score')->default(0);
    $table->timestamps();
});

Capsule::schema()->create('votes', function ($table) {
    $table->id();
    $table->unsignedBigInteger('user_id');
    $table->unsignedBigInteger('product_id');
    $table->tinyInteger('vote_type'); // 1=like, 2=favorite, 3=interest
    $table->timestamps();

    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
});

?>