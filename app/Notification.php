<?php

namespace App;

use App\Http\Controllers\Admin\ApartmentController;
use App\Models\Auth\User\User;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';
    protected $fillable = ['message', 'apartment_id', 'user_id', 'to_user_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\Auth\User\User', 'user_id');
    }

    public static function get_notifications()
    {
        $apartments = Apartment::all();
        $notifications = [];
        foreach ($apartments as $apartment) {
            $AC = new ApartmentController();
            if ($AC::getUserApartments($apartment->id, auth()->user()->id) || $apartment->owner_id === auth()->user()->id|| $apartment->caretaker_id === auth()->user()->id) {
                $notification = Notification::where('apartment_id', $apartment->id)->get();

                foreach ($notification as $not) {
                    $user = User::where('id', $not->user_id)->first();
                    $notifications [] = [
                        'user_id' => $not->user_id,
                        'user_name' => $user->name,
                        'to_user_id' => $not->to_user_id,
                        'title' => $not->title,
                        'message' => $not->message,
                        'created_at' => $not->created_at,
                        'updated_at' => $not->updated_at,
                    ];
                }
            }
        }

        $notification_object = json_decode(json_encode($notifications), FALSE);

        return $notification_object;
    }
}
