<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SearchController extends Controller
{
    public function index()
    {
        return view('search.search');
    }

    public function search(Request $request)
    {
        $search     = $request->get('criteria');
        $filterType = 'brand';

        if(strpos($search, ' ') !== false) {
            $search = str_replace(' ', '%', $search);
        }

        $items = $this->getItems()
                      ->where('fashionrecovery.GR_017.BrandName', 'LIKE', '%'.$search.'%');

        $filters   = $this->filterOptions($items);
        $items     = $items->get();
        $itemsInfo = $this->getItemsInfo($items);

        return view('search.search', compact('search',
                                             'itemsInfo',
                                             'items',
                                             'filters',
                                             'filterType'));
    }

    public function searchByLink($type, $id) {

        $filterType = $type;
        $options = [
            'departmentsIds'   => $filterType == 'department' ? [$id] : false,
            'brandsIds'        => $filterType == 'brand' ? [$id] : false,
            'clothingTypesIds' => false,
            'actualPrice'      => false
        ];

        $types = [
            'department' => [
                'id'     => 'DepartmentID',
                'table'  => 'GR_025',
                'name'   => 'DepName' 
            ],
            'brand' => [
                'id'     => 'BrandID',
                'table'  => 'GR_017',
                'name'   => 'BrandName' 
            ]
        ];        

        $search = DB::table('fashionrecovery.'.$types[$type]['table'])
                                ->where($types[$type]['id'],'=',$id)
                                ->select($types[$type]['name'])
                                ->first();
                                
                              
        $items   = $this->getItems()
                        ->where('fashionrecovery.'.$types[$type]['table'].'.'.$types[$type]['id'], '=', $id);
                        
        $filters = $this->filterOptions($items);
        
        $selectedOptions = $this->selectedOptions($items, $filters, $options);
       
        $items     = $selectedOptions['items'];
        $filters   = $selectedOptions['filters'];
        $items     = $items->get();
        $itemsInfo = $this->getItemsInfo($items);

        return view('search.search', compact('actualPrice',
                                             'search',
                                             'itemsInfo',
                                             'items',
                                             'filters',
                                             'filterType'));

    }

    public function filter(Request $request) {

        $filterType = $request->filterType;
        $search  = $request->search;
        $options = [
            'departmentsIds'   => isset($request->DepartmentID) ? $request->DepartmentID : false,
            'brandsIds'        => isset($request->BrandID) ? $request->BrandID : false,
            'clothingTypesIds' => isset($request->ClothingTypeID) ? $request->ClothingTypeID : false,
            'actualPrice'      => isset($request->ActualPrice) ? $request->ActualPrice : false
        ];


        $types = [
            'department' => 'fashionrecovery.GR_025.DepName',
            'brand'      => 'fashionrecovery.GR_017.BrandName',
        ];

        $items   = $this->getItems()
                     ->where($types[$filterType], 'LIKE', '%'.$search.'%');
        $filters = $this->filterOptions($items);
        $selectedOptions = $this->selectedOptions($items, $filters, $options);

        $items     = $selectedOptions['items'];
        $filters   = $selectedOptions['filters'];
        $items     = $items->get();
        $itemsInfo = $this->getItemsInfo($items);

        return view('search.search', compact('actualPrice',
                                             'search',
                                             'itemsInfo',
                                             'items',
                                             'filters',
                                             'filterType' ));
    }

    public function getItemsInfo($items) {

        return DB::table('fashionrecovery.GR_032')
                    ->whereIn('ItemID',$items->groupBy('ItemID')->keys())
                    ->get(['PicturePath','ThumbPath','ItemID'])
                    ->groupBy('ItemID');
    }

    public function addChecked($data, $key, $ids) {

        return $data->map(function ($itemData, $keyData) use($ids, $key) {

            $data = $itemData->whereIn($key, $ids);

            foreach ($data as $key => $value) {

                $value->isChecked = true;
            }

            return $itemData;
        });
    }

    public function getItems() {

        return DB::table('fashionrecovery.GR_029')
                    ->join('fashionrecovery.GR_020', 'GR_029.SizeID', '=', 'GR_020.SizeID')
                    ->join('fashionrecovery.GR_018', 'GR_029.ColorID', '=', 'GR_018.ColorID')
                    ->join('fashionrecovery.GR_017', 'GR_029.BrandID', '=', 'GR_017.BrandID')
                    ->join('fashionrecovery.GR_025', 'GR_029.DepartmentID', '=', 'GR_025.DepartmentID')
                    ->join('fashionrecovery.GR_019', 'GR_029.ClothingTypeID', '=', 'GR_019.ClothingTypeID')
                    ->select('fashionrecovery.GR_029.ItemDescription', 'GR_029.ItemID','GR_029.OriginalPrice','GR_029.ActualPrice','GR_020.SizeName','GR_018.ColorName','GR_018.ColorID','GR_017.BrandName','GR_017.BrandID','GR_025.DepName','GR_025.DepartmentID','GR_019.ClothingTypeName','GR_017.BrandID','GR_019.ClothingTypeID');
                    // ->orWhere('fashionrecovery.GR_029.ItemDescription', 'LIKE', '%'.$search.'%')
                    // ->orWhere('fashionrecovery.GR_018.ColorName', 'LIKE', '%'.$search.'%');
    }

    public function selectedOptions($items, $filters, $options) {

        if($options['departmentsIds']) {

            $filters['departments'] = $this->addChecked($filters['departments'], 'DepartmentID', $options['departmentsIds']);
            $items  = $items->whereIn('fashionrecovery.GR_025.DepartmentID', $options['departmentsIds']);

        }

        if($options['brandsIds']) {

            $filters['brands'] = $this->addChecked($filters['brands'], 'BrandID', $options['brandsIds']);
            $items  = $items->whereIn('fashionrecovery.GR_017.BrandID', $options['brandsIds']);
        }

        if($options['clothingTypesIds']) {

            $filters['clothingTypes'] = $this->addChecked($filters['clothingTypes'], 'ClothingTypeID', $options['clothingTypesIds']);
            $items         = $items->whereIn('fashionrecovery.GR_019.ClothingTypeID', $options['clothingTypesIds']);
        }

        if($options['actualPrice']) {
            $items = $items->where('fashionrecovery.GR_029.ActualPrice','=',$options['actualPrice']);
        }

        return [
            'items'   => $items,
            'filters' => $filters
        ];
    }

    public function filterOptions($items) {

        return [
            'departments'   => $items->orderBy('GR_025.DepName')->get()->groupBy('DepName'),
            'brands'        => $items->orderBy('GR_017.BrandName')->get()->groupBy('BrandName'),
            'clothingTypes' => $items->orderBy('GR_019.ClothingTypeName')->get()->groupBy('ClothingTypeName'),
            'colors'        => $items->orderBy('GR_018.ColorName')->get()->groupBy('ColorName'),
        ];

    }
}
