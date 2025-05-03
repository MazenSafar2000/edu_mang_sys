<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use App\Repository\LibraryRepositoryInterface;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class LibraryController extends Controller
{

    protected $library;

    public function __construct(LibraryRepositoryInterface $library)
    {
        $this->library = $library;
    }

    public function index()
    {
      return $this->library->index();
    }

    public function create()
    {
        return $this->library->create();
    }

    public function store(Request $request)
    {
        return $this->library->store($request);
    }

    public function edit($id)
    {
        return $this->library->edit($id);
    }


    public function update(Request $request)
    {
        return $this->library->update($request);
    }


    public function destroy(Request $request, $id)
    {
        return $this->library->destroy($request, $id);
    }

    public function downloadAttachment($filename)
    {
        return $this->library->download($filename);
    }
}
