<?php

namespace App\Http\Controllers;

use App\Models\todolist;
use App\Models\todoitem;
use Carbon\Carbon;
use Error;
use Illuminate\Http\Request;

class ListController extends Controller
{
	public function index(Request $request)
	{
		// $list = new todolist;
		// $list->name = 'first list for test';
		// $list->created_at = Carbon::now();
		// $list->updated_at = Carbon::now();
		// $list->save();

		// return response()->json([
		// 	'message' => 'list created successfully',
		// 	'data' => $list,
		// 	'status' => '200',
		// ]);
		return response()->json(['data' => todolist::all()]);
	}

	public function show(Request $request, $id)
	{

		// $item = new todoitem;
		// $item->name = 'second item for test';
		// $item->list_id = 1;
		// $item->completed = false;

		// $item->created_at = Carbon::now();
		// $item->updated_at = Carbon::now();
		// $item->save();

		// return response()->json([
		//     'message' => 'item created successfully',
		//     'data' => $item,
		//     'status' => '200',
		// ]);
		// return response()->json(['data' => $list, 'items' => []]);

		$resList = todolist::where('id', $id)
			->orderBy('id')
			->get()->first();
		$resItems =  todoitem::where('list_id', $id)->orderBy('id')
			->get()->all();
		$resList->items = $resItems;

		return response(['data' => $resList]);
	}
	public function store_list(Request $request)
	{
		try {
			$list = new todolist;
			$list->name = $request->name;
			$list->created_at = Carbon::now();
			$list->updated_at = Carbon::now();
			$list->save();

			return response()->json([
				'message' => 'list created successfully',
				'data' => $request,
				'status' => '200',
			]);
		} catch (\Exception $e) {
			return response()->json([
				'message' => 'list not created',
				'data' => $request,
				'status' => '401',
				'4' => $e
			]);
		}
	}
	public function store_item(Request $request, $id)
	{
		try {
			if (
				todolist::where('id', $id)
				->orderBy('id')
				->get()->count() === 1
			) {
				$item = new todoitem;
				$item->name = $request->name;
				$item->list_id = $id;
				$item->completed = '0';
				$item->created_at = Carbon::now();
				$item->updated_at = Carbon::now();
				$item->save();

				return response()->json([
					'message' => 'item created successfully',
					'data' => $request,
					'status' => '200',
				]);
			} else {
				throw new Exception('list not exist');
			};
		} catch (\Exception $e) {
			return response()->json([
				'message' => 'item not created',
				'data' => $request,
				'status' => '401',
				'4' => $e
			]);
		}
	}

	public function destroy_list(Request $request, $id)
	{
		// Make sure logged in user is owner
		// if($listing->user_id != auth()->id()) {
		//     abort(403, 'Unauthorized Action');
		// }

		todolist::where('id', $id)->firstorfail()->delete();
		return response()->json([
			'message' => 'list deleted successfully',
			'data' => $id,
			'status' => '200',
		]);
	}

	public function destroy_item(Request $request, $listId, $itemId)
	{
		// Make sure logged in user is owner.
		// if($listing->user_id != auth()->id()) {
		//     abort(403, 'Unauthorized Action');
		// }

		if (
			todolist::where('id', $listId)
			->orderBy('id')
			->get()->count() === 1
		) {
			todoitem::where('id', $itemId)->firstorfail()->delete();
			return response()->json([
				'message' => 'item deleted successfully',
				'data' => $itemId,
				'status' => '200',
			]);
		} else {
			throw new Exception('list not exist');
		};
	}
}
