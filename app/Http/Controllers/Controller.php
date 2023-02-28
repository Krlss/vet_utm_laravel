<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Response;

use App\Models\Categories;
use App\Models\Types;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        // config(['app.timezone' => setting('timezone')]);
        ini_set('max_execution_time', 1800);
    }

    public function sendResponse($result, $message)
    {
        return Response::json(['message' => $message, $result], 200);
    }

    public function sendError($error, $code = 404)
    {
        return Response::json($error, $code);
    }

    function postdata(Request $request)
    {
        try {
            $modal_class = $request->modal_class;
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:' . $modal_class,
            ]);

            $success_output = '';
            $modal_title = '';

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()]);
            } else {

                DB::beginTransaction();
                switch ($request->button_action) {
                    case 'insert':
                        if ($request->modal_class == 'categories') {
                            Categories::create([
                                'name' => $request->name,
                            ]);
                            $success_output = flashMessage(__('Category created successfully'), 'success');
                            $modal_title = __('Creating a new category');
                        } else if ($request->modal_class == 'types') {
                            Types::create([
                                'name' => $request->name,
                            ]);
                            $success_output = flashMessage(__('Type created successfully'), 'success');
                            $modal_title = __('Creating a new type');
                        } else if ($request->modal_class == 'units') {
                            Unit::create([
                                'name' => $request->name,
                            ]);
                            $success_output = flashMessage(__('Unit created successfully'), 'success');
                            $modal_title = __('Creating a new unit');
                        }
                        break;
                    case 'update':
                        if ($request->modal_class == 'categories') {
                            Categories::where('id', $request->modal_id)->update([
                                'name' => $request->name,
                            ]);
                            $success_output = flashMessage(__('Category updated successfully'), 'success');
                            $modal_title = __('Updating a category');
                        } else if ($request->modal_class == 'types') {
                            Types::where('id', $request->modal_id)->update([
                                'name' => $request->name,
                            ]);
                            $success_output = flashMessage(__('Type updated successfully'), 'success');
                            $modal_title = __('Updating a type');
                        } else if ($request->modal_class == 'units') {
                            Unit::where('id', $request->modal_id)->update([
                                'name' => $request->name,
                            ]);
                            $success_output = flashMessage(__('Unit updated successfully'), 'success');
                            $modal_title = __('Updating a unit');
                        }
                        break;
                }
                DB::commit();
            }


            $output = array(
                'success'   =>  $success_output,
                'button_action'    =>  $request->button_action,
                'modal_title' =>  $modal_title
            );
            echo json_encode($output);
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
