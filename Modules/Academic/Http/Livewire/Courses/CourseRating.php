<?php

namespace Modules\Academic\Http\Livewire\Courses;

use Livewire\Component;
use Modules\Academic\Entities\AcaCourseRating;
use Modules\Academic\Entities\AcaCourseRatingVote;
use Illuminate\Support\Facades\Auth;

class CourseRating extends Component
{
    public $rating = [];
    public $i=0;

    public function mount($course_id)
    {
        $this->rating = AcaCourseRating::where('course_id', $course_id)->first();

        if($this->rating){
            if (fmod($this->rating->rating, 1) > 0) {
                $this->rating->half = true;
            }
            $this->rating->rating = $this->rating->rating - fmod($this->rating->rating, 1);
            if($this->rating->half){
                $this->rating->empty = 4 - $this->rating->rating;
            }else{
                $this->rating->empty = 5 - $this->rating->rating;
            }
        }
        
    }
    public function render()
    {
        return view('academic::livewire.courses.course-rating');
    }

    public function votar($voto){

            AcaCourseRatingVote::updateOrCreate(
                ['user_id' => Auth::id(), 'course_id' => $this->rating->course_id],
                ['rating' => $voto]
            );
            $this->update_rating_course();   //actualizar el promedio de votos y la cantidad de votos
    }

    public function update_rating_course(){
        $this->i=0;
        $avg=AcaCourseRatingVote::where('course_id', $this->rating->course_id)->avg('rating');
        $voters=AcaCourseRatingVote::where('course_id', $this->rating->course_id)->count();
        AcaCourseRating::where('course_id', $this->rating->course_id)->update(['rating' => $avg, 'voters' => $voters]);
        //    $this->rating = AcaCourseRating::where('course_id', $this->rating->course_id)->first();
          //  $this->mount($this->rating->course_id);
        $this->dispatchBrowserEvent('aca-vote-success', ['tit' => 'Gracias por tu calificación','msg' => 'Tu elección ha sido registrada correctamente']);


    }
    public function reload(){
            redirect()->route('academic_students_my_course', $this->rating->course_id);
    }

}
