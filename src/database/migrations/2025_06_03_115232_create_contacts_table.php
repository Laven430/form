<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->comment('お問い合わせカテゴリID');
            $table->string('first_name')->comment('姓');
            $table->string('last_name')->comment('名');
            $table->tinyInteger('gender')->comment('性別: 1=男性, 2=女性, 3=その他');
            $table->string('email')->unique()->comment('メールアドレス');
            $table->string('tel')->comment('電話番号');
            $table->string('address')->comment('住所');
            $table->string('building')->nullable()->comment('建物名');
            $table->text('detail')->comment('お問い合わせ内容');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}