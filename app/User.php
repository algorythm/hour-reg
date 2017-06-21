<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'studyno',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function hours() {
      return $this->hasMany('App\Hour');
    }

    public function isWorking() {
      foreach($this->hours as $hour) {
        if ($hour->stop === null) {
          return true;
        }
      }
      return false;
    }

    public function currentWorkHour() {
      foreach($this->hours as $hour) {
        if ($hour->stop === null) {
          return $hour;
        }
      }
      return null;
    }

    public function hoursCategory($category) {
      $total = 0;
      $today = new \DateTime();
      foreach ($this->hours as $hour) {
        $d1 = new \DateTime($hour->start);
        $d2 = new \DateTime($hour->stop);
        $diff = $d1->diff($d2);
        $mins = $diff->format('%h') * 60;
        if ($hour->category->id == $category->id) {
          $total += $mins + $diff->format('%i');
        }
      }
      return floor($total / 60) . "h " . ($total % 60) . "m";
    }

    public function hoursTotal() {
      $total = 0;
      $today = new \DateTime();
      foreach ($this->hours as $hour) {
        $d1 = new \DateTime($hour->start);
        $d2 = new \DateTime($hour->stop);
        $diff = $d1->diff($d2);
        $mins = $diff->format('%h') * 60;
        $total += $mins + $diff->format('%i');
      }
      return floor($total / 60) . "h " . ($total % 60) . "m";
    }

    public function hoursToday() {
      $total = 0;
      $today = new \DateTime();
      foreach ($this->hours as $hour) {
        $d1 = new \DateTime($hour->start);
        $d2 = new \DateTime($hour->stop);
        $diff = $d1->diff($d2);
        $mins = $diff->format('%h') * 60;
        if ($d1->format('ymd') === $today->format('ymd')) {
          $total += $mins + $diff->format('%i');
        }
      }
      return floor($total / 60) . " hours and " . ($total % 60) . " minutes";
    }
}
