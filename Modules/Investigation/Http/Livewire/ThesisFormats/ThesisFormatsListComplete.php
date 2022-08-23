<?php

namespace Modules\Investigation\Http\Livewire\ThesisFormats;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Investigation\Entities\InveThesisFormat;
use App\Models\Universities as UniversitiesModel;
use App\Models\UniversitiesSchools as UniversitiesSchoolsModel;

class ThesisFormatsListComplete extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;

    public function render()
    {
        return view(
            'investigation::livewire.thesis-formats.thesis-formats-list-complete',
            ['formats' => $this->getData()]
        );
    }

    public function getSearch()
    {
        $this->resetPage();
    }

    public function getData()
    {
        $formats = InveThesisFormat::where('name', 'like', '%' . $this->search . '%');

        return $formats->paginate(10);
    }

    public function getNameUniversity($id_school)
    {
        $uni_id = UniversitiesSchoolsModel::where('id', $id_school)->first()->university_id;
        return UniversitiesModel::where('id', $uni_id)->first()->siglas . ' - ' .
            UniversitiesModel::where('id', $uni_id)->first()->country;
    }

    public function getNameSchool($id_school)
    {
        return UniversitiesSchoolsModel::where('id', $id_school)->first()->name;
    }

    public function destroy($id)
    {
        try {
            /*
            $course_image=AcaCourse::find($id)->course_image;
            Storage::disk('public')->delete(substr($course_image, 8)); */
            InveThesisFormat::find($id)->delete();
            $res = 'success';
            $tit = 'Enhorabuena';
            $msg = 'Se eliminó correctamente';
        } catch (\Illuminate\Database\QueryException $e) {
            $res = 'error';
            $tit = 'Salió mal';
            $msg = 'No se puede eliminar porque cuenta con registros asociados';
        }
        $this->dispatchBrowserEvent('inve-format-thesis-delete', ['res' => $res, 'tit' => $tit, 'msg' => $msg]);
    }
    public function formatClone($id)
    {
        $format = InveThesisFormat::find($id);
        InveThesisFormat::create([
            'name' => 'COPIA - ' . trim($format->name),
            'description' => 'COPIA - ' . trim($format->description),
            'type_thesis' => trim($format->type_thesis),
            'normative_thesis' => trim($format->normative_thesis),
            'school_id' => $format->school_id,
            'right_margin' => $format->right_margin,
            'left_margin' => $format->left_margin,
            'between_lines' => $format->between_lines,
            'top_margin' => $format->top_margin,
            'bottom_margin' => $format->bottom_margin
        ]);
    }
}
