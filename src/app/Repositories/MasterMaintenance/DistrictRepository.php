<?php

namespace App\Repositories\MasterMaintenance;

use App\Concerns\Repository\RepositorySaveHandle;
use App\Concerns\Repository\RepositoryUpdateHandle;
use App\Models\District;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

final class DistrictRepository implements DistrictRepositoryInterface
{
    use RepositorySaveHandle;
    use RepositoryUpdateHandle;

    private District $model;

    public function __construct()
    {
        $this->model = new District();
    }

    /**
     * 論理削除
     *
     * @param integer $prefecture_id
     * @return void
     */
    public function softDelete(int $prefecture_id): void
    {
        Log::debug(__CLASS__ . '::' . __FUNCTION__ . ' called:(' . __LINE__ . ')');

        $model = $this->model->findOrFail($prefecture_id);
        $model->deleted_at = now();
        $model->save();
    }

    /**
     * 市区町村 一覧を取得します
     *
     * @return LengthAwarePaginator
     */
    public function getDistrictsLengthAwarePaginatorSideOperator(): LengthAwarePaginator
    {
        Log::debug(__CLASS__ . '::' . __FUNCTION__ . ' called:(' . __LINE__ . ')');

        return $this->model->notDeleted()->paginate(20);
    }

    /**
     * 市区町村 詳細を取得します
     *
     * @param integer $district_id
     * @return Model
     */
    public function findOrFail(int $district_id): Model
    {
        Log::debug(__CLASS__ . '::' . __FUNCTION__ . ' called:(' . __LINE__ . ')');

        return $this->model->findOrFail($district_id);
    }
}
