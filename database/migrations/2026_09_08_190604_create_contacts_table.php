<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\ContactTypePerson;
use App\Enums\ContactTypeContact;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120)->nullable();
            $table->string('fantasy_name', 100)->nullable();
            $table->enum("type_person", array_column(ContactTypePerson::cases(), 'value'))
                  ->default(ContactTypePerson::PF->value);
            $table->enum("type_contact", array_column(ContactTypeContact::cases(), 'value'))
                  ->default(ContactTypeContact::CLIENT->value);
            $table->enum('gender', ['F','M'])->nullable();
            $table->string('rg', 30)->nullable();
            $table->string('cpf', 20)->nullable();
            $table->string('cnpj', 20)->nullable();
            $table->string('ie', 20)->nullable();
            $table->string('im', 20)->nullable();
            $table->date('date_birth')->nullable();
            $table->integer('business_type')->nullable();
            $table->string('email', 100)->unique();
            $table->string('website', 100)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('mobile', 20)->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->enum('newsletter',['S', 'N'])->default('N')->nullable();
            $table->string('image', 100)->nullable();
            $table->text('description')->nullable();
            $table->string('url', 100)->nullable();
            $table->enum('status',['S', 'N'])->default('S');
            $table->enum('privacy',['S', 'N'])->nullabe();
            $table->datetime('created')->nullable();
            $table->datetime('modified')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
