<?php
namespace App\Services;

use App\Http\Exceptions\NotFoundException;
use App\Http\Exceptions\ForbiddenException;
use App\Models\FreePages;
use App\Http\Requests\ManagementsFreepagesRequest;

class FreePagesService extends Service
{
    /**
     * Get base query builder.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base() {
        return FreePages::query()
            ->select([
                'free_pages.id',
                'free_pages.code',
                'free_pages.title',
                'free_pages.body',
                'free_pages.created_at',
                'free_pages.updated_at',
            ]);
    }

    /**
     * Get all free pages.
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->base()->get();
    }

    /**
     * Get free pages by id.
     * 
     * @return array
     */
    public function get($id)
    {
        return $this->base()->where(['free_pages.id' => $id])->get()->first();
    }

    /**
     * Add as an array.
     * 
     * @param App\Requests\ManagementsFreepagesRequest $request
     * @return App\Models\FreePages
     */
    public function save(ManagementsFreepagesRequest $request)
    {
        if ($request->isPost()) {
            // Insert
            $freePages = new FreePages();
            $freePages->fill($request->validated());
        } else {
            // Update
            $freePages = $this->get($request->id);
            throw_if(!$freePages, NotFoundException::class);

            foreach ($request->validated() as $key => $value) {
                $freePages->$key = $value;
            }
        }

        $freePages->save();
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
