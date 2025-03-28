<?php

namespace App\Models;

use App\Models\Categorie;
use App\Models\Cours;
use App\Models\Feedback;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'duration', 'type','status', 'price','image','publish_date','categorie_id'];
 // Accesseur pour le débogage de la date de publication
 public function getPublishStatusAttribute()
 {
     if (!$this->publish_date) {
         return 'Pas de date de publication';
     }

     $publishDate = Carbon::parse($this->publish_date, 'Africa/Tunis');
     $now = Carbon::now('Africa/Tunis');

     return [
         'publish_date' => $publishDate->format('Y-m-d H:i:s'),
         'now' => $now->format('Y-m-d H:i:s'),
         'is_past' => $publishDate->lte($now),
         'status' => $this->status
     ];
 }
    protected $casts = [
        'publish_date' => 'datetime',
        'status' => 'boolean',
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function cours()
    {
        return $this->hasMany(Cours::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
}
