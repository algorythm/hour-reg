<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    protected $fillable = ['start', 'stop', 'category_id', 'user_id'];

    public function user() {
      return $this->belongsTo('App\User');
    }

    public function category() {
      return $this->belongsTo('App\Category');
    }

    public function hoursTotal() {
      //$date1 = new \DateTime($this->start);
      //$date2 = new \DateTime($this->stop);
      //return $date2->diff($date1);
      //return str($date1);

      //$date1 = strtotime(str_replace('/', '-', $this->start));
      //$date2 = strtotime(str_replace('/', '-', $this->stop));

      $date1 = new \DateTime($this->start);
      $date2 = new \DateTime($this->stop);

      $diff = $date1->diff($date2);

      if ($this->stop === null) {
        return "Current";
      } else {
        if ($diff->format('%h') == 0) {
          return $diff->format('%im');
        } else {
          return $diff->format('%hh %im');
        }
        //return round(abs(($date1 - $date2) / 3600));
      }
    }

    private function beautifyDate($date) {
      $beautiDate = date('D H:i', strtotime($date));

      if ($date === null) {
        return "Current";
      }

      return $beautiDate;
    }

    public function getStart() {
      return $this->beautifyDate($this->start);
    }

    public function getStop() {
      return $this->beautifyDate($this->stop);
    }

    public function hour() {
        return Hour::all(); // TODO: Make this working, return descending order
    }
}
