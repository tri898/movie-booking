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
     * @param $ids
     * @return View
     */
    public function confirm(DeleteEntityType $entity, $ids): View
    {
        $ids = explode(',', $ids);
        $model = ($entity->getModel()['model'])::find($ids);
        if (
            !$model->isEmpty() &&
            Route::has("cms.$entity->value.destroy")
        ) {
            return view('admin.delete-confirm')->with([
                'entity' => $entity->value,
                'model' => $model,
                'ids' => implode(',', $ids),
                'display_name' => $entity->getModel()['displayName'],
            ]);
        }
        return view('errors.404');
    }

}
