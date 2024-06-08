<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeSubscription;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Person;
use Modules\Academic\Entities\AcaStudent;
use Modules\Academic\Entities\AcaCourse;

class AutomationController extends Controller
{
    public function succes_payment_auto($type_subscription_id){

        $subscription = TypeSubscription::find($type_subscription_id);
        $ai_oportunities = $subscription->ai_oportunities;
        $allowed_thesis = $subscription->allowed_thesis;
// agregando permisos para tesis y uso de AI
        $user = Auth::user();
        $person = $user->person;

        if ($person->allowed_thesis === null) {
            $person->allowed_thesis = $allowed_thesis;
        } else {
            $person->allowed_thesis += $allowed_thesis;
        }

        if ($person->paraphrase_allowed === null) {
            $person->paraphrase_allowed = $ai_oportunities;
        } else {
            $person->paraphrase_allowed += $ai_oportunities;
        }

        $person->save();

        // dando permiso a los cursos
        $courses = AcaCourse::where('status', 1)->get();
        $registeredUntil = now()->addYear(); // Fecha actual + 1 año

        foreach ($courses as $course) {
            $acaStudent = AcaStudent::where('person_id', $person->id)
                                    ->where('course_id', $course->id)
                                    ->first();

            if ($acaStudent) {
                // Si el usuario ya está registrado, actualiza la fecha de registro
                $acaStudent->registered_until = $registeredUntil;
                $acaStudent->save();
            } else {
                // Si el usuario no está registrado, crea una nueva instancia de AcaStudent
                $acaStudent = new AcaStudent();
                $acaStudent->person_id = $person->id;
                $acaStudent->course_id = $course->id;
                $acaStudent->status = 1;
                $acaStudent->registered_until = $registeredUntil;
                $acaStudent->save();
            }
        }
    }
}
