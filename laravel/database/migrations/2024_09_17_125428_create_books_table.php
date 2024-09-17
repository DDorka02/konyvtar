<?php

use App\Models\Book;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('author');
            $table->string('title')->unique();
            $table->integer('pieces');
            $table->timestamps();     
    });

    Book::create([
        'author' => 'Béla',
        'title'=> 'Jók',
        'pieces'=> 1000,
        
    ]);
    Book::create([
        'author' => 'Gábor',
        'title'=> 'Hófehér',
        'pieces'=> 1200,
        
    ]);
    Book::create([
        'author' => 'Hugó',
        'title'=> 'Rókarudi',
        'pieces'=> 3500,
        
    ]);
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
