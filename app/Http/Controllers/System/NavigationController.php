<?php

namespace App\Http\Controllers\System;

use App\Hocs\Sortable\Sortable;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Core\NavigationFormRequest;
use App\Models\Navigation;
use App\ProductGroup;
use App\ShopPage;
use App\ShopPost;
use App\ShopPostCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class NavigationController extends Controller
{

    public function getIndex(Request $request)
    {
        $items = Navigation::all();

        $sortable = new Sortable($items);
        $menus = $sortable->getData();
        return view('system/navigation/index', compact('menus'));
    }


    public function getCreate(Request $request)
    {
        $menu = new Navigation();
        $type = (int) $request->get('type');

        $menus = Navigation::all();
        $sortable = new Sortable($menus);
        $menus = $sortable->getData();

        $postCategories = ShopPostCategories::all();
        $sortable = new Sortable($postCategories);
        $postCategories = $sortable->getData();

        $productCategories = ProductGroup::all();
        $sortable = new Sortable($productCategories);
        $productCategories = $sortable->getData();

        return view('system/navigation/create', compact('menu', 'type', 'menus', 'postCategories', 'productCategories'));
    }

    public function postCreate(NavigationFormRequest $request)
    {
        $data = $this->parseData($request);

        if($menu = Navigation::create($data)) {
            return redirect()->route('system.navigation.index')->with('success', 'Cập nhật thành công');
        }

        return redirect()->route('system.navigation.index')->with('error', 'Cập nhật không thành công');
    }

    public function getEdit($id, Request $request)
    {
        $menu = Navigation::findOrFail($id);
        $type = (int) $request->get('type');

        $menus = Navigation::all();
        $sortable = new Sortable($menus);
        $menus = $sortable->getData();

        $postCategories = ShopPostCategories::all();
        $sortable = new Sortable($menus);
        $postCategories = $sortable->getData();

        _debug($postCategories);die;

        $productCategories = ProductGroup::all();
        $sortable = new Sortable($menus);
        $productCategories = $sortable->getData();

        return view('system/navigation/edit', compact('menu', 'type', 'menus', 'postCategories', 'productCategories'));
    }


    public function postEdit($id, NavigationFormRequest $request)
    {
        $data = $this->parseData($request);
        $menu = Navigation::findOrFail($id);
        if($menu->update($data)) {
            return redirect()->route('system.navigation.index')->with('success', 'Cập nhật thành công');
        }

        return redirect()->route('system.navigation.index')->with('error', 'Cập nhật không thành công');
    }

    public function getActive($id, Request $request)
    {
        $menu = Navigation::findOrFail($id);
        $menu->active = !$menu->active;
        $menu->save();

        return response()->json([
            'code' => 1,
            'status' => $menu->active
        ]);
    }

    public function getDelete($id, Request $request)
    {
        $menu = Navigation::findOrFail($id);
        $menu->delete();
        return redirect()->route('system.navigation.index')->with('success', 'Xóa thành công');
    }

    public function parseData(Request $request)
    {
        $type = (int) $request->get('type');
        $objectId = (int) $request->get('object_id');

        $data = [
            'label'     => clean($request->get('label')),
            'url'       => clean($request->get('url')),
            'type'      => $type,
            'object_id' => $objectId,
            'parent_id' => (int) $request->get('parent_id')
        ];

        switch ($type) {
            case Navigation::TYPE_POST:
                $post = ShopPost::findOrFail($objectId);
                $data['url'] = route('shop.post.detail', [$post->id, removeTitle($post->title)]);
                break;

            case Navigation::TYPE_POST_CATEGORY:
                $postCategory = ShopPostCategories::findOrFail($objectId);
                $data['url'] = route('shop.post_category.posts', [$postCategory->id, removeTitle($postCategory->name)]);
                break;

            case Navigation::TYPE_PAGE:
                $page = ShopPage::findOrFail($objectId);
                $data['url'] = route('shop.page.detail', [$page->id, removeTitle($page->title)]);
                break;

            default:
                # code...
                break;
        }

        return $data;
    }


    public function getDesign(Request $request)
    {
        $menus = $this->menu->get([], ['sort' => 'DESC']);
        return view('menu::admin/design', compact('menus'));
    }

    public function postDesign(Request $request)
    {
        $data = $request->get('menu_item');
        parse_str($data, $parsedData);

        $sort = 10001;
        foreach($parsedData['menu_item'] as $id => $parentId) {
            $sort --;
            // Update parent id for menu
            Menu::where('id', $id)->update(['parent_id' => (int) $parentId, 'sort' => $sort]);
        }

        return response()->json(['code' => 1]);
    }


    public function ajaxSearchPost(Request $request)
    {
        $posts = ShopPost::where('title', 'LIKE', '%'. clean($request->get('q')) .'%')->take(20)->get();
        $json = [];
        foreach($posts as $item) {
            $json[] = [
                'id' => $item->getId(),
                'name' => $item->getTitle()
            ];
        }

        return response()->json($json);
    }

    public function ajaxSearchPostCategory(Request $request)
    {
        $items = $this->postCategory->getAllCategories(['name' => $request->get('q')], [], [], false);
        $json = [];
        foreach($items as $item) {
            $json[] = [
                'id' => $item->getId(),
                'name' => $item->getName()
            ];
        }

        return response()->json($json);
    }

    public function ajaxSearchPage(Request $request)
    {
        $items = $this->page->getPages(20, ['title' => $request->get('q')], [], false);
        $json = [];
        foreach($items as $item) {
            $json[] = [
                'id' => $item->getId(),
                'name' => $item->getTitle()
            ];
        }

        return response()->json($json);
    }


    public function ajaxEditable(Request $request)
    {
        $id    = $request->get('pk');
        $field = $request->get('name');
        $value = clean($request->get('value'));

        $item = Navigation::findOrFail($id);
        $item->$field = $value;

        if($item->save()) {
            return response()->json(['code' => 1]);
        }

        return response()->json(['code' => 0]);
    }


    /**
     * Optmize menu
     * @return void
     */
    public function doOptimize()
    {
        $menus = $this->menu->get();
        // Reset has_child to zero
        \DB::table('menus')->update(['has_child' => 0]);

        foreach($menus as $item) {
            $item->level = $item->level;
            if($item->getParentId() > 0) {
                \DB::table('menus')->where('id', $item->getParentId())
                                   ->update(['has_child' => 1]);
            }

            \DB::table('menus')->where('id', $item->getId())
                               ->update(['level' => $item->level]);
        }
    }
}
