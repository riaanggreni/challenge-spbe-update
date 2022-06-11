<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;
    protected $table = 'blog';
    protected $fillable = [
        'name',
        'category_id',
        'description',
        'image'
    ];
    protected $hidden;

    // protected $guarded = [];
    // public function up()
    // {
    //     Schema::create('Blog', function (Blueprint $table) {
    //         $table->id();
    //         $table->string('name');
    //         $table->text('desc');
    //         $table->timestamps();
    //     });
    // }
    
}
