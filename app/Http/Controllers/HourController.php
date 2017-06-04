<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Hour;
use App\Category;

class HourController extends Controller
{
  private function getNextQuarterHour() {
    $current_date = date('Y-m-d H:i:s');
    $current_time = strtotime($current_date);

    $frac = 900;
    $r = $current_time % $frac;

    $new_time = $current_time + ($frac-$r);
    $new_date = date('Y-m-d H:i:s', $new_time);

    return $current_date;
  }

  public function startHourNow($category_id) {
    if (Auth::user()->isWorking()) {
      echo "A new hour cannot be started before your current one has finished!";
    } else {
      Hour::create([
        'user_id' => Auth::user()->id,
        'category_id' => $category_id,
        'start' => $this->getNextQuarterHour(),
      ]);
      return redirect('/home');
    }
  }

  public function stopHourNow() {
    if (Auth::user()->isWorking()) {
        Auth::user()->currentWorkHour()->update(['stop' => $this->getNextQuarterHour()]);
        return redirect('/home');
    } else {
      echo "You are not working. Cannot stop any time...";
    }
  }

  public function deleteHour($id) {
    Hour::destroy($id);
    return redirect('/home');
  }

  public function editHourView($id) {
    $hour = Hour::find($id);
    if (Auth::user()==$hour->user) {
      return view('edit_hour')->with('hour', $hour);
    } else {
      echo "Hvad laver du her? Denne tid tilhører " . $hour->user->name.".";
    }
  }

  public function editHour($id, Request $data) {
    $hour = Hour::find($id);
    if (Auth::user()!=$hour->user) {
      return redirect('/home');
    }

    //dd(Category::where('name', '=', $data->category)->first()->id);

    $hour->update([
      'category_id' => Category::where('name', '=', $data->category)->first()->id,
      'start' => $data->start,
      'stop' => $data->stop,
    ]);

    return redirect('/home');
  }
}
