<?php

namespace Modules\Investigation\Http\Livewire\Indexes;

use Livewire\Component;
use Modules\Investigation\Entities\InveThesisStudentIndex;

class IndexesModal extends Component
{
    public $thesis_student_id;
    public $type = 0;

    public $items = [];

    public function mount($thesis_student_id)
    {
        $this->getIndexes();
        $this->thesis_student_id = $thesis_student_id;
    }
    public function render()
    {
        return view('investigation::livewire.indexes.indexes-modal');
    }

    public function activeType($type)
    {
        $this->type = $type;
        $this->getIndexes();
    }

    public function addTitleIndexNew()
    {
        $prefix = count($this->items) + 1;

        array_push($this->items, [
            'id'            => '',
            'thesis_id'     => $this->thesis_student_id,
            'prefix'        => null,
            'content'       => '',
            'position'      => '',
            'page'          => '',
            'items'         => null
        ]);

        $index = count($this->items) - 1;

        $this->dispatchBrowserEvent('inve-thesis-indexes-item', ['keyItem' => $index]);
    }

    public function removeTitleIndex($index)
    {
        InveThesisStudentIndex::find($this->items[$index]['id'])->delete();
        unset($this->items[$index]);
        $this->dispatchBrowserEvent('inve-thesis-indexes-item-remove', ['keyItem' => $index]);
    }

    public function saveTitleIndexNew($index)
    {
        if (count($this->items) > 0) {

            $this->validate([
                'items.' . $index . '.thesis_id' => 'required',
                'items.' . $index . '.prefix' => 'required|max:6',
                'items.' . $index . '.content' => 'required|max:400',
                'items.' . $index . '.page' => 'required|max:6'
            ]);

            if ($this->items[$index]['id']) {
                InveThesisStudentIndex::find($this->items[$index]['id'])->update([
                    'type'          => $this->type,
                    'thesis_id'     => $this->thesis_student_id,
                    'prefix'        => $this->items[$index]['prefix'],
                    'content'       => $this->items[$index]['content'],
                    'page'          => $this->items[$index]['page'],
                ]);
            } else {
                InveThesisStudentIndex::create([
                    'type'          => $this->type,
                    'thesis_id'     => $this->thesis_student_id,
                    'prefix'        => $this->items[$index]['prefix'],
                    'content'       => $this->items[$index]['content'],
                    'position'      => 1,
                    'page'          => $this->items[$index]['page'],
                ]);
            }
            $this->getIndexes();
            $this->dispatchBrowserEvent('inve-thesis-indexes-item-store', ['keyItem' => $index]);
        }
    }

    public function getIndexes()
    {
        $this->items = [];
        $index = InveThesisStudentIndex::where('type', $this->type)
            ->where('thesis_id', $this->thesis_student_id)
            ->whereNull('item_id')
            ->get();

        if (count($index) > 0) {
            foreach ($index as $row) {
                array_push($this->items, [
                    'id'            => $row->id,
                    'thesis_id'     => $row->thesis_id,
                    'prefix'        => $row->prefix,
                    'content'       => $row->content,
                    'position'      => $row->position,
                    'page'          => $row->page,
                    'items'         => $this->getSubIndexes($row->id)
                ]);
            }
        }
    }
    public function getSubIndexes($id)
    {
        $index = InveThesisStudentIndex::where('type', $this->type)
            ->where('thesis_id', $this->thesis_student_id)
            ->where('item_id', $id)
            ->get();

        $itemsHTML = '';
        if (count($index) > 0) {
            foreach ($index as $k => $row) {

                $itemsHTML .= '
                    <div class="row" id="div-row-subitem-db-' . $k . $row->id . '">
                        <div class="col-md-1 text-right">
                            <button onclick="addSubIndexNewJS(' . $k . ',' . $row->id . ')" type="button" class="btn btn-secondary btn-sm">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <div class="col-md-1">
                            <input 
                                id="subprefix-db-' . $k . $row->id . '" type="text"
                                value="' . $row->prefix . '"
                                class="form-control form-control-sm text-right">
                        </div>
                        <div class="col-md-8">
                            <input
                                id="subcontent-db-' . $k . $row->id . '" type="text"
                                value="' . $row->content . '"
                                class="form-control form-control-sm" style="background: #fff">
                        </div>
                        <div class="col-md-1">
                            <input 
                                id="subpage-db-' . $k . $row->id . '" type="text"
                                value="' . $row->page . '"
                                class="form-control form-control-sm text-right"
                                style="background: #fff">
                        </div>
                        <div class="col-md-1">
                            <div class="input-group-prepend">
                                <button onclick="saveSubItemUpdateJS(' . $k . ',' . $id . ',' . $row->id . ')" id="btn-new-subitem-db-' . $k . $row->id . '" type="button" class="btn btn-success btn-sm mr-1">
                                    <span id="span-new-subitem-db-' . $k . $row->id . '" class="fa fa-check" ></span>
                                </button>
                                <button onclick="removeSubItemDB(' . $k . ',' . $row->id . ')"
                                    type="button" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>

                        <div id="sub-items-' . $k . $row->id . '"  class="col-md-11 offset-md-1 mt-1">' . $this->getSubIndexes($row->id) . '</div>
                    </div>';
            }
        }
        //dd($itemsHTML);
        return $itemsHTML;
    }

    public function removeTitleSubIndex($id)
    {
        InveThesisStudentIndex::find($id)->delete();
        $this->getIndexes();
    }
}
