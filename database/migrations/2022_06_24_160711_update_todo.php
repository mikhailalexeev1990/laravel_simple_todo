<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('todos', function (Blueprint $table) {
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('todos');
            $table->renameColumn('todoValue', 'todo_value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('todos', function ($table) {
            $table->dropForeign('todos_parent_id_foreign');
            $table->renameColumn('todo_value', 'todoValue');
        });
    }
};
