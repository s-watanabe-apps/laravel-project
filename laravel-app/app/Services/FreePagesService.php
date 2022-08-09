<?php
namespace App\Services;

use App\Models\FreePages;
use App\Http\Requests\ManagementsFreepagesRequest;

class FreePagesService extends Service
{
    /**
     * Get all free pages.
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return FreePages::all();
    }

    /**
     * Get free pages by id.
     * 
     * @param int $id
     * @return App\Models\FreePages
     */
    public function find(int $id)
    {
        return FreePages::find($id);
    }

    /**
     * Add as an array.
     * 
     * @param App\Requests\ManagementsFreepagesRequest $request
     * @return App\Models\FreePages
     */
    public function save(ManagementsFreepagesRequest $request)
    {
        $freePages = new FreePages();

        $freePages->fill($request->validated())->save();

        return $freePages;
    }

    /**
     * Update as an array.
     * 
     * @param int $id
     * @param App\Requests\ManagementsFreepagesRequest $request
     * @return App\Models\FreePages
     */
    private function edit(int $id, ManagementsFreepagesRequest $request)
    {
        return FreePages::where('id', $id)->update($request->validated());
    }

    /**
     * Get free page by code.
     * 
     * @param string $code
     * @return App\Models\FreePages
     */
    public function getByCode(string $code)
    {
        return FreePages::query()->where(['code' => $code,])->first();
    }

}
