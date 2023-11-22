<?php

namespace App\Http\Controllers\Admin;

use App\Enums\DeleteEntityType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class DeleteEntityController extends Controller
{

    /**
     * Render view delete confirm.
     *
     * @param DeleteEntityType $entity
     * @param $id
     * @return View
     */
    public function confirm(DeleteEntityType $entity, $id): View
    {
        $model = ($entity->getModel()['model'])::find($id);

        if (
            !is_null($model) &&
            Route::has("cms.{$entity->value}.destroy")
        ) {
            return view('admin.delete-confirm')->with([
                'entity' => $entity->value,
                'model' => $model,
                'id' => $id,
                'display_name' => $entity->getModel()['displayName'],
            ]);
        }
        return view('errors.404');
    }

}
